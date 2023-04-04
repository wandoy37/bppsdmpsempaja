<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::latest()->get();
        return view('auth.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('auth.user.create');
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
                'name' => 'required',
                'username' => 'required|unique:users',
                'password' => 'required|confirmed|min:6',
                'role' => 'required',
            ],
            [
                'name.required' => 'Nama wajib diisi',
                'username.required' => 'Username wajib diisi',
                'username.unique' => 'Username ' . $request->username . ' sudah dimiliki.',
                'password.required' => 'Password wajib diisi',
                'password.confirmed' => 'Konfirmasi password tidak cocok',
                'password.min' => 'Password minimal 6 huruf',
                'role.required' => 'Role wajib diisi',
            ],
        );

        // kondisi jika validasi gagal dilewati.
        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        DB::beginTransaction();
        try {
            User::create([
                'name' => $request->name,
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'role' => $request->role,
                'email' => '-',
            ]);
            return redirect()->route('auth.user')->with('success', $request->username . ' berhasil ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->route('auth.user')->with('fails', $request->username . ' gagal ditambahkan');
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
    public function edit($username)
    {
        $user = User::where('username', $username)->first();
        return view('auth.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $username)
    {
        $user = User::where('username', $username)->first();
        // Validator
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'username' => 'required|unique:users,username,' . $user->id,
                'role' => 'required',
            ],
            [
                'name.required' => 'Nama wajib diisi',
                'username.required' => 'Username wajib diisi',
                'username.unique' => 'Username ' . $request->username . ' sudah dimiliki.',
                'role.required' => 'Role wajib diisi',
            ],
        );

        if (request('password')) {
            $validator = Validator::make(
                $request->all(),
                [
                    'password' => 'required|confirmed|min:6',
                ],
                [
                    'password.required' => 'Password wajib diisi',
                    'password.confirmed' => 'Konfirmasi password tidak cocok',
                    'password.min' => 'Password minimal 6 huruf',
                ],
            );
        }

        // kondisi jika validasi gagal dilewati.
        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        // If Success
        DB::beginTransaction();
        try {
            // New password
            if (request('password')) {
                $newPassword = Hash::make($request->password);
            }
            $user->update([
                'name' => $request->name,
                'username' => $request->username,
                'password' => $newPassword ?? $user->password,
                'role' => $request->role,
                'email' => '-',
            ]);
            return redirect()->route('auth.user')->with('success', $request->username . ' berhasil diupdate');
        } catch (\Throwable $th) {
            return redirect()->route('auth.user')->with('fails', $request->username . ' gagal diupdate');
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
    public function destroy($username)
    {
        DB::beginTransaction();
        try {
            $user = User::where('username', $username)->first();
            $user->delete($user);
            return redirect()->route('auth.user')->with('success', $user->username . ' berhasil dihapus');
        } catch (\Throwable $th) {
            return redirect()->route('auth.user')->with('fails', $user->username . ' gagal dihapus');
        } finally {
            DB::commit();
        }
    }
}
