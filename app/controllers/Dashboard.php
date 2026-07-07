<?php

class Dashboard extends Controller
{
    public function index()
    {
        $this->requireLogin();

        $transactionModel = $this->model('Transaction');
        $productModel = $this->model('Product');
        $purchaseModel = $this->model('Purchase');
        $orderModel = $this->model('Order');

        $data = [
            'title'              => 'Dashboard',
            'todaySales'         => $transactionModel->getTodaySales(),
            'todayTransactions'  => $transactionModel->getTodayCount(),
            'monthlyTotal'       => $transactionModel->getMonthlyTotal(),
            'monthlyPurchases'   => $purchaseModel->getMonthlyTotal(),
            'totalProducts'      => $productModel->countAll(),
            'lowStockProducts'   => $productModel->getLowStock(10),
            'recentTransactions' => $transactionModel->getRecent(5),
            'recentOrders'       => $orderModel->getRecent(5),
            'dailySales'         => $transactionModel->getDailySales(7),
            'pendingOrders'      => $orderModel->countByStatus('pending')
        ];

        // Add payroll summary for admin
        if ($this->auth()['role'] === 'admin') {
            $payrollModel = $this->model('Payroll');
            $userModel = $this->model('User');

            $currentMonth = (int)date('n');
            $currentYear = (int)date('Y');
            $totalEmployees = count($userModel->where('role', 'karyawan'));
            $paidCount = $payrollModel->countByPeriod($currentMonth, $currentYear, 'paid');
            $draftCount = $payrollModel->countByPeriod($currentMonth, $currentYear, 'draft');
            $totalPaid = $payrollModel->totalByPeriod($currentMonth, $currentYear);
            $unpaidEmployees = $payrollModel->getUnpaidEmployees($currentMonth, $currentYear);

            $data['payrollSummary'] = [
                'month'          => $currentMonth,
                'year'           => $currentYear,
                'totalEmployees' => $totalEmployees,
                'paidCount'      => $paidCount,
                'draftCount'     => $draftCount,
                'unpaidCount'    => count($unpaidEmployees),
                'totalPaid'      => $totalPaid,
                'unpaidList'     => array_slice($unpaidEmployees, 0, 3)
            ];
        } elseif ($this->auth()['role'] === 'karyawan') {
            $payrollModel = $this->model('Payroll');
            $currentMonth = (int)date('n');
            $currentYear = (int)date('Y');
            $employeeId = $this->auth()['id'];

            $data['latestPaid'] = $payrollModel->getLatestPaid($employeeId);
            $data['currentMonthPayroll'] = $payrollModel->getCurrentMonthStatus($employeeId, $currentMonth, $currentYear);

            $showAllPayrolls = isset($_GET['show_all_payrolls']) && $_GET['show_all_payrolls'] == '1';
            $limit = $showAllPayrolls ? 1000 : 5;
            $data['payrollHistory'] = $payrollModel->getByEmployeeAll($employeeId, $limit);
            $data['showAllPayrolls'] = $showAllPayrolls;
            $data['hasMorePayrolls'] = count($payrollModel->getByEmployeeAll($employeeId, 6)) > 5;
            $data['currentMonth'] = $currentMonth;
            $data['currentYear'] = $currentYear;
        }

        $this->view('dashboard/index', $data);
    }
}
