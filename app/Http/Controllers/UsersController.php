<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::select('name', 'email', 'role')->whereNot('id', Auth::user()->id)->get();
        // $users = User::select('id', 'name', 'email', 'role')->get();
        return view('backend.admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $gender = ['L', 'P'];
        $role = ['admin', 'operator'];
        return view('backend.admin.users.create', compact('gender', 'role'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:2',
            'email' => 'required|email|unique:users',
            'gender' => 'required|in:L,P',
            'dob' => 'required|date|before_or_equal:today',
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

            return redirect(route('manage-users.index'))->with('message', 'Pengguna baru berhasil dibuat! ' . $messageInfo);
        } catch (\Throwable $th) {
            return redirect(route('manage-users.index'))
                ->with('error', 'Terjadi kesalahan pada sistem. Silahkan coba lagi nanti! ');
        }
        // return dd($data);
    }


    public function edit(string $id)
    {
        $user = User::find($id);
        // return dd($user);
        if (!$user) {
            return redirect(route('manage-users.index'))
                ->with('error', 'Data Pengguna tidak ditemukan! ');
        }
        $gender = ['L', 'P'];
        $role = ['admin', 'operator'];
        return view('backend.admin.users.edit', compact('user', 'gender', 'role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|min:2',
            'email' => 'required|email',
            'gender' => 'required|in:L,P',
            'dob' => 'nullable|date|before_or_equal:today',
            'role' => 'required|in:admin,operator',
            'password' => 'nullable|min:8',
        ]);

        $find = User::select('id', 'email')->find($id);
        if (!$find) {
            return redirect(route('manage-users.index'))
                ->with('error', 'Data Pengguna tidak ditemukan!');
        }

        if ($request->post('email') != $find->email) {
            $cek = User::select('email')->whereEmail($request->post('email'))->first();
            if ($cek) {
                return redirect(route('manage-users.index'))
                    ->with('error', 'Pengguna dengan email ' . $request->post('email') . ' telah terdaftar. Gunakan email lain!');
            }
        }

        $find->name = $request->post('name');
        $find->email = $request->post('email');
        $find->gender = $request->post('gender');
        $find->role = $request->post('role');
        if ($request->post('dob')) {
            $find->dob = $request->post('dob');
        }
        $find->save();

        return redirect(route('manage-users.edit', $id))
            ->with('message', 'Data Pengguna ' . $find->email . ' berhasil diperbarui!')
            ->with('information', [$find->email]);
    }


    public function destroy(string $id)
    {
        $find = User::select('id', 'email')->find($id);
        if (!$find) {
            return redirect(route('manage-users.index'))
                ->with('error', 'Data Pengguna tidak ditemukan!');
        }

        $find->delete();
        return redirect(route('manage-users.index'))
            ->with('message', 'Data Pengguna ' . $find->email . ' berhasil dihapus!');
    }

    function updatePassword(Request $request, string $id)
    {
        $request->validate([
            'password' => 'required|min:8'
        ]);

        $find = User::select('id', 'email')->find($id);
        if (!$find) {
            return redirect(route('manage-users.index'))
                ->with('error', 'Data Pengguna tidak ditemukan!');
        }
        $find->password = $request->password;
        $find->save();
        return redirect(route('manage-users.index'))
            ->with('message', 'Password pengguna ' . $find->email . ' berhasil diperbarui. PASSWORD BARU : ' . $request->password);
    }
}
