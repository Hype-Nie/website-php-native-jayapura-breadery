<?php

class Orders extends Controller
{
    private $orderModel;
    private $productModel;

    public function __construct()
    {
        $this->requireEmployee();
        $this->orderModel = $this->model('Order');
        $this->productModel = $this->model('Product');
        $this->db = Database::getInstance()->getConnection();
    }

    public function index()
    {
        $status = $_GET['status'] ?? '';
        $search = trim($_GET['q'] ?? '');

        if ($search) {
            $orders = $this->orderModel->search($search);
        } elseif ($status) {
            $orders = $this->orderModel->getByStatus($status);
        } else {
            $orders = $this->orderModel->all('created_at DESC');
        }

        $pendingCount = $this->orderModel->countByStatus('pending');
        $paidCount = $this->orderModel->countByStatus('paid');

        $this->view('orders/index', [
            'title' => 'Pesanan Pelanggan',
            'orders' => $orders,
            'status' => $status,
            'search' => $search,
            'pendingCount' => $pendingCount,
            'paidCount' => $paidCount
        ]);
    }

    public function search()
    {
        $keyword = trim($_GET['q'] ?? '');
        if (strlen($keyword) < 1) {
            $this->jsonResponse(['success' => true, 'orders' => []]);
            return;
        }

        $orders = $this->orderModel->search($keyword);
        $result = [];
        foreach ($orders as $o) {
            $result[] = [
                'id' => (int)$o->id,
                'order_code' => $o->order_code,
                'customer_name' => $o->customer_name,
                'customer_phone' => $o->customer_phone,
                'total_amount' => (int)$o->total_amount,
                'status' => $o->status,
                'created_at' => $o->created_at
            ];
        }
        $this->jsonResponse(['success' => true, 'orders' => $result]);
    }

    public function detail($id = null)
    {
        if (!$id) $this->redirect('orders');

        $order = $this->orderModel->getWithItems($id);
        if (!$order) $this->redirect('orders');

        $this->view('orders/detail', [
            'title' => 'Detail Pesanan',
            'order' => $order
        ]);
    }

    public function processPayment()
    {
        if (!$this->isPost()) {
            $this->redirect('orders');
            return;
        }

        $id = (int)($_POST['id'] ?? 0);
        $paymentAmount = (float)($_POST['payment_amount'] ?? 0);

        $order = $this->orderModel->find($id);
        if (!$order) {
            $this->setFlash('danger', 'Pesanan tidak ditemukan');
            $this->redirect('orders');
            return;
        }

        if ($order->status !== 'pending') {
            $this->setFlash('danger', 'Pesanan sudah diproses');
            $this->redirect('orders');
            return;
        }

        if ($paymentAmount < $order->total_amount) {
            $this->setFlash('danger', 'Jumlah bayar tidak mencukupi');
            $this->redirect('orders/detail/' . $id);
            return;
        }

        $changeAmount = $paymentAmount - $order->total_amount;

        if ($this->orderModel->markAsPaid($id, $paymentAmount, $changeAmount)) {
            $this->setFlash('success', 'Pembayaran pesanan #' . $order->order_code . ' berhasil');
        } else {
            $this->setFlash('danger', 'Gagal memproses pembayaran');
        }

        $this->redirect('orders/detail/' . $id);
    }

    public function markPaid()
    {
        if (!$this->isPost()) $this->redirect('orders');

        $id = (int)($_POST['id'] ?? 0);
        $paymentAmount = (float)($_POST['payment_amount'] ?? 0);
        $changeAmount = (float)($_POST['change_amount'] ?? 0);

        $order = $this->orderModel->find($id);
        if (!$order) {
            $this->setFlash('danger', 'Pesanan tidak ditemukan');
            $this->redirect('orders');
            return;
        }

        if ($order->status !== 'pending') {
            $this->setFlash('danger', 'Pesanan sudah diproses');
            $this->redirect('orders');
            return;
        }

        if ($paymentAmount <= 0) {
            $this->setFlash('danger', 'Jumlah bayar tidak valid');
            $this->redirect('orders/detail/' . $id);
            return;
        }

        if ($this->orderModel->markAsPaid($id, $paymentAmount, $changeAmount)) {
            $this->setFlash('success', 'Pesanan #' . $order->order_code . ' lunas');
        } else {
            $this->setFlash('danger', 'Gagal memproses pesanan');
        }

        $this->redirect('orders');
    }

    public function cancel()
    {
        if (!$this->isPost()) $this->redirect('orders');

        $id = (int)($_POST['id'] ?? 0);
        $order = $this->orderModel->find($id);

        if (!$order) {
            $this->setFlash('danger', 'Pesanan tidak ditemukan');
            $this->redirect('orders');
            return;
        }

        if ($order->status === 'cancelled') {
            $this->setFlash('danger', 'Pesanan sudah dibatalkan');
            $this->redirect('orders');
            return;
        }

        if ($order->status === 'paid') {
            $this->setFlash('danger', 'Pesanan sudah lunas, tidak dapat dibatalkan');
            $this->redirect('orders');
            return;
        }

        $this->orderModel->updateStatus($id, 'cancelled');
        $this->setFlash('success', 'Pesanan #' . $order->order_code . ' dibatalkan');
        $this->redirect('orders');
    }

