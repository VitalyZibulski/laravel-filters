<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Request;


class ProductController extends Controller
{
    public function index(Request $request){
        $products = Product::paginate(6);
        $categories = Category::all();

        return view('products',compact(['products', 'categories']));
    }
}
