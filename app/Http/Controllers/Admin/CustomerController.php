<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customers;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers =  Customers::orderBy('email', 'ASC')->filter(request(['search']))->paginate(3)->withQueryString();
        return view('admin.customer.index', compact('customers'));
    }
}
