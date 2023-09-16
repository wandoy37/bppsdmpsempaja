<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class SitePages extends Controller
{
    public function portal()
    {
        return view('portal.index');
    }

    public function index()
    {
        $beritas = Post::where('status', 'publish')->limit(3)->orderBy('id', 'DESC')->get();
        $categories = Category::all();
        return view('site.index', compact('beritas', 'categories'));
    }

    public function berita()
    {
        $beritas = Post::where('status', 'publish')->orderBy('id', 'DESC')->paginate(3);
        $categories = Category::all();
        return view('site.berita.index', compact('beritas', 'categories'));
    }

    public function berita_detail($slug)
    {
        $beritas = Post::where('status', 'publish')->orderBy('id', 'DESC')->paginate(2);
        $berita = Post::where('slug', $slug)->first();
        $categories = Category::all();
        return view('site.berita.detail', compact('beritas', 'berita', 'categories'));
    }

    public function berita_category($slug)
    {
        $categories = Category::all();
        $category = Category::where('slug', $slug)->first();
        $beritas = Post::where('status', 'publish')->where('category_id', $category->id)->orderBy('id', 'DESC')->paginate(3);
        return view('site.berita.index', compact('beritas', 'category', 'categories'));
    }

    // Tentang Kami
    public function tentang_kami()
    {
        return view('site.about.index');
    }

    // Mitra Kerja
    public function mitra_kerja()
    {
        return view('site.mitra_kerja.index');
    }

    // Kontak
    public function kontak()
    {
        return view('site.kontak.index');
    }
}
