<?php

class Order extends Model
{
    protected $table = 'customer_orders';

    public function createWithItems($orderData, $items)
    {
        try {
            $this->db->beginTransaction();

            $this->create($orderData);
            $orderId = $this->db->lastInsertId();

            $stmtItem = $this->db->prepare("
                INSERT INTO customer_order_items
                    (order_id, product_id, product_name, barcode, quantity, price, subtotal)
                VALUES
                    (:oid, :pid, :pname, :barcode, :qty, :price, :subtotal)
            ");

            foreach ($items as $item) {
                $stmtItem->execute([
                    'oid'      => $orderId,
                    'pid'      => $item['product_id'],
                    'pname'    => $item['product_name'],
                    'barcode'  => $item['barcode'],
                    'qty'      => $item['quantity'],
                    'price'    => $item['price'],
                    'subtotal' => $item['subtotal']
                ]);
            }

            $this->db->commit();
            return $orderId;
        } catch (Exception $e) {
            $this->db->rollBack();
            return false;
        }
    }

    public function getWithItems($id)
    {
        $order = $this->find($id);
        if (!$order) return null;

        $stmt = $this->db->prepare("
            SELECT oi.id, oi.order_id, oi.product_id, oi.quantity, oi.price, oi.subtotal,
                   COALESCE(p.name, oi.product_name) as product_name,
                   COALESCE(p.barcode, oi.barcode) as barcode
            FROM customer_order_items oi
            LEFT JOIN products p ON oi.product_id = p.id
            WHERE oi.order_id = :oid
        ");
        $stmt->execute(['oid' => $id]);
        $order->items = $stmt->fetchAll();

        return $order;
    }

    public function markAsPaid($id, $paymentAmount = 0, $changeAmount = 0)
    {
        $order = $this->find($id);
        if (!$order || $order->status !== 'pending') return false;

        $orderWithItems = $this->getWithItems($id);
        if (!$orderWithItems) return false;

        try {
            $this->db->beginTransaction();

            $this->update($id, [
                'status' => 'paid',
                'payment_amount' => $paymentAmount,
                'change_amount' => $changeAmount
            ]);

            $productModel = new Product();
            foreach ($orderWithItems->items as $item) {
                if (!$productModel->updateStock($item->product_id, $item->quantity, 'decrease')) {
                    throw new Exception('Stok tidak mencukupi');
                }
            }

            $this->db->commit();
            return true;
        } catch (Exception $e) {
            $this->db->rollBack();
            return false;
        }
    }

    public function search($keyword)
    {
        $like = "%{$keyword}%";
        $stmt = $this->db->prepare("
            SELECT * FROM {$this->table}
            WHERE order_code LIKE :kw1 OR customer_name LIKE :kw2 OR customer_phone LIKE :kw3
            ORDER BY created_at DESC LIMIT 50
        ");
        $stmt->execute(['kw1' => $like, 'kw2' => $like, 'kw3' => $like]);
        return $stmt->fetchAll();
    }

    public function updateStatus($id, $status)
    {
        $valid = ['pending', 'paid', 'cancelled'];
        if (!in_array($status, $valid)) return false;
        return $this->update($id, ['status' => $status]);
    }

    public function getByStatus($status)
    {
        return $this->where('status', $status);
    }

    public function getByDateRange($from, $to)
    {
        $stmt = $this->db->prepare("
            SELECT * FROM {$this->table}
            WHERE created_at BETWEEN :from AND :to
            ORDER BY created_at DESC
        ");
        $stmt->execute(['from' => $from, 'to' => $to]);
        return $stmt->fetchAll();
    }

    public function generateOrderCode()
    {
        $date = date('Ymd');
        $stmt = $this->db->prepare("
            SELECT COUNT(*) as c FROM {$this->table}
            WHERE DATE(created_at) = CURDATE()
        ");
        $stmt->execute();
        $count = $stmt->fetch()->c + 1;
        return 'ORD-' . $date . '-' . str_pad($count, 4, '0', STR_PAD_LEFT);
    }

    public function getRecent($limit = 10)
    {
        return $this->all("created_at DESC LIMIT $limit");
    }

    public function countByStatus($status)
    {
        $stmt = $this->db->prepare("
            SELECT COUNT(*) as c FROM {$this->table} WHERE status = :s
        ");
        $stmt->execute(['s' => $status]);
        return $stmt->fetch()->c;
    }

    public function getTodayPending()
    {
        $stmt = $this->db->prepare("
            SELECT * FROM {$this->table}
            WHERE status = 'pending' AND DATE(created_at) = CURDATE()
            ORDER BY created_at DESC
        ");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function addItem($orderId, $item)
    {
        $stmt = $this->db->prepare("
            INSERT INTO customer_order_items
                (order_id, product_id, product_name, barcode, quantity, price, subtotal)
            VALUES
                (:oid, :pid, :pname, :barcode, :qty, :price, :subtotal)
        ");
        return $stmt->execute([
            'oid' => $orderId,
            'pid' => $item['product_id'],
            'pname' => $item['product_name'],
            'barcode' => $item['barcode'],
            'qty' => $item['quantity'],
            'price' => $item['price'],
            'subtotal' => $item['subtotal']
        ]);
    }
}
