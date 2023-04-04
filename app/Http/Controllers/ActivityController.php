<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activities = Activity::latest()->get();
        return view('auth.activity.index', compact('activities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('auth.activity.create');
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
                'thumbnail' => 'required',
            ],
            [
                'title.required' => 'Judul wajib diisi.',
                'content.required' => 'Konten wajib diisi.',
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
                $imageName = 'kegiatan-' . rand(100000, 999999) . '-' . date('Y-m-d') . '.' . $image->getClientOriginalExtension();
                // Resize Image
                $thumbnail = Image::make($image->getRealPath())->resize(650, 650);
                // Save Image
                $thumbPath = $path . $imageName;
                $thumbnail = Image::make($thumbnail)->save($thumbPath);
            }
            // =====================================================================================================================================
            Activity::create([
                'title' => $request->title,
                'slug' => Str::slug($request->title, '-'),
                'content' => $request->content,
                'thumbnail' => $imageName,
            ]);
            return redirect()->route('auth.activity')->with('success', 'Kegiatan' . $request->title . ' telah di tambahkan.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('auth.activity')->with('fails', 'Kegiatan' . $request->title . ' gagal di tambahkan.');
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
        $activity = Activity::where('slug', $slug)->first();
        return view('auth.activity.edit', compact('activity'));
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
            ],
            [
                'title.required' => 'Judul wajib diisi.',
                'content.required' => 'Konten wajib diisi.',
            ],
        );

        // If validator fails.
        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        // If validator success
        DB::beginTransaction();
        try {
            $activity = Activity::where('slug', $slug)->first();

            // This Process File/Image==============================================================================================================
            if ($request['thumbnail']) {
                // Make Directory
                $path = public_path() . '/uploads/thumbnail/';
                if (!file_exists($path)) {
                    File::makeDirectory($path, 0775, true, true);
                }

                // Old Thumbnail
                $oldThumbnail = $activity->thumbnail;
                File::delete($path . $oldThumbnail);

                // New Thumbnail
                $image = $request['thumbnail'];
                $imageName = 'kegiatan-' . rand(100000, 999999) . '-' . date('Y-m-d') . '.' . $image->getClientOriginalExtension();
                // Resize Image
                $thumbnail = Image::make($image->getRealPath())->resize(650, 650);
                // Save Image
                $thumbPath = $path . $imageName;
                $thumbnail = Image::make($thumbnail)->save($thumbPath);
            }
            // =====================================================================================================================================
            $activity->update([
                'title' => $request->title,
                'slug' => Str::slug($request->title, '-'),
                'content' => $request->content,
                'thumbnail' => $imageName ?? $activity->thumbnail,
            ]);
            return redirect()->route('auth.activity')->with('success', 'Kegiatan' . $request->title . ' telah di update.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('auth.activity')->with('fails', 'Kegiatan' . $request->title . ' gagal di update.');
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
            $activity = Activity::where('slug', $slug)->first();
            $path = public_path() . '/uploads/thumbnail/';
            File::delete($path . $activity->thumbnail);

            $activity->delete($activity);
            return redirect()->route('auth.activity')->with('success', 'Kegiatan ' . $activity->title . ' telah dihapus.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('auth.activity')->with('fails', 'Kegiatan ' . $activity->title . ' gagal dihapus.');
        } finally {
            DB::commit();
        }
    }
}
