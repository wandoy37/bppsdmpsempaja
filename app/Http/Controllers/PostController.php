<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->get();
        return view('auth.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::latest()->get();
        return view('auth.post.create', compact('categories'));
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
                'title' => 'required',
                'content' => 'required',
                'category' => 'required',
                'thumbnail' => 'required',
                'tanggal' => 'required',
            ],
            [
                'title.required' => 'Judul wajib diisi.',
                'title.unique' => 'Judul ' . $request->title . ' sudah dimiliki',
                'content.required' => 'Konten wajib diisi.',
                'category.required' => 'Kategori wajib diisi.',
                'thumbnail.required' => 'Thumbnail wajib diisi.',
            ],
        );

        // If validator fails.
        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        // If validator success
        DB::beginTransaction();
        try {
            // This Process File/Image==============================================================================================================
            if ($request['thumbnail']) {
                // Make Directory
                $path = public_path() . '/uploads/thumbnail/';
                if (!file_exists($path)) {
                    File::makeDirectory($path, 0775, true, true);
                }
                // New Thumbnail
                $image = $request['thumbnail'];
                $imageName = Str::slug($request->title, '-') . '-' . date('Y-m-d') . '.' . $image->getClientOriginalExtension();
                // Resize Image
                $thumbnail = Image::make($image->getRealPath())->resize(1920, 1080);
                // Save Image
                $thumbPath = $path . $imageName;
                $thumbnail = Image::make($thumbnail)->save($thumbPath);
            }
            // =====================================================================================================================================

            Post::create([
                'title' => $request->title,
                'slug' => Str::slug($request->title, '-'),
                'content' => $request->content,
                'thumbnail' => $imageName,
                'status' => $request->status,
                'category_id' => $request->category,
                'created_at' => Carbon::parse($request->tanggal),
                'author_id' => Auth::user()->id,
            ]);

            return redirect()->route('auth.post')->with('success', 'Postingan baru berhasil ditambahkan.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('auth.post')->with('fails', 'Postingan baru gagal ditambahkan.');
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
        $post = Post::where('slug', $slug)->first();
        $categories = Category::latest()->get();
        return view('auth.post.edit', compact('post', 'categories'));
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
        // Validator
        $validator = Validator::make(
            $request->all(),
            [
                'title' => 'required',
                'content' => 'required',
                'category' => 'required',
                'tanggal' => 'required',
            ],
            [
                'title.required' => 'Judul wajib diisi.',
                'title.unique' => 'Judul ' . $request->title . ' sudah dimiliki',
                'content.required' => 'Konten wajib diisi.',
                'category.required' => 'Kategori wajib diisi.',
            ],
        );

        // If validator fails.
        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        // If validator success
        DB::beginTransaction();
        try {
            $post = Post::where('slug', $slug)->first();

            // This Process File/Image==============================================================================================================
            if ($request['thumbnail']) {
                // Make Directory
                $path = public_path() . '/uploads/thumbnail/';
                if (!file_exists($path)) {
                    File::makeDirectory($path, 0775, true, true);
                }

                // Old Thumbnail
                $oldThumbnail = $post->thumbnail;
                File::delete($path . $oldThumbnail);

                // New Thumbnail
                $image = $request['thumbnail'];
                $imageName = Str::slug($request->title, '-') . '-' . date('Y-m-d') . '.' . $image->getClientOriginalExtension();
                // Resize Image
                $thumbnail = Image::make($image->getRealPath())->resize(1920, 1080);
                // Save Image
                $thumbPath = $path . $imageName;
                $thumbnail = Image::make($thumbnail)->save($thumbPath);
            }
            // =====================================================================================================================================

            // Update Process
            $post->update([
                'title' => $request->title,
                'slug' => Str::slug($request->title, '-'),
                'content' => $request->content,
                'thumbnail' => $imageName ?? $post->thumbnail,
                'status' => $request->status,
                'category_id' => $request->category,
                'created_at' => Carbon::parse($request->tanggal),
                'author_id' => Auth::user()->id,
            ]);

            return redirect()->route('auth.post')->with('success', 'Postingan ' . $post->title . ' berhasil diupdate.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('auth.post')->with('fails', 'Postingan ' . $post->title . ' gagal diupdate.');
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
        DB::beginTransaction();
        try {
            $post = Post::where('slug', $slug)->first();
            $path = public_path() . '/uploads/thumbnail/';
            File::delete($path . $post->thumbnail);

            $post->delete($post);
            return redirect()->route('auth.post')->with('success', 'Postingan ' . $post->title . ' telah dihapus.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('auth.post')->with('fails', 'Postingan ' . $post->title . ' gagal dihapus.');
        } finally {
            DB::commit();
        }
    }
}
