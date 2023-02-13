<?php

namespace App\Http\Controllers\Asistant;

use App\Models\News;
use App\Mail\NewsMail;
use App\Models\Customers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class AsistantCustomerController extends Controller
{
    public function index()
    {
        $customers =  Customers::orderBy('email', 'ASC')->filter(request(['search']))->paginate(3)->withQueryString();
        return view('asistant.customer.index', compact('customers'));
    }

    public function sendNewsLetter($id)
    {
        $customer = Customers::findOrFail($id);
        $lastNews = DB::table('news')->max('id');
        $news = News::findOrFail($lastNews);
        
        $data = [
            'image' => $news->image,
            'link' => 'http://127.0.0.1:8000/berita/detail/' . $news->id,
            'title' => $news->title,
            'excerpt' => $news->excerpt,
            'created_at' => $news->created_at
        ];
        
        Mail::to($customer->email)->send(new NewsMail($data));

        $notification = array(
            'message' => 'Berita Berhasil dikirimkan !',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }
}
