<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $users = User::with('teacher', function($query) {
        //     $query->whereNotNull('user_id');
        // })->whereNot('id', Auth::user()->id)->get();
        // $users = User::select('id', 'name', 'email', 'role')->get();
        $users = User::whereNotIn('id', [Auth::user()->id])
            ->whereHas('teacher', function ($query) {
                $query->whereNotNull('user_id');
            })
            ->with('teacher')
            ->get();

        return view('backend.admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     $gender = ['L', 'P'];
    //     $role = ['admin', 'operator'];
    //     return view('backend.admin.users.create', compact('gender', 'role'));
    // }


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

            return redirect(route('manage-users.index'))->with('message', 'Pengguna baru berhasil dibuat! ' . $messageInfo);
        } catch (\Throwable $th) {
            return redirect(route('manage-users.index'))
                ->with('error', 'Terjadi kesalahan pada sistem. Silahkan coba lagi nanti! ');
        }
    }


    public function edit(string $id)
    {
        // $user = User::find($id);
        $user = User::with('teacher')->find($id);
        if (!$user) {
            return redirect(route('manage-users.index'))
                ->with('error', 'Data Pengguna tidak ditemukan! ');
        }
        $gender = ['L', 'P'];
        $role = ['admin', 'operator'];
        return view('backend.admin.users.edit', compact('user', 'gender', 'role'));
    }


    public function update(Request $request, string $id)
    {
        $request->validate([
            'email' => 'required|email',
            'role' => 'required|in:admin,operator',
            'password' => 'nullable|min:8',
        ]);

        // return dd($request->all());

        if (!$request->name || !$request->dob || !$request->gender || !$request->address) {
            $find = User::find($id);
        } else {
            $find = User::with('teacher')->find($id);
        }

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

        $find->email = $request->email;
        $find->role = $request->role;
        if ($request->name || $request->dob || $request->gender || $request->address) {
            $find->teacher->name = $request->name;
            $find->teacher->gender = $request->gender;
            if ($request->dob) {
                $find->teacher->dob = $request->dob;
            }
            $find->teacher->save();
        }
        $find->save();

        return redirect(route('manage-users.edit', $id))
            ->with('message', 'Data Pengguna ' . $find->email . ' berhasil diperbarui!')
            ->with('information', [$find->email]);
    }


    // public function destroy(string $id)
    // {
    //     $find = User::select('id')->find($id);
    //     $teacher = Teacher::whereUserId($id)->first();
    //     // return dd($find);

    //     if (!$find) {
    //         return redirect(route('manage-users.index'))
    //             ->with('error', 'Data Pengguna tidak ditemukan!');
    //     }
    //     if (!$teacher) {
    //         $find->delete();
    //         return redirect(route('manage-users.index'))
    //             ->with('info', 'Akun telah terhapus. Tidak ada Guru manapun yang terkait dengan akun ini!');
    //     }

    //     $teacher->user_id = NULL;
    //     $teacher->save();
    //     $find->delete();

    //     return redirect(route('manage-users.index'))
    //         ->with('message', 'Data Pengguna ' . $find->email . ' berhasil dihapus!');
    // }


    function connectAccount($id)
    {
        $teacher = Teacher::select('id', 'name', 'nuptk')->find($id);
        $users = User::select('id', 'role', 'email')->whereNot('id', auth()->user()->id)->get();
        return view('backend.admin.users.connect-account', compact('teacher', 'users'));
    }

    function connect(Request $request, $id)
    {

        // return dd($request->all());
        $request->validate([
            'user_id' => 'numeric|required|not_in:0',
        ]);

        $teacher = Teacher::find($id);
        if (!$teacher) {
            return redirect(route('manage-users.connect-account', $id))
                ->with('error', 'Data Guru yang kamu coba kaitkan tidak ditemukan!');
        }
        $teacher->user_id = $request->user_id;
        $teacher->save();
        return redirect(route('manage-users.index', $id))
            ->with('message', 'Data Guru berhasil terkait dengan akun : ' . $request->email . '');
    }

    function updatePassword(Request $request, string $id)
    {
        // $find = User::with('teacher')->find($id);
        // return dd($find);

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
