<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    function index()
    {
        // $profile = User::with(['teacher' => function ($query) {
        //     $query->select('name', 'gender');
        // }])->find(Auth::user()->id);

        $gender = ['L', 'P'];
        $profile = User::with('teacher')->find(Auth::user()->id);
        return view('backend.profile', compact('gender', 'profile'));
    }

    function update(Request $request)
    {

        $request->validate([
            'name' => 'required|min:2',
            'email' => 'required|email',
            'dob' => 'nullable|date|before_or_equal:today',
            'gender' => 'required|in:L,P',
        ]);

        try {
            $check = User::with('teacher')->find(Auth::user()->id);

            if (!$check) {
                return redirect(route('profile'))
                    ->with('error', 'Mohon maaf, suatu yang tak terduga telah terjadi. Silahkan coba lagi nanti!');
            }

            if ($request->email != auth()->user()->email) {
                $findEmail = User::select('email')->whereEmail($request->email)->first();
                if ($findEmail) {
                    return redirect(route('profile'))
                        ->with('error', 'Email yang kamu inputkan sudah terdaftar. Silahkan gunakan email lain!');
                }
            }

            $check->email = $request->email;
            $check->teacher->name = $request->name;
            $check->teacher->gender = $request->gender;
            $check->teacher->address = $request->address;
            if ($request->dob) {
                $check->teacher->dob = $request->dob;
            }
            $check->save();
            $check->teacher->save();

            return redirect(route('profile'))->with('message', 'Profil kamu berhasil diperbarui!');
        } catch (\Throwable $th) {
            return redirect(route('profile'))
                ->with('error', 'Mohon maaf, suatu yang tak terduga telah terjadi. Silahkan coba lagi nanti!');
        }
    }

    function updatePassword(Request $request)
    {
        try {
            if (!$request->password && strlen($request->password) < 8) {
                return redirect(route('profile'))
                    ->with('error', 'Password harus diisi dan terdiri dari kombinasi huruf, angka atau simbol dengan panjang minimal 8 digit!');
            }

            $find = User::select('id')->whereId(auth()->user()->id)->orWhere('email', auth()->user()->email)->first();
            if (!$find) {
                return redirect(route('profile'))
                    ->with('error', 'Mohon maaf, suatu hal tak terduga telah terjadi. Silahkan coba lagi nanti!');
            }

            $find->password = password_hash($request->password, PASSWORD_DEFAULT);
            $find->save();

            return redirect(route('profile'))->with('message', 'Password kamu berhasil diperbarui! PASSWORD : ' . $request->password);
        } catch (\Throwable $th) {
            return redirect(route('profile'))
                ->with('error', 'Mohon maaf, suatu hal tak terduga telah terjadi. Silahkan coba lagi nanti!');
        }
    }
}
