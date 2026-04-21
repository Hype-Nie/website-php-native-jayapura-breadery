<?php

class Cart extends Controller
{
    private $productModel;

    public function __construct()
    {
        $this->productModel = $this->model('Product');
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
    }

    public function index()
    {
        $cartItems = $this->getCartItems();
        $total = $this->getCartTotal($cartItems);

        $this->view('cart/index', [
            'title' => 'Keranjang',
            'cartItems' => $cartItems,
            'total' => $total
        ]);
    }

    public function add()
    {
        $productId = (int)($_POST['product_id'] ?? 0);
        $quantity = max(1, (int)($_POST['quantity'] ?? 1));

        $product = $this->productModel->find($productId);
        if (!$product) {
            if ($this->isAjax()) {
                $this->jsonResponse(['success' => false, 'message' => 'Produk tidak ditemukan']);
            } else {
                $this->setFlash('danger', 'Produk tidak ditemukan');
                $this->redirect('catalog');
            }
            return;
        }

        if ($product->stock < $quantity) {
            if ($this->isAjax()) {
                $this->jsonResponse(['success' => false, 'message' => 'Stok tidak mencukupi']);
            } else {
                $this->setFlash('danger', 'Stok tidak mencukupi');
                $this->redirect('catalog');
            }
            return;
        }

        if (isset($_SESSION['cart'][$productId])) {
            $newQty = $_SESSION['cart'][$productId]['quantity'] + $quantity;
            if ($product->stock < $newQty) {
                if ($this->isAjax()) {
                    $this->jsonResponse(['success' => false, 'message' => 'Stok tidak mencukupi']);
                } else {
                    $this->setFlash('danger', 'Stok tidak mencukupi');
                    $this->redirect('catalog');
                }
                return;
            }
            $_SESSION['cart'][$productId]['quantity'] = $newQty;
            $_SESSION['cart'][$productId]['subtotal'] = $newQty * $product->price;
        } else {
            $_SESSION['cart'][$productId] = [
                'product_id' => $product->id,
                'product_name' => $product->name,
                'barcode' => $product->barcode,
                'price' => $product->price,
                'image' => $product->image,
                'quantity' => $quantity,
                'subtotal' => $quantity * $product->price,
                'stock' => $product->stock
            ];
        }

        $cartCount = count($_SESSION['cart']);

        if ($this->isAjax()) {
            $this->jsonResponse([
                'success' => true,
                'message' => 'Produk ditambahkan ke keranjang',
                'cart_count' => $cartCount,
                'item' => $_SESSION['cart'][$productId]
            ]);
        } else {
            $this->setFlash('success', 'Produk ditambahkan ke keranjang');
            $this->redirect('catalog');
        }
    }

    public function update()
    {
        if (!$this->isAjax()) {
            $this->redirect('catalog');
            return;
        }

        $productId = (int)($_POST['product_id'] ?? 0);
        $quantity = (int)($_POST['quantity'] ?? 0);

        if (!isset($_SESSION['cart'][$productId])) {
            $this->jsonResponse(['success' => false, 'message' => 'Item tidak ada di keranjang']);
            return;
        }

        if ($quantity <= 0) {
            return $this->remove();
        }

        $product = $this->productModel->find($productId);
        if ($product->stock < $quantity) {
            $this->jsonResponse(['success' => false, 'message' => 'Stok tidak mencukupi']);
            return;
        }

        $_SESSION['cart'][$productId]['quantity'] = $quantity;
        $_SESSION['cart'][$productId]['subtotal'] = $quantity * $product->price;

        $this->jsonResponse([
            'success' => true,
            'message' => 'Keranjang diperbarui',
            'item' => $_SESSION['cart'][$productId]
        ]);
    }

    public function remove()
    {
        if (!$this->isAjax()) {
            $this->redirect('cart');
            return;
        }

        $productId = (int)($_POST['product_id'] ?? 0);

        if (isset($_SESSION['cart'][$productId])) {
            unset($_SESSION['cart'][$productId]);
        }

        $cartCount = count($_SESSION['cart']);
        $this->jsonResponse([
            'success' => true,
            'message' => 'Item dihapus',
            'cart_count' => $cartCount
        ]);
    }

    public function clear()
    {
        $_SESSION['cart'] = [];
        $this->redirect('catalog');
    }

    private function getCartItems()
    {
        $items = [];
        foreach ($_SESSION['cart'] as $productId => $item) {
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
