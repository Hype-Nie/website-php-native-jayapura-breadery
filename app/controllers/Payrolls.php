<?php

class Payrolls extends Controller
{
    private $payrollModel;
    private $userModel;
    private $uploadDir = '../public/assets/img/payrolls/';

    public function __construct()
    {
        $this->requireAdmin();
        $this->payrollModel = $this->model('Payroll');
        $this->userModel = $this->model('User');
    }

    public function index()
    {
        $month = (int)($_GET['month'] ?? date('n'));
        $year = (int)($_GET['year'] ?? date('Y'));
        $payrolls = $this->payrollModel->getByPeriod($month, $year);
        $totalPaid = $this->payrollModel->totalByPeriod($month, $year);
        $unpaidEmployees = $this->payrollModel->getUnpaidEmployees($month, $year);

        $this->view('payrolls/index', [
            'title'             => 'Daftar Gaji',
            'payrolls'          => $payrolls,
            'month'             => $month,
            'year'              => $year,
            'totalPaid'         => $totalPaid,
            'unpaidEmployees'   => $unpaidEmployees
        ]);
    }

    public function create()
    {
        if ($this->isPost()) {
            $employeeId   = (int)($_POST['employee_id'] ?? 0);
            $periodMonth  = (int)($_POST['period_month'] ?? 0);
            $periodYear   = (int)($_POST['period_year'] ?? 0);
            $baseSalary   = (int)($_POST['base_salary'] ?? 0);
            $allowance    = (int)($_POST['allowance'] ?? 0);
            $deduction    = (int)($_POST['deduction'] ?? 0);
            $bonus        = (int)($_POST['bonus'] ?? 0);
            $notes        = trim($_POST['notes'] ?? '');

            $errors = [];
            if ($employeeId <= 0) $errors[] = 'Pilih karyawan';
            if ($periodMonth < 1 || $periodMonth > 12) $errors[] = 'Pilih bulan';
            if ($periodYear < 2020) $errors[] = 'Pilih tahun';
            if ($baseSalary <= 0) $errors[] = 'Gaji pokok harus lebih dari 0';
            if ($this->payrollModel->isDuplicate($employeeId, $periodMonth, $periodYear)) {
                $errors[] = 'Slip gaji untuk karyawan ini di periode tersebut sudah ada';
            }

            if (!empty($errors)) {
                $this->view('payrolls/create', [
                    'title'    => 'Tambah Slip Gaji',
                    'errors'   => $errors,
                    'old'      => $_POST,
                    'employees' => $this->userModel->where('role', 'karyawan')
                ]);
                return;
            }

            $totalSalary = $baseSalary + $allowance + $bonus - $deduction;

            $this->payrollModel->create([
                'employee_id'  => $employeeId,
                'period_month' => $periodMonth,
                'period_year'  => $periodYear,
                'base_salary'  => $baseSalary,
                'allowance'    => $allowance,
                'deduction'    => $deduction,
                'bonus'        => $bonus,
                'total_salary' => $totalSalary,
                'notes'        => $notes,
                'status'       => 'draft'
            ]);

            $this->setFlash('success', 'Slip gaji berhasil dibuat');
            $this->redirect('payrolls');
        }

        $this->view('payrolls/create', [
            'title'     => 'Tambah Slip Gaji',
            'employees' => $this->userModel->where('role', 'karyawan')
        ]);
    }

    public function edit($id = null)
    {
        if (!$id) $this->redirect('payrolls');

        $payroll = $this->payrollModel->find($id);
        if (!$payroll) $this->redirect('payrolls');

        if ($payroll->status === 'paid') {
            $this->setFlash('warning', 'Slip gaji yang sudah dibayar tidak dapat diedit');
            $this->redirect('payrolls');
        }

        if ($this->isPost()) {
            $employeeId   = (int)($_POST['employee_id'] ?? 0);
            $periodMonth  = (int)($_POST['period_month'] ?? 0);
            $periodYear   = (int)($_POST['period_year'] ?? 0);
            $baseSalary   = (int)($_POST['base_salary'] ?? 0);
            $allowance    = (int)($_POST['allowance'] ?? 0);
            $deduction    = (int)($_POST['deduction'] ?? 0);
            $bonus        = (int)($_POST['bonus'] ?? 0);
            $notes        = trim($_POST['notes'] ?? '');

            $errors = [];
            if ($employeeId <= 0) $errors[] = 'Pilih karyawan';
            if ($periodMonth < 1 || $periodMonth > 12) $errors[] = 'Pilih bulan';
            if ($periodYear < 2020) $errors[] = 'Pilih tahun';
            if ($baseSalary <= 0) $errors[] = 'Gaji pokok harus lebih dari 0';
            if ($this->payrollModel->isDuplicate($employeeId, $periodMonth, $periodYear, $id)) {
                $errors[] = 'Slip gaji untuk karyawan ini di periode tersebut sudah ada';
            }

            if (!empty($errors)) {
                $payroll->employee_id  = $employeeId;
                $payroll->period_month = $periodMonth;
                $payroll->period_year  = $periodYear;
                $payroll->base_salary  = $baseSalary;
                $payroll->allowance    = $allowance;
                $payroll->deduction    = $deduction;
                $payroll->bonus        = $bonus;
                $payroll->notes        = $notes;

                $this->view('payrolls/edit', [
                    'title'    => 'Edit Slip Gaji',
                    'payroll'  => $payroll,
                    'errors'   => $errors,
                    'employees' => $this->userModel->where('role', 'karyawan')
                ]);
                return;
            }

            $totalSalary = $baseSalary + $allowance + $bonus - $deduction;

            $this->payrollModel->update($id, [
                'employee_id'  => $employeeId,
                'period_month' => $periodMonth,
                'period_year'  => $periodYear,
                'base_salary'  => $baseSalary,
                'allowance'    => $allowance,
                'deduction'    => $deduction,
                'bonus'        => $bonus,
                'total_salary' => $totalSalary,
                'notes'        => $notes
            ]);

            $this->setFlash('success', 'Slip gaji berhasil diperbarui');
            $this->redirect('payrolls');
        }

        $this->view('payrolls/edit', [
            'title'     => 'Edit Slip Gaji',
            'payroll'   => $payroll,
            'employees' => $this->userModel->where('role', 'karyawan')
        ]);
    }

