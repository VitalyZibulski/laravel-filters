<?php

namespace App\Http\Controllers;

use App\Filters\ProductFilter;
use App\Models\Category;
use App\Models\Product;


class ProductController extends Controller
{
    public function index(ProductFilter $filter){
        $products = Product::filter($filter)->paginate(6);
        $categories = Category::all();

        return view('products',compact(['products', 'categories']));
    }
}
