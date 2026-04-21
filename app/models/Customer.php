<?php

class Customer extends Model
{
    protected $table = 'customers';

    public function findByPhone($phone)
    {
        return $this->findWhere('phone', $phone);
    }

    public function findByEmail($email)
    {
        return $this->findWhere('email', $email);
    }

    public function search($keyword)
    {
        $like = "%{$keyword}%";
        $stmt = $this->db->prepare("
            SELECT * FROM {$this->table}
            WHERE name LIKE :kw1 OR phone LIKE :kw2 OR email LIKE :kw3
            ORDER BY name ASC LIMIT 50
        ");
        $stmt->execute(['kw1' => $like, 'kw2' => $like, 'kw3' => $like]);
        return $stmt->fetchAll();
    }

    public function updateOrderCount($id)
    {
        return $this->db->query("
            UPDATE {$this->table} SET order_count = order_count + 1 WHERE id = :id
        ");
    }
}