    public function delete($id = null)
    {
        if (!$id || !$this->isPost()) $this->redirect('payrolls');

        $payroll = $this->payrollModel->find($id);
        if (!$payroll) $this->redirect('payrolls');

        if ($payroll->status === 'paid') {
            $this->setFlash('danger', 'Slip gaji yang sudah dibayar tidak dapat dihapus');
            $this->redirect('payrolls');
        }

        $this->payrollModel->delete($id);
        $this->setFlash('success', 'Slip gaji berhasil dihapus');
        $this->redirect('payrolls');
    }

    public function pay($id = null)
    {
        if (!$id || !$this->isPost()) $this->redirect('payrolls');

        $payroll = $this->payrollModel->find($id);
        if (!$payroll) {
            $this->setFlash('danger', 'Slip gaji tidak ditemukan');
            $this->redirect('payrolls');
        }

        if ($payroll->status === 'paid') {
            $this->setFlash('warning', 'Slip gaji sudah dibayar');
            $this->redirect('payrolls');
        }

        $errors = [];

        if (empty($_FILES['transfer_proof']['name'])) {
            $errors[] = 'Bukti transfer wajib diupload';
        } else {
            $proofName = $this->uploadTransferProof($id, $errors);
            if (empty($errors) && $proofName) {
                $this->payrollModel->update($id, [
                    'status'         => 'paid',
                    'payment_date'   => date('Y-m-d'),
                    'transfer_proof' => $proofName
                ]);
                $this->setFlash('success', 'Pembayaran berhasil dicatat');
            }
        }

        if (!empty($errors)) {
            $this->setFlash('danger', implode(', ', $errors));
        }

        $this->redirect('payrolls');
    }

    public function undoPay($id = null)
    {
        if (!$id || !$this->isPost()) $this->redirect('payrolls');

        $payroll = $this->payrollModel->find($id);
        if (!$payroll) {
            $this->setFlash('danger', 'Slip gaji tidak ditemukan');
            $this->redirect('payrolls');
        }

        if ($payroll->status !== 'paid') {
            $this->setFlash('warning', 'Slip gaji belum dibayar');
            $this->redirect('payrolls');
        }

        if (!empty($payroll->transfer_proof)) {
            $filePath = $this->uploadDir . $payroll->transfer_proof;
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        $this->payrollModel->update($id, [
            'status'         => 'draft',
            'payment_date'   => null,
            'transfer_proof' => null
        ]);

        $this->setFlash('success', 'Status pembayaran dibatalkan');
        $this->redirect('payrolls');
    }

    public function print($id = null)
    {
        if (!$id) $this->redirect('payrolls');

        $payroll = $this->payrollModel->find($id);
        if (!$payroll) $this->redirect('payrolls');

        $employee = $this->userModel->find($payroll->employee_id);

        $this->view('payrolls/print', [
            'title'    => 'Cetak Slip Gaji',
            'payroll'  => $payroll,
            'employee' => $employee
        ]);
    }

    private function uploadTransferProof($payrollId, &$errors)
    {
        $file = $_FILES['transfer_proof'];
        $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'application/pdf'];
        $maxSize = 5 * 1024 * 1024;

        if ($file['error'] !== UPLOAD_ERR_OK) {
            $errors[] = 'Gagal mengupload file';
            return null;
        }

        if (!in_array($file['type'], $allowedTypes)) {
            $errors[] = 'Format file harus jpg, png, atau pdf';
            return null;
        }

        if ($file['size'] > $maxSize) {
            $errors[] = 'Ukuran file maksimal 5MB';
            return null;
        }

        if (!is_dir($this->uploadDir)) {
            mkdir($this->uploadDir, 0755, true);
        }

        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $fileName = 'payroll_' . $payrollId . '_' . time() . '.' . $extension;

        if (!move_uploaded_file($file['tmp_name'], $this->uploadDir . $fileName)) {
            $errors[] = 'Gagal menyimpan file';
            return null;
        }

        return $fileName;
    }
}
