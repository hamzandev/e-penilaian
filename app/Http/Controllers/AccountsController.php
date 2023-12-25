<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AccountsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::select('id', 'email', 'role')->whereNot('id', auth()->user()->id)->get();
        return view('backend.admin.accounts.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $gender = ['L', 'P'];
        $role = ['admin', 'operator'];
        return view('backend.admin.accounts.create', compact('role', 'gender'));
    }



    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users',
            'role' => 'nullable|in:admin,operator',
            'password' => 'nullable|min:8',
        ]);

        try {
            $data = $request->except(['_token']);
            $password = 12345678;
            if (!$request->post('password')) {
                $data['password'] = password_hash($password, PASSWORD_DEFAULT);
            } else {
                $password = $request->post('password');
                $data['password'] = password_hash($password, PASSWORD_DEFAULT);
            }

            User::create($data);
            $messageInfo = 'EMAIL : ' . $data['email'] . ' PASSWORD : ' . $password;

            return redirect(route('accounts.index'))->with('message', 'Akun baru berhasil dibuat! ' . $messageInfo);
        } catch (\Throwable $th) {
            return redirect(route('accounts.index'))
                ->with('error', 'Terjadi kesalahan pada sistem. Silahkan coba lagi nanti! ');
        }
    }

    public function edit(string $id)
    {
        $account = User::with('teacher')->find($id);
        $role = ['admin', 'operator'];
        return view('backend.admin.accounts.edit', compact('account', 'role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        // return dd($request->all());

        $account = User::find($id);
        if (!$account) {
            return redirect(route('accounts.index'))->with('error', 'Data Akun yang anda tuju tidak ditemukan!');
        }
        if ($request->email != $account->email) {
            $check = User::select('id')->whereEmail($request->email)->first();
            if ($check) {
                return redirect(route('accounts.edit', $account->id))
                    ->with('error', 'Email yang anda inputkan telah terdaftar. Silahkan gunakan email lain!');
            }
        }
        $account->email = $request->email;
        $account->role = $request->role;
        $account->save();

        return redirect(route('accounts.edit', $account->id))
            ->with('message', 'Akun ' . $account->email . ' berhasil diperbarui!');
    }


    public function destroy(string $id)
    {
        $find = User::with('teacher')->find($id);
        // return dd($find->teacher);

        if (!$find) {
            return redirect(route('accounts.index'))
                ->with('error', 'Data Pengguna tidak ditemukan!');
        }

        if ($find->teacher) {
            $find->teacher->user_id = NULL;
            $find->teacher->save();
        }

        $find->delete();

        return redirect(route('accounts.index'))
            ->with('message', 'Data Pengguna ' . $find->email . ' berhasil dihapus!');
    }

    function updatePassword(Request $request, string $id)
    {
        $request->validate([
            'password' => 'required|min:8'
        ]);

        $find = User::select('id', 'email')->find($id);
        if (!$find) {
            return redirect(route('accounts.index'))
                ->with('error', 'Data Pengguna tidak ditemukan!');
        }
        $find->password = $request->password;
        $find->save();
        return redirect(route('accounts.edit', $find->id))
            ->with('message', 'Password pengguna ' . $find->email . ' berhasil diperbarui. PASSWORD BARU : ' . $request->password);
    }
}
