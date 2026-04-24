<?php

class Reports extends Controller
{
    private $transactionModel;
    private $purchaseModel;
    private $orderModel;

    private function buildSalesData($from, $to)
    {
        $transactions = $this->transactionModel->getByDateRange($from, $to);
        $orders = $this->orderModel->getByDateRange($from . ' 00:00:00', $to . ' 23:59:59');
        $orders = array_filter($orders, fn($o) => $o->status === 'paid');

        $allSales = [];
        foreach ($transactions as $t) {
            $t->source = 'pos';
            $t->sale_at = $t->transaction_date ?? $t->created_at ?? null;
            $allSales[] = $t;
        }
        foreach ($orders as $o) {
            $o->source = 'order';
            $o->sale_at = $o->created_at ?? $o->transaction_date ?? null;
            $allSales[] = $o;
        }

        usort($allSales, function ($a, $b) {
            $timeA = !empty($a->sale_at) ? strtotime($a->sale_at) : 0;
            $timeB = !empty($b->sale_at) ? strtotime($b->sale_at) : 0;
            return $timeB <=> $timeA;
        });

        return $allSales;
    }

    public function __construct()
    {
        $this->requireLogin();
        $this->transactionModel = $this->model('Transaction');
        $this->purchaseModel    = $this->model('Purchase');
        $this->orderModel = $this->model('Order');
    }

    public function index()
    {
        $this->sales();
    }

    /** Sales report */
    public function sales()
    {
        $from = $_GET['from'] ?? date('Y-m-01');
        $to   = $_GET['to']   ?? date('Y-m-d');

        $allSales = $this->buildSalesData($from, $to);

        $totalSales = 0;
        foreach ($allSales as $s) $totalSales += (int)$s->total_amount;

        $this->view('reports/sales', [
            'title'        => 'Laporan Penjualan',
            'sales'        => $allSales,
            'totalSales'   => $totalSales,
            'from'         => $from,
            'to'           => $to
        ]);
    }

    /** Purchase report */
    public function purchases()
    {
        $from = $_GET['from'] ?? date('Y-m-01');
        $to   = $_GET['to']   ?? date('Y-m-d');

        $purchases = $this->purchaseModel->getByDateRange($from, $to);

        $totalPurchases = 0;
        foreach ($purchases as $p) $totalPurchases += (int)$p->total_amount;

        $this->view('reports/purchases', [
            'title'          => 'Laporan Pembelian',
            'purchases'      => $purchases,
            'totalPurchases' => $totalPurchases,
            'from'           => $from,
            'to'             => $to
        ]);
    }

    /** Export sales to CSV */
    public function exportSales()
    {
        $from = $_GET['from'] ?? date('Y-m-01');
        $to   = $_GET['to']   ?? date('Y-m-d');

        $allSales = $this->buildSalesData($from, $to);

        $filename = "laporan_penjualan_{$from}_sd_{$to}.csv";
        header('Content-Type: text/csv; charset=utf-8');
        header("Content-Disposition: attachment; filename=\"{$filename}\"");

        $out = fopen('php://output', 'w');
        fprintf($out, chr(0xEF) . chr(0xBB) . chr(0xBF));
        fputcsv($out, ['No', 'Kode', 'Tanggal', 'Sumber', 'Total', 'Bayar', 'Kembalian', 'Kasir/Pelanggan'], ';');

        $no = 1;
        foreach ($allSales as $s) {
            $saleAt = $s->sale_at ?? $s->transaction_date ?? $s->created_at ?? null;
            fputcsv($out, [
                $no++,
                $s->source === 'order' ? $s->order_code : $s->transaction_code,
                $saleAt ? date('d/m/Y H:i', strtotime($saleAt)) : '-',
                $s->source === 'order' ? 'Pesanan' : 'POS',
                (int)$s->total_amount,
                (int)$s->payment_amount,
                (int)$s->change_amount,
                $s->source === 'order' ? ($s->customer_name ?? '-') : ($s->cashier_name ?? '-')
            ], ';');
        }
        fclose($out);
        exit;
    }

    /** Export purchases to CSV */
    public function exportPurchases()
    {
        $from = $_GET['from'] ?? date('Y-m-01');
        $to   = $_GET['to']   ?? date('Y-m-d');
        $purchases = $this->purchaseModel->getByDateRange($from, $to);

        $filename = "laporan_pembelian_{$from}_sd_{$to}.csv";
        header('Content-Type: text/csv; charset=utf-8');
        header("Content-Disposition: attachment; filename=\"{$filename}\"");

        $out = fopen('php://output', 'w');
        fprintf($out, chr(0xEF) . chr(0xBB) . chr(0xBF));
        fputcsv($out, ['No', 'Kode Pembelian', 'Tanggal', 'Supplier', 'Total'], ';');

        $no = 1;
        foreach ($purchases as $p) {
            fputcsv($out, [
                $no++,
                $p->purchase_code,
                date('d/m/Y H:i', strtotime($p->purchase_date)),
                $p->supplier_name,
                (int)$p->total_amount
            ], ';');
        }
        fclose($out);
        exit;
    }

    /** Print-friendly sales report */
    public function printSales()
    {
        $from = $_GET['from'] ?? date('Y-m-01');
        $to   = $_GET['to']   ?? date('Y-m-d');

        $allSales = $this->buildSalesData($from, $to);

        $totalSales = 0;
        foreach ($allSales as $s) $totalSales += (int)$s->total_amount;

        $this->view('reports/print_sales', [
            'title'        => 'Cetak Laporan Penjualan',
            'sales'        => $allSales,
            'transactions' => $allSales,
            'totalSales'   => $totalSales,
            'from'         => $from,
            'to'           => $to
        ]);
    }

    /** Print-friendly purchase report */
    public function printPurchases()
    {
        $from = $_GET['from'] ?? date('Y-m-01');
        $to   = $_GET['to']   ?? date('Y-m-d');
        $purchases = $this->purchaseModel->getByDateRange($from, $to);

        $totalPurchases = 0;
        foreach ($purchases as $p) $totalPurchases += (int)$p->total_amount;

        $this->view('reports/print_purchases', [
            'title'          => 'Cetak Laporan Pembelian',
            'purchases'      => $purchases,
            'totalPurchases' => $totalPurchases,
            'from'           => $from,
            'to'             => $to
        ]);
    }
}
