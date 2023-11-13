<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Post;
use App\Models\Qrcode;
use App\Models\User;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode as SimpleQRCODE;
use Illuminate\Support\Facades\File;

class DashboardController extends Controller
{
    public function index()
    {
        $users = User::all()->count();
        $posts = Post::all()->count();
        $activities = Activity::all()->count();
        $videos = Video::all()->count();
        return view('auth.dashboard.index', compact(
            'users',
            'posts',
            'activities',
            'videos',
        ));
    }


    // Function QRCODE Manage
    public function qrcode_index()
    {
        $qrcodes = Qrcode::latest()->get();
        return view('auth.qrcode.index', compact('qrcodes'));
    }

    public function qrcode_create()
    {
        return view('auth.qrcode.create');
    }

    public function qrcode_store(Request $request)
    {
        // Validator
        $validator = Validator::make(
            $request->all(),
            [
                'title' => 'required|unique:qrcodes',
                'links' => 'required',
            ],
            [
                'title.required' => 'Title wajib diisi.',
                'title.unique' => 'Title ' . $request->title . ' sudah dimiliki',
                'links.required' => 'Link / tautan wajib diisi.',
            ],
        );

        // If validator fails.
        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        // If validator success
        DB::beginTransaction();
        try {
            Qrcode::create([
                'title' => $request->title,
                'slug' => Str::slug($request->title, '-'),
                'links' => $request->links,
                'keterangan' => $request->keterangan ?? null,
            ]);

            // Generate and Save QRCODE
            $directory = public_path('qrcode/');
            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0755, true, true);
            }

            SimpleQRCODE::format('png')
                ->size(500) // Atur ukuran QR code sesuai kebutuhan Anda
                ->generate($request->links, public_path('qrcode/qrcode_' . Str::slug($request->title, '-') . '.png'));

            return redirect()->route('auth.qrcode')->with('success', 'Qrcode baru telah di tambahkan.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('auth.qrcode')->with('fails', 'Qrcode baru gagal di tambahkan.');
        } finally {
            DB::commit();
        }
    }

    public function qrcode_destroy($id)
    {
        DB::beginTransaction();
        try {
            $qrcode = Qrcode::find($id);
            // Destroy
            $path = public_path() . '/qrcode/';
            $qrname = 'qrcode_' . $qrcode->slug . '.' . 'png';
            File::delete($path . $qrname);
            $qrcode->delete($qrcode);

            return redirect()->route('auth.qrcode')->with('success', 'Qrcode telah di hapus.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('auth.qrcode')->with('fails', 'Qrcode gagal di hapus.');
        } finally {
            DB::commit();
        }
    }
}
