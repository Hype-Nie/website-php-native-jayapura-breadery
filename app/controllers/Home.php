<?php

class Home extends Controller
{
    private $productModel;

    public function __construct()
    {
        $this->productModel = $this->model('Product');
    }

    public function index()
    {
        $featuredProducts = $this->productModel->all('id DESC LIMIT 6');
        $categories = $this->productModel->getCategories();

        $this->view('home/index', [
            'title' => 'Home',
            'featuredProducts' => $featuredProducts,
            'categories' => $categories
        ]);
    }
}
