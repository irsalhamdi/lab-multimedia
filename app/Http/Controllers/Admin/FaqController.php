<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::latest()->filter(request(['search']))->paginate(3)->withQueryString();
        return view('admin.faq.index', compact('faqs'));
    }

    public function create()
    {
        return view('admin.faq.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'ask' => 'min:10',
            'answer' => 'min:10',
        ], [
            'ask.min' => 'Pertanyaan minimal 5 karakter',
            'answer.min' => 'Jawaban minimal 5 karakter',
        ]);

        Faq::create($request->all());

        $notification = array(
            'message' => 'Faq berhasil ditambahkan !',
            'alert-type' => 'success',
        );
    
        return redirect()->route('admin.faqs')->with($notification);
    }

    public function edit($id)
    {
        $faq = Faq::findOrFail($id);
        return view('admin.faq.edit', compact('faq'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'ask' => 'min:10',
            'answer' => 'min:10',
        ], [
            'ask.min' => 'Pertanyaan minimal 5 karakter',
            'answer.min' => 'Jawaban minimal 5 karakter',
        ]);

        $faq = Faq::findOrFail($id);
        Faq::findOrFail($faq->id)->update($request->all());

        $notification = array(
            'message' => 'Faq berhasil diupdate !',
            'alert-type' => 'info',
        );
    
        return redirect()->route('admin.faqs')->with($notification);

    }

    public function destroy($id)
    {
        $faq = Faq::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Faq berhasil dihapus !',
            'alert-type' => 'warning',
        );

        return redirect()->back()->with($notification);
    }
}
