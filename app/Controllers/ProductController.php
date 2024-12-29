<?php

declare(strict_types=1);

namespace App\Controllers;

use Core\App;

class ProductController
{
    public function index()
    {
        $products = App::resolve('Product')->all();

        require view('products');
    }
}