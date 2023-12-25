<?php

namespace App\Http\Controllers;

use App\Imports\TeacherImport;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teacher = Teacher::select('id', 'nuptk', 'name', 'user_id')->get();
        return view('backend.teacher.index', compact('teacher'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $gender = ['L', 'P'];
        return view('backend.teacher.create', compact('gender'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nuptk' => 'numeric|required|digits:16|unique:teachers',
            'name' => 'required|min:2',
            'dob' => 'required|date|before_or_equal:today',
            'gender' => 'required|in:L,P',

            'email' => 'nullable|email|unique:users',
            'role' => 'nullable|in:admin,operator',
            'password' => 'nullable|min:8',
        ]);

        try {
            // buat user terlebih dahulu
            if ($request->post('password') && $request->post('role') && $request->post('email')) {
                $user = User::create([
                    'email' => $request->post('email'),
                    'password' => password_hash($request->post('password'), PASSWORD_DEFAULT),
                    'role' => $request->post('role'),
                ]);
                // buat guru setelah buat user
                $teacher = Teacher::create([
                    'user_id' => $user->id,
                    'nuptk' => $request->post('nuptk'),
                    'name' => $request->post('name'),
                    'gender' => $request->post('gender'),
                    'dob' => $request->post('dob'),
                    'address' => $request->post('address'),
                ]);

                return redirect(route('master-data.teacher.index'))
                    ->with('message', 'Data dan Akun Guru baru behasil dibuat!')
                    ->with('info', 'NUPTK : ' . $teacher->nuptk . '. EMAIL : ' . $user->email . '. PASSWORD : ' . $request->post('password'));
            }

            $teacher = Teacher::create([
                'nuptk' => $request->post('nuptk'),
                'name' => $request->post('name'),
                'gender' => $request->post('gender'),
                'dob' => $request->post('dob'),
                'address' => $request->post('address'),
            ]);

            return redirect(route('master-data.teacher.index'))
                ->with('message', 'Data Guru baru behasil dibuat!')
                ->with('info', 'NUPTK : ' . $teacher->nuptk);
        } catch (\Throwable $th) {
            return redirect(route('master-data.teacher.index'))
            ->with('error', 'Kesalahan yang tak terduga telah terjadi. Silahkan coba lagi nanti!');
        }
    }

    public function edit(Teacher $teacher)
    {
        try {
            if (!$teacher) return redirect(route('master-data.teacher.index'))
                ->with('error', 'Data Guru ' . $teacher->nuptk . ' tidak ditemukan!');
            $gender = ['L', 'P'];
            return view('backend.teacher.edit', compact('teacher', 'gender'));
        } catch (\Throwable $th) {
            return redirect(route('master-data.teacher.index'))
                ->with('error', 'Kesalahan yang tak terduga telah terjadi. Silahkan coba lagi nanti!');
        }
    }

    public function update(Request $request, Teacher $teacher)
    {
        $request->validate([
            'nuptk' => 'numeric|required|digits:16',
            'name' => 'required|min:2',
            'dob' => 'nullable|date|before_or_equal:today',
            'gender' => 'required|in:L,P',
        ]);

        try {
            if ($request->nuptk != $teacher->nuptk) {
                $check = Teacher::select('nuptk')->whereNuptk($request->nuptk)->first();
                if ($check) {
                    return redirect(route('master-data.teacher.edit', $teacher->id))
                        ->with('error', 'NUPTK yang anda inputkan sudah terdaftar. Silahkan gunakan NUPTK lain!');
                }
            }

            $teacher->name = $request->name;
            $teacher->nuptk = $request->nuptk;
            if ($request->dob) {
                $teacher->dob = $request->dob;
            }
            $teacher->gender = $request->gender;
            $teacher->save();

            return redirect(route('master-data.teacher.edit', $teacher->id))
                ->with('message', 'Data Guru ' . $teacher->nuptk . ' telah diperbarui!');
        } catch (\Throwable $th) {
            return redirect(route('master-data.teacher.index'))
                ->with('error', 'Kesalahan yang tak terduga telah terjadi. Silahkan coba lagi nanti!');
        }
    }


    public function destroy(Teacher $teacher)
    {
        if (!$teacher) {
            return redirect(route('master-data.teacher.index'))
                ->with('error', 'Data Guru ' . $teacher->nuptk . ' tidak ditemukan!');
        }

        try {
            if ($teacher->user_id) {
                User::select('id')->find($teacher->user_id)->delete();
            }

            $teacher->delete();
            return redirect(route('master-data.teacher.index'))
                ->with('message', 'Data Guru ' . $teacher->nuptk . ' telah berhasil dihapus!');
        } catch (\Throwable $th) {
            return redirect(route('master-data.teacher.index'))
                ->with('error', 'Kesalahan yang tak terduga telah terjadi. Silahkan coba lagi nanti!');
        }
    }


    function import(Request $request)
    {
        $request->validate([
            'file_excel' => 'required|mimes:xls,xlsx|max:5120'
        ]);

        if (!$request->file('file_excel')) {
            return redirect(route('master-data.teacher.index'))
                ->with('error', 'Anda harus mengupload file dalam format Excel!');
        }

        Excel::import(new TeacherImport(), $request->file('file_excel'));

        return redirect(route('master-data.teacher.index'));
    }
}
