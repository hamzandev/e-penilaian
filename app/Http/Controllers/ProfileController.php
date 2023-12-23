<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    function index()
    {
        $gender = ['L', 'P'];
        return view('backend.profile', compact('gender'));
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
            $check = User::select('id')->find(Auth::user()->id);
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

            $check->name = $request->name;
            $check->email = $request->email;
            $check->gender = $request->gender;
            $check->address = $request->address;
            if ($request->dob) {
                $check->dob = $request->dob;
            }
            $check->save();

            return redirect(route('profile'))->with('message', 'Profil kamu berhasil diperbarui!');
        } catch (\Throwable $th) {
            return redirect(route('profile'))
                ->with('error', 'Mohon maaf, suatu yang tak terduga telah terjadi. Silahkan coba lagi nanti!');
        }
    }

    function updatePassword(Request $request)
    {
        // $validated = $request->validate([
        //     'password' => 'min:8',
        // ]);

        // dd($validated);
        try {
            if (!$request->password && strlen($request->password) < 8) {
                return redirect(route('profile'))
                    ->with('error', 'Password harus diisi dan terdiri dari kombinasi huruf, angka atau simbol dengan panjang minimal 8 digit!');
            }

            $find = User::select('id')->whereId(auth()->user()->id)->andWhereEmail(auth()->user()->email)->first();
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
