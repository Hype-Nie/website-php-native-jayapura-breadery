<?php

class Products extends Controller
{
    private $productModel;
    private $categoryModel;

    public function __construct()
    {
        $this->requireLogin();
        $this->productModel  = $this->model('Product');
        $this->categoryModel = $this->model('Category');
    }

    public function index()
    {
        $search = trim($_GET['q'] ?? '');
        $products = $search
            ? $this->productModel->search($search)
            : $this->productModel->all('name ASC');

        $this->view('products/index', [
            'title'    => 'Daftar Produk',
            'products' => $products,
            'search'   => $search
        ]);
    }

    public function add()
    {
        if ($this->isPost()) {
            $barcode     = trim($_POST['barcode'] ?? '');
            $name        = trim($_POST['name'] ?? '');
            $category_id = (int)($_POST['category_id'] ?? 0);
            $price       = (int)($_POST['price'] ?? 0);
            $stock       = (int)($_POST['stock'] ?? 0);
            $description = trim($_POST['description'] ?? '');
            $errors = [];

            $categoryName = '';
            if ($category_id > 0) {
                $cat = $this->categoryModel->find($category_id);
                $categoryName = $cat ? $cat->name : '';
            }

            $imageName = '';
            $uploadedImages = [];
            if (!empty($_FILES['images']['name'][0])) {
                $uploadDir = '../public/assets/img/products/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }
                
                foreach ($_FILES['images']['name'] as $i => $fileName) {
                    if ($_FILES['images']['error'][$i] === UPLOAD_ERR_OK) {
                        $tmpName = $_FILES['images']['tmp_name'][$i];
                        $newName = time() . '_' . $i . '_' . basename($fileName);
                        $uploadFile = $uploadDir . $newName;
                        if (move_uploaded_file($tmpName, $uploadFile)) {
                            $uploadedImages[] = $newName;
                        } else {
                            $errors[] = 'Gagal mengupload gambar: ' . $fileName;
                        }
                    }
                }
            }
            if (empty($uploadedImages)) {
                // fall back to old 'image' input if used
                if (!empty($_FILES['image']['name'])) {
                    $uploadDir = '../public/assets/img/products/';
                    if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);
                    $imageName = time() . '_' . basename($_FILES['image']['name']);
                    $uploadFile = $uploadDir . $imageName;
                    if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
                        $uploadedImages[] = $imageName;
                    }
                }
            }
            if (count($uploadedImages) > 0) {
                $imageName = $uploadedImages[0];
                if (!empty($_POST['primary_image'])) {
                    $postedPrimary = $_POST['primary_image'];
                    if (strpos($postedPrimary, '__NEW_') === 0) {
                        $idx = (int) str_replace(['__NEW_', '__'], '', $postedPrimary);
                        if (isset($uploadedImages[$idx])) {
                            $imageName = $uploadedImages[$idx];
                        }
                    }
                }
            }

            if (empty($barcode)) $errors[] = 'Barcode wajib diisi';
            if (empty($name))    $errors[] = 'Nama produk wajib diisi';
            if ($price <= 0)     $errors[] = 'Harga harus lebih dari 0';
            if ($stock < 0)      $errors[] = 'Stok tidak boleh negatif';
            if ($this->productModel->barcodeExists($barcode)) {
                $errors[] = 'Barcode sudah digunakan';
            }

            if (!empty($errors)) {
                $this->view('products/add', [
                    'title'      => 'Tambah Produk',
                    'errors'     => $errors,
                    'old'        => $_POST,
                    'categories' => $this->categoryModel->all('name ASC')
                ]);
                return;
            }

            $productId = $this->productModel->create([
                'barcode'     => $barcode,
                'name'        => $name,
                'description' => $description,
                'category_id' => $category_id ?: null,
                'category'    => $categoryName,
                'price'       => $price,
                'stock'       => $stock,
                'image'       => $imageName,
            ]);

            // Save multiple images to product_images
            if ($productId && !empty($uploadedImages)) {
                $imgModel = $this->model('ProductImage');
                foreach ($uploadedImages as $idx => $img) {
                    $imgModel->create([
                        'product_id' => $productId,
                        'image' => $img,
                        'is_primary' => ($imageName === $img) ? 1 : 0
                    ]);
                }
            }

