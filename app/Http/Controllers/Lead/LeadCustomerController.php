<?php

namespace App\Http\Controllers\Lead;

use App\Models\Customers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LeadCustomerController extends Controller
{
    public function index()
    {
        $customers =  Customers::orderBy('email', 'ASC')->filter(request(['search']))->paginate(3)->withQueryString();
        return view('lead.customer.index', compact('customers'));
    }
}