    public function addItem()
    {
        if (!$this->isPost()) $this->redirect('orders');

        $orderId = (int)($_POST['order_id'] ?? 0);
        $productId = (int)($_POST['product_id'] ?? 0);
        $quantity = max(1, (int)($_POST['quantity'] ?? 1));

        $order = $this->orderModel->find($orderId);
        if (!$order || $order->status !== 'pending') {
            $this->jsonResponse(['success' => false, 'message' => 'Pesanan tidak valid']);
            return;
        }

        $product = $this->productModel->find($productId);
        if (!$product) {
            $this->jsonResponse(['success' => false, 'message' => 'Produk tidak ditemukan']);
            return;
        }

        if ($product->stock < $quantity) {
            $this->jsonResponse(['success' => false, 'message' => 'Stok tidak mencukupi']);
            return;
        }

        $result = $this->orderModel->addItem($orderId, [
            'product_id' => $product->id,
            'product_name' => $product->name,
            'barcode' => $product->barcode,
            'quantity' => $quantity,
            'price' => $product->price,
            'subtotal' => $quantity * $product->price
        ]);

        if ($result) {
            $this->recalculateOrderTotal($orderId);
            $this->jsonResponse(['success' => true, 'message' => 'Produk ditambahkan']);
        } else {
            $this->jsonResponse(['success' => false, 'message' => 'Gagal menambahkan produk']);
        }
    }

    public function updateItem()
    {
        if (!$this->isPost()) $this->redirect('orders');

        $orderId = (int)($_POST['order_id'] ?? 0);
        $itemId = (int)($_POST['item_id'] ?? 0);
        $quantity = max(1, (int)($_POST['quantity'] ?? 1));

        $order = $this->orderModel->find($orderId);
        if (!$order || $order->status !== 'pending') {
            $this->jsonResponse(['success' => false, 'message' => 'Pesanan tidak valid']);
            return;
        }

        $stmt = $this->db->prepare("SELECT * FROM customer_order_items WHERE id = :id AND order_id = :oid");
        $stmt->execute(['id' => $itemId, 'oid' => $orderId]);
        $item = $stmt->fetch();
        if (!$item) {
            $this->jsonResponse(['success' => false, 'message' => 'Item tidak ditemukan']);
            return;
        }

        $product = $this->productModel->find($item->product_id);
        if ($product && $product->stock < $quantity) {
            $this->jsonResponse(['success' => false, 'message' => 'Stok tidak mencukupi']);
            return;
        }

        $subtotal = $item->price * $quantity;
        $stmt2 = $this->db->prepare("UPDATE customer_order_items SET quantity = :qty, subtotal = :sub WHERE id = :id");
        $stmt2->execute(['qty' => $quantity, 'sub' => $subtotal, 'id' => $itemId]);
        $this->recalculateOrderTotal($orderId);

        $this->jsonResponse(['success' => true, 'message' => 'Jumlah diperbarui']);
    }

    public function removeItem()
    {
        if (!$this->isPost()) $this->redirect('orders');

        $orderId = (int)($_POST['order_id'] ?? 0);
        $itemId = (int)($_POST['item_id'] ?? 0);

        $order = $this->orderModel->find($orderId);
        if (!$order || $order->status !== 'pending') {
            $this->setFlash('danger', 'Pesanan tidak valid');
            $this->redirect('orders');
            return;
        }

        $stmt3 = $this->db->prepare("DELETE FROM customer_order_items WHERE id = :id AND order_id = :oid");
        $stmt3->execute(['id' => $itemId, 'oid' => $orderId]);
        $this->recalculateOrderTotal($orderId);

        $this->setFlash('success', 'Item dihapus');
        $this->redirect('orders/detail/' . $orderId);
    }

    private function recalculateOrderTotal($orderId)
    {
        $stmt4 = $this->db->prepare("SELECT SUM(subtotal) as total FROM customer_order_items WHERE order_id = :oid");
        $stmt4->execute(['oid' => $orderId]);
        $items = $stmt4->fetch();
        $total = $items->total ?? 0;
        $stmt5 = $this->db->prepare("UPDATE customer_orders SET total_amount = :t WHERE id = :id");
        $stmt5->execute(['t' => $total, 'id' => $orderId]);
    }

    public function today()
    {
        $orders = $this->orderModel->getTodayPending();

        $this->view('orders/today', [
            'title' => 'Pesanan Hari Ini',
            'orders' => $orders
        ]);
    }
}
