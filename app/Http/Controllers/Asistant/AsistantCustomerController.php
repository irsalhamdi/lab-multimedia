<?php

namespace App\Http\Controllers\Asistant;

use App\Models\Customers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AsistantCustomerController extends Controller
{
    public function index()
    {
        $customers =  Customers::orderBy('email', 'ASC')->filter(request(['search']))->paginate(3)->withQueryString();
        return view('asistant.customer.index', compact('customers'));
    }
}
