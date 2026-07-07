<?php

class Heroslides extends Controller
{
    private $heroSlideModel;

    public function __construct()
    {
        $this->requireLogin();
        if ($_SESSION['user']['role'] !== 'admin') {
            $this->redirect('dashboard');
        }
        $this->heroSlideModel = $this->model('HeroSlide');
    }

    public function index()
    {
        $slides = [];
        try {
            $slides = $this->heroSlideModel->all('sort_order ASC, id DESC');
        } catch (Exception $e) {
            // In case table is not yet created
            $this->setFlash('danger', 'Tabel hero_slides belum ada. Silakan jalankan query CREATE TABLE terlebih dahulu.');
        }

        $this->view('hero-slides/index', [
            'title'  => 'Daftar Hero Slide',
            'slides' => $slides
        ]);
    }

    public function add()
    {
        if ($this->isPost()) {
            $cta_url    = trim($_POST['cta_url'] ?? '');
            
            $sort_order = $_POST['sort_order'] !== '' ? (int)$_POST['sort_order'] : null;
            $is_active  = isset($_POST['is_active']) ? 1 : 0;
            $errors     = [];

            $imageName = '';
            if (!empty($_FILES['image']['name'])) {
                $uploadDir = '../public/assets/img/hero-slides/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }
                $imageName = time() . '_' . basename($_FILES['image']['name']);
                $uploadFile = $uploadDir . $imageName;
                if (!move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
                    $errors[] = 'Gagal mengupload gambar';
                }
            } else {
                $errors[] = 'Gambar slide wajib diupload';
            }

            // Title is now optional
            // if (empty($title)) $errors[] = 'Judul slide wajib diisi';

            if ($sort_order === null) {
                $sort_order = $this->heroSlideModel->getMaxSortOrder() + 1;
            }

            if (!empty($errors)) {
                $this->view('hero-slides/add', [
                    'title'  => 'Tambah Hero Slide',
                    'errors' => $errors,
                    'old'    => $_POST
                ]);
                return;
            }

            $this->heroSlideModel->create([
                'cta_url'    => $cta_url,
                'sort_order' => $sort_order,
                'is_active'  => $is_active,
                'image'      => $imageName,
            ]);

            $this->setFlash('success', 'Slide berhasil ditambahkan');
            $this->redirect('heroslides');
        }

        $this->view('hero-slides/add', [
            'title' => 'Tambah Hero Slide'
        ]);
    }

    public function edit($id = null)
    {
        if (!$id) $this->redirect('heroslides');

        $slide = $this->heroSlideModel->find($id);
        if (!$slide) $this->redirect('heroslides');

        if ($this->isPost()) {
            $cta_url    = trim($_POST['cta_url'] ?? '');
            $sort_order = $_POST['sort_order'] !== '' ? (int)$_POST['sort_order'] : $slide->sort_order;
            $is_active  = isset($_POST['is_active']) ? 1 : 0;
            $errors     = [];

            $imageName = $slide->image ?? '';
            if (!empty($_FILES['image']['name'])) {
                $uploadDir = '../public/assets/img/hero-slides/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }
                
                if ($imageName && file_exists($uploadDir . $imageName)) {
                    unlink($uploadDir . $imageName);
                }
                
                $imageName = time() . '_' . basename($_FILES['image']['name']);
                $uploadFile = $uploadDir . $imageName;
                if (!move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
                    $errors[] = 'Gagal mengupload gambar';
                }
            }

            // Title optional
            // if (empty($title)) $errors[] = 'Judul slide wajib diisi';

            if (!empty($errors)) {
                $slide->cta_url    = $cta_url;
                $slide->sort_order = $sort_order;
                $slide->is_active  = $is_active;

                $this->view('hero-slides/edit', [
                    'title'  => 'Edit Hero Slide',
                    'slide'  => $slide,
                    'errors' => $errors
                ]);
                return;
            }

            $this->heroSlideModel->update($id, [
                'cta_url'    => $cta_url,
                'sort_order' => $sort_order,
                'is_active'  => $is_active,
                'image'      => $imageName,
            ]);

            $this->setFlash('success', 'Slide berhasil diperbarui');
            $this->redirect('heroslides');
        }

        $this->view('hero-slides/edit', [
            'title' => 'Edit Hero Slide',
            'slide' => $slide
        ]);
    }

    public function delete($id = null)
    {
        if (!$id || !$this->isPost()) $this->redirect('heroslides');

        try {
            $slide = $this->heroSlideModel->find($id);
            if ($slide && !empty($slide->image)) {
                $uploadDir = '../public/assets/img/hero-slides/';
                if (file_exists($uploadDir . $slide->image)) {
                    unlink($uploadDir . $slide->image);
                }
            }
            if ($this->heroSlideModel->delete($id)) {
                $this->setFlash('success', 'Slide berhasil dihapus');
            } else {
                $this->setFlash('danger', 'Gagal menghapus slide');
            }
        } catch (Exception $e) {
            $this->setFlash('danger', 'Slide tidak dapat dihapus');
        }
        $this->redirect('heroslides');
    }
}
