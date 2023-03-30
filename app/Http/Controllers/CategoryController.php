<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::latest()->get();
        return view('auth.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('auth.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validator
        $validator = Validator::make(
            $request->all(),
            [
                'title' => 'required|unique:categories',
            ],
            [
                'title.required' => 'Title wajib diisi.',
                'title.unique' => 'Title ' . $request->title . ' sudah dimiliki',
            ],
        );

        // If validator fails.
        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        // If validator success
        DB::beginTransaction();
        try {
            Category::create([
                'title' => $request->title,
                'slug' => Str::slug($request->title, '-'),
            ]);
            return redirect()->route('auth.category')->with('success', $request->title . ' telah di tambahkan.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('auth.category')->with('fails', $request->title . ' gagal di tambahkan.');
        } finally {
            DB::commit();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $category = Category::where('slug', $slug)->first();
        return view('auth.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $category = Category::where('slug', $slug)->first();
        // Validator
        $validator = Validator::make(
            $request->all(),
            [
                'title' => 'required|unique:categories,title,' . $category->id,
            ],
            [
                'title.required' => 'Title wajib diisi.',
                'title.unique' => 'Title ' . $request->title . ' sudah dimiliki',
            ],
        );

        // If validator fails.
        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        // If validator success
        DB::beginTransaction();
        try {
            $category->update([
                'title' => $request->title,
                'slug' => Str::slug($request->title, '-'),
            ]);
            return redirect()->route('auth.category')->with('success', 'Berhasil mengganti kategori.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('auth.category')->with('fails', 'Gagal mengganti kategori');
        } finally {
            DB::commit();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $category = Category::where('slug', $slug)->first();
        DB::beginTransaction();
        try {
            $category->delete($category);
            return redirect()->route('auth.category')->with('success', 'Berhasil menghapus kategori.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('auth.category')->with('fails', 'Gagal menghapus kategori');
        } finally {
            DB::commit();
        }
    }
}
