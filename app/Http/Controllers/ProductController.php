<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Request;


class ProductController extends Controller
{
    public function index(Request $request){
        $products = Product::filtered()->paginate(10);
        $categories = Category::all();

        return view('products',compact(['products', 'categories']));
    }
}
