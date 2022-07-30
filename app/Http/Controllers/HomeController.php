<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::count();
        $customers = Customer::count();
        $params = [
            'products' => $products,
            'customers' => $customers,
        ];
        return view('backend.home',$params);
    }
}