            $this->setFlash('success', 'Produk berhasil ditambahkan');
            $this->redirect('products');
        }

        $this->view('products/add', [
            'title'      => 'Tambah Produk',
            'categories' => $this->categoryModel->all('name ASC')
        ]);
    }

    public function edit($id = null)
    {
        if (!$id) $this->redirect('products');

        $product = $this->productModel->find($id);
        if (!$product) $this->redirect('products');

        if ($this->isPost()) {
            $barcode     = trim($_POST['barcode'] ?? '');
            $name        = trim($_POST['name'] ?? '');
            $category_id = (int)($_POST['category_id'] ?? 0);
            $price       = (int)($_POST['price'] ?? 0);
            $stock       = (int)($_POST['stock'] ?? 0);
            $description = trim($_POST['description'] ?? '');
            $errors = [];

            $categoryName = '';
            if ($category_id > 0) {
                $cat = $this->categoryModel->find($category_id);
                $categoryName = $cat ? $cat->name : '';
            }

            $imageName = $product->image ?? '';
            $uploadedImages = [];
            if (!empty($_FILES['images']['name'][0])) {
                $uploadDir = '../public/assets/img/products/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }
                foreach ($_FILES['images']['name'] as $i => $fileName) {
                    if ($_FILES['images']['error'][$i] === UPLOAD_ERR_OK) {
                        $tmpName = $_FILES['images']['tmp_name'][$i];
                        $newName = time() . '_' . $i . '_' . basename($fileName);
                        $uploadFile = $uploadDir . $newName;
                        if (move_uploaded_file($tmpName, $uploadFile)) {
                            $uploadedImages[] = $newName;
                        }
                    }
                }
            }
            if (count($uploadedImages) > 0) {
                // If there are new uploads, default to the first one as primary, unless the user picked an existing one
                $imageName = $uploadedImages[0];
            }

            // If user selected an existing image or a new one as primary from the UI
            if (!empty($_POST['primary_image'])) {
                $postedPrimary = $_POST['primary_image'];
                if (strpos($postedPrimary, '__NEW_') === 0) {
                    $idx = (int) str_replace(['__NEW_', '__'], '', $postedPrimary);
                    if (isset($uploadedImages[$idx])) {
                        $imageName = $uploadedImages[$idx];
                    }
                } else {
                    $imageName = $postedPrimary;
                }
            }
            if (empty($barcode)) $errors[] = 'Barcode wajib diisi';
            if (empty($name))    $errors[] = 'Nama produk wajib diisi';
            if ($price <= 0)     $errors[] = 'Harga harus lebih dari 0';
            if ($stock < 0)      $errors[] = 'Stok tidak boleh negatif';
            if ($this->productModel->barcodeExists($barcode, $id)) {
                $errors[] = 'Barcode sudah digunakan produk lain';
            }

            if (!empty($errors)) {
                $product->barcode     = $barcode;
                $product->name        = $name;
                $product->description = $description;
                $product->category_id = $category_id;
                $product->price       = $price;
                $product->stock       = $stock;

                $imgModel = $this->model('ProductImage');
                $productImages = $imgModel->where('product_id', $id) ?: [];

                $this->view('products/edit', [
                    'title'      => 'Edit Produk',
                    'product'    => $product,
                    'productImages' => $productImages,
                    'errors'     => $errors,
                    'categories' => $this->categoryModel->all('name ASC')
                ]);
                return;
            }

            $this->productModel->update($id, [
                'barcode'     => $barcode,
                'name'        => $name,
                'description' => $description,
                'category_id' => $category_id ?: null,
                'category'    => $categoryName,
                'price'       => $price,
                'stock'       => $stock,
                'image'       => $imageName,
            ]);

            $imgModel = $this->model('ProductImage');
            
            // Update existing images primary status if primary_image changed
            if (!empty($_POST['primary_image'])) {
                // reset all to 0
                $this->productModel->query("UPDATE product_images SET is_primary = 0 WHERE product_id = ?", [$id]);
                $this->productModel->query("UPDATE product_images SET is_primary = 1 WHERE product_id = ? AND image = ?", [$id, $imageName]);
            }

            if (!empty($uploadedImages)) {
                foreach ($uploadedImages as $idx => $img) {
                    $imgModel->create([
                        'product_id' => $id,
                        'image' => $img,
                        'is_primary' => ($imageName === $img) ? 1 : 0
                    ]);
                }
            }

            $this->setFlash('success', 'Produk berhasil diperbarui');
            $this->redirect('products');
        }

        $imgModel = $this->model('ProductImage');
        $productImages = $imgModel->where('product_id', $id) ?: [];

        $this->view('products/edit', [
            'title'      => 'Edit Produk',
            'product'    => $product,
            'productImages' => $productImages,
            'categories' => $this->categoryModel->all('name ASC')
        ]);
    }

    public function delete($id = null)
    {
        if (!$id || !$this->isPost()) $this->redirect('products');

        try {
            if ($this->productModel->delete($id)) {
                $this->setFlash('success', 'Produk berhasil dihapus');
            } else {
                $this->setFlash('danger', 'Gagal menghapus produk');
            }
        } catch (Exception $e) {
            $this->setFlash('danger', 'Produk tidak dapat dihapus karena memiliki riwayat transaksi');
        }
        $this->redirect('products');
    }

    /** API: Search product by barcode (called from POS & Purchase) */
    public function searchByBarcode()
    {
        $barcode = trim($_POST['barcode'] ?? '');
        $context = trim($_POST['context'] ?? 'sale');
        $product = $this->productModel->findByBarcode($barcode);

        // For purchases, allow any product. For sales, require stock > 0
        if ($product && ($context === 'purchase' || $product->stock > 0)) {
            $this->jsonResponse([
                'success' => true,
                'product' => [
                    'id'       => (int)$product->id,
                    'barcode'  => $product->barcode,
                    'name'     => $product->name,
                    'price'    => (int)$product->price,
                    'stock'    => (int)$product->stock,
                    'category' => $product->category,
                    'image'    => $product->image
                ]
            ]);
        } else {
            $msg = $product ? 'Stok produk habis' : 'Produk tidak ditemukan';
            $this->jsonResponse(['success' => false, 'message' => $msg], 404);
        }
    }

    /** API: Search products by keyword */
    public function search()
    {
        $keyword = trim($_GET['q'] ?? '');
        if (strlen($keyword) < 1) {
            $this->jsonResponse(['success' => true, 'products' => []]);
        }

        $products = $this->productModel->search($keyword);
        $result = [];
        foreach ($products as $p) {
            $result[] = [
                'id'       => (int)$p->id,
                'barcode'  => $p->barcode,
                'name'     => $p->name,
                'price'    => (int)$p->price,
                'stock'    => (int)$p->stock,
                'category' => $p->category
            ];
        }
        $this->jsonResponse(['success' => true, 'products' => $result]);
    }
}
