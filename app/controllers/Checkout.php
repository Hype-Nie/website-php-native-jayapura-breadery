<?php

class Checkout extends Controller
{
    private $orderModel;
    private $productModel;
    private $customerModel;

    public function __construct()
    {
        $this->orderModel = $this->model('Order');
        $this->productModel = $this->model('Product');
        $this->customerModel = $this->model('Customer');
    }

    public function index()
    {
        if (empty($_SESSION['cart'])) {
            $this->redirect('catalog');
            return;
        }

        $cartItems = $this->getCartItems();
        $total = $this->getCartTotal($cartItems);

        $this->view('checkout/index', [
            'title' => 'Checkout',
            'cartItems' => $cartItems,
            'total' => $total
        ]);
    }

    public function process()
    {
        if (!$this->isPost()) {
            $this->redirect('checkout');
            return;
        }

        if (empty($_SESSION['cart'])) {
            $this->setFlash('danger', 'Keranjang kosong');
            $this->redirect('catalog');
            return;
        }

        $name = trim($_POST['name'] ?? '');
        $phone = trim($_POST['phone'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $address = trim($_POST['address'] ?? '');
        $notes = trim($_POST['notes'] ?? '');

        $errors = [];
        if (empty($name)) $errors[] = 'Nama wajib diisi';
        if (empty($phone)) $errors[] = 'Nomor WhatsApp wajib diisi';

        $cartItems = $this->getCartItems();
        $total = $this->getCartTotal($cartItems);

        if (!empty($errors)) {
            $this->view('checkout/index', [
                'title' => 'Checkout',
                'cartItems' => $cartItems,
                'total' => $total,
                'errors' => $errors,
                'old' => $_POST
            ]);
            return;
        }

        $orderCode = $this->orderModel->generateOrderCode();

        $customerId = null;
        $existingCustomer = $this->customerModel->findByPhone($phone);
        if ($existingCustomer) {
            $customerId = $existingCustomer->id;
        } else {
            $customerId = $this->customerModel->create([
                'name' => $name,
                'phone' => $phone,
                'email' => $email,
                'address' => $address
            ]);
        }

        $orderData = [
            'order_code' => $orderCode,
            'customer_id' => $customerId,
            'customer_name' => $name,
            'customer_phone' => $phone,
            'total_amount' => $total,
            'payment_amount' => 0,
            'change_amount' => 0,
            'status' => 'pending',
            'notes' => $notes,
            'user_id' => null
        ];

        $orderId = $this->orderModel->createWithItems($orderData, $cartItems);

        if ($orderId) {
            $_SESSION['cart'] = [];
            
            // Simpan ID pesanan di cookie selama 24 jam untuk akses cepat
            setcookie('last_order_id', $orderId, time() + (86400 * 1), "/");
            
            $this->setFlash('success', 'Pesanan berhasil dibuat - #' . $orderCode);
            $this->redirect('checkout/success/' . $orderId);
        } else {
            $this->setFlash('danger', 'Gagal memproses pesanan');
            $this->redirect('checkout');
        }
    }

    public function success($id = null)
    {
        if (!$id) {
            $this->redirect('catalog');
            return;
        }

        $order = $this->orderModel->getWithItems($id);
        if (!$order) {
            $this->redirect('catalog');
            return;
        }

        $this->view('checkout/success', [
            'title' => 'Pesanan Berhasil',
            'order' => $order
        ]);
    }

    private function getCartItems()
    {
        $items = [];
        foreach ($_SESSION['cart'] as $item) {
            $items[] = $item;
        }
        return $items;
    }

    private function getCartTotal($items)
    {
        $total = 0;
        foreach ($items as $item) {
            $total += $item['subtotal'];
        }
        return $total;
    }
}
