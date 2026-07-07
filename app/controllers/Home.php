<?php

class Home extends Controller
{
    private $productModel;
    private $heroSlideModel;

    public function __construct()
    {
        $this->productModel = $this->model('Product');
        try {
            $this->heroSlideModel = $this->model('HeroSlide');
        } catch (Exception $e) {
            $this->heroSlideModel = null;
        }
    }

    public function index()
    {
        $featuredProducts = $this->productModel->all('id DESC LIMIT 6');
        $categories = $this->productModel->getCategories();
        
        $heroSlides = [];
        if ($this->heroSlideModel) {
            try {
                $heroSlides = $this->heroSlideModel->getActive();
            } catch (Exception $e) {
                // Table might not exist yet
            }
        }

        $this->view('home/index', [
            'title' => 'Home',
            'featuredProducts' => $featuredProducts,
            'categories' => $categories,
            'heroSlides' => $heroSlides
        ]);
    }

    public function how_to_order()
    {
        $this->view('home/how_to_order', ['title' => 'Cara Pesan']);
    }

    public function about()
    {
        $this->view('home/about', ['title' => 'Tentang Kami']);
    }
}
