<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videos = Video::latest()->get();
        return view('auth.video.index', compact('videos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('auth.video.create');
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
                'link' => 'required',
            ],
            [
                'title.required' => 'Title wajib diisi.',
                'link.required' => 'Link wajib diisi.',
            ],
        );

        // If validator fails.
        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        // If validator success
        DB::beginTransaction();
        try {
            Video::create([
                'title' => $request->title,
                'slug' => Str::slug($request->title, '-') . '-' . date('Y-m-d'),
                'link' => $request->link,
            ]);
            return redirect()->route('auth.video')->with('success', 'Video baru telah di tambahkan.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('auth.video')->with('fails', 'Video baru gagal di tambahkan.');
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
        $video = Video::where('slug', $slug)->first();
        return view('auth.video.edit', compact('video'));
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
                'link' => 'required',
            ],
            [
                'title.required' => 'Title wajib diisi.',
                'link.required' => 'Link wajib diisi.',
            ],
        );

        // If validator fails.
        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        // If validator success
        DB::beginTransaction();
        try {
            $video = Video::where('slug', $slug)->first();
            $video->update([
                'title' => $request->title,
                'slug' => Str::slug($request->title, '-') . '-' . date('Y-m-d'),
                'link' => $request->link,
            ]);
            return redirect()->route('auth.video')->with('success', 'Video ' . $request->title . ' telah di update.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('auth.video')->with('fails', 'Video ' . $request->title . ' gagal di update.');
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
            $video = Video::where('slug', $slug)->first();
            $video->delete($video);
            return redirect()->route('auth.video')->with('success', 'Video ' . $video->title . ' telah di hapus.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('auth.video')->with('fails', 'Video ' . $video->title . ' gagal di hapus.');
        } finally {
            DB::commit();
        }
    }
}
