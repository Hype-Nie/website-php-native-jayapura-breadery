<?php

class Catalog extends Controller
{
    private $productModel;

    public function __construct()
    {
        $this->productModel = $this->model('Product');
    }

    public function index()
    {
        $category = $_GET['category'] ?? '';
        $search = trim($_GET['q'] ?? '');

        if ($search) {
            $products = $this->productModel->search($search);
        } elseif ($category) {
            $products = $this->productModel->where('category', $category);
        } else {
            $products = $this->productModel->all('name ASC');
        }

        $categories = $this->productModel->getCategories();

        $this->view('catalog/index', [
            'title' => 'Katalog Produk',
            'products' => $products,
            'categories' => $categories,
            'selectedCategory' => $category,
            'search' => $search
        ]);
    }

    public function search()
    {
        $keyword = trim($_GET['q'] ?? '');
        if (empty($keyword)) {
            echo json_encode([]);
            return;
        }

        $products = $this->productModel->search($keyword);
        $this->jsonResponse($products);
    }

    public function barcode($barcode)
    {
        $product = $this->productModel->findByBarcode($barcode);
        if ($product) {
            $this->jsonResponse([
                'found' => true,
                'product' => $product
            ]);
        } else {
            $this->jsonResponse([
                'found' => false,
                'message' => 'Produk tidak ditemukan'
            ]);
        }
    }

    public function detail($id = null)
    {
        if (!$id) {
            $this->redirect('catalog');
        }

        $product = $this->productModel->find($id);
        if (!$product) {
            $this->redirect('catalog');
        }

        $imgModel = $this->model('ProductImage');
        $productImages = $imgModel->where('product_id', $id) ?: [];

        $this->view('catalog/detail', [
            'title' => $product->name,
            'product' => $product,
            'productImages' => $productImages
        ]);
    }
}
