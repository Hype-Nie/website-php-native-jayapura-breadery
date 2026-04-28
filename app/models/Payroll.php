<?php

class Payroll extends Model
{
    protected $table = 'payrolls';

    public function getByPeriod($month, $year)
    {
        $stmt = $this->db->prepare("
            SELECT p.*, u.name as employee_name, u.username
            FROM {$this->table} p
            JOIN users u ON p.employee_id = u.id
            WHERE p.period_month = :month AND p.period_year = :year
            ORDER BY u.name ASC
        ");
        $stmt->execute(['month' => $month, 'year' => $year]);
        return $stmt->fetchAll();
    }

    public function getByEmployee($employeeId, $year)
    {
        $stmt = $this->db->prepare("
            SELECT p.*, u.name as employee_name
            FROM {$this->table} p
            JOIN users u ON p.employee_id = u.id
            WHERE p.employee_id = :empId AND p.period_year = :year
            ORDER BY p.period_month DESC
        ");
        $stmt->execute(['empId' => $employeeId, 'year' => $year]);
        return $stmt->fetchAll();
    }

    public function getByEmployeeAll($employeeId, $limit = 12)
    {
        $stmt = $this->db->prepare("
            SELECT p.*, u.name as employee_name
            FROM {$this->table} p
            JOIN users u ON p.employee_id = u.id
            WHERE p.employee_id = :empId
            ORDER BY p.period_year DESC, p.period_month DESC
            LIMIT :limit
        ");
        $stmt->bindValue(':empId', $employeeId, PDO::PARAM_INT);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getLatestPaid($employeeId)
    {
        $stmt = $this->db->prepare("
            SELECT * FROM {$this->table}
            WHERE employee_id = :empId AND status = 'paid'
            ORDER BY period_year DESC, period_month DESC
            LIMIT 1
        ");
        $stmt->execute(['empId' => $employeeId]);
        return $stmt->fetch();
    }

    public function getCurrentMonthStatus($employeeId, $month, $year)
    {
        $stmt = $this->db->prepare("
            SELECT * FROM {$this->table}
            WHERE employee_id = :empId AND period_month = :month AND period_year = :year
            LIMIT 1
        ");
        $stmt->execute(['empId' => $employeeId, 'month' => $month, 'year' => $year]);
        return $stmt->fetch();
    }

    public function countByPeriod($month, $year, $status = null)
    {
        $sql = "SELECT COUNT(*) as total FROM {$this->table} WHERE period_month = :month AND period_year = :year";
        $params = ['month' => $month, 'year' => $year];

        if ($status) {
            $sql .= " AND status = :status";
            $params['status'] = $status;
        }

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetch()->total;
    }

    public function totalByPeriod($month, $year)
    {
        $stmt = $this->db->prepare("
            SELECT COALESCE(SUM(total_salary), 0) as total
            FROM {$this->table}
            WHERE period_month = :month AND period_year = :year AND status = 'paid'
        ");
        $stmt->execute(['month' => $month, 'year' => $year]);
        return $stmt->fetch()->total;
    }

    public function getUnpaidEmployees($month, $year)
    {
        $stmt = $this->db->prepare("
            SELECT u.id, u.name, u.username
            FROM users u
            WHERE u.role = 'karyawan'
            AND u.id NOT IN (
                SELECT employee_id FROM {$this->table}
                WHERE period_month = :month AND period_year = :year
            )
            ORDER BY u.name ASC
        ");
        $stmt->execute(['month' => $month, 'year' => $year]);
        return $stmt->fetchAll();
    }

    public function isDuplicate($employeeId, $month, $year, $excludeId = null)
    {
        $sql = "SELECT COUNT(*) as c FROM {$this->table} WHERE employee_id = :empId AND period_month = :month AND period_year = :year";
        $params = ['empId' => $employeeId, 'month' => $month, 'year' => $year];

        if ($excludeId) {
            $sql .= " AND id != :excludeId";
            $params['excludeId'] = $excludeId;
        }

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetch()->c > 0;
    }

    public function getAllPayrolls($limit = 100)
    {
        $stmt = $this->db->prepare("
            SELECT p.*, u.name as employee_name, u.username
            FROM {$this->table} p
            JOIN users u ON p.employee_id = u.id
            ORDER BY p.period_year DESC, p.period_month DESC, u.name ASC
            LIMIT :limit
        ");
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getTotalPaidAll()
    {
        $stmt = $this->db->prepare("
            SELECT COALESCE(SUM(total_salary), 0) as total
            FROM {$this->table}
            WHERE status = 'paid'
        ");
        $stmt->execute();
        return $stmt->fetch()->total;
    }
}
