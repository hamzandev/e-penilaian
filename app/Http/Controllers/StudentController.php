<?php

namespace App\Http\Controllers;

use App\Imports\StudentImport;
use App\Models\Kelas;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $siswa = Student::with('kelas')->get();
        return view('backend.student.index', compact('siswa'));
    }

    function create()
    {
        $kelas = Kelas::select('id', 'name')->orderBy('name')->get();
        $gender = ['L', 'P'];
        if (count($kelas) <= 0) {
            return redirect(route('master-data.class.create'))
                ->with('info', 'Untuk membuat data siswa, silahkan input data Kelas terlebih dahulu.');
        }
        return view('backend.student.create', compact('kelas', 'gender'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|string',
            'kelas_id' => 'required|numeric|not_in:0',
            'nisn' => 'required|digits:10|numeric|unique:students',
            'gender' => 'required|in:L,P',
            'dob' => 'required|date|before_or_equal:today',
        ]);

        try {

            Student::create($request->except('_token'));
            return redirect(route('master-data.student.index'))
                ->with('message', 'Siswa baru berhasil ditambahkan!');
        } catch (\Throwable $th) {
            return redirect(route('master-data.student.index'))
                ->with('error', 'Telah terjadi kesalahan. Silahkan coba lagi nanti!');
        }
    }

    public function edit(Student $student)
    {
        $kelas = Kelas::select('id', 'name')->orderBy('name')->get();
        $gender = ['L', 'P'];
        return view('backend.student.edit', compact('student', 'kelas', 'gender'));
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name' => 'required|min:3|string',
            'kelas_id' => 'required|numeric|not_in:0',
            'nisn' => 'required|digits:10|numeric',
            'gender' => 'required|in:L,P',
            'dob' => 'nullable|date|before_or_equal:today',
        ]);

        if (!$student) {
            return redirect(route('master-data.student.index'))
                ->with('error', 'Data siswa tidak ditemukan!');
        }
        if ($request->nisn != $student->nisn) {
            $checkUniqueNisn = Student::select('nisn')->find($student->id);
            if ($checkUniqueNisn) {
                return redirect(route('master-data.student.edit', $student->id))
                    ->with('error', 'NISN yang diinputkan telah terdaftar. Silahkan gunakan NISN lain!');
            }
        }
        // $student->update($request->except(['_token', '_method']));
        $student->name = $request->name;
        $student->nisn = $request->nisn;
        $student->gender = $request->gender;
        $student->kelas_id = $request->kelas_id;
        if ($request->dob) {
            $student->dob = $request->dob;
        }
        $student->address = $request->address;
        $student->save();

        return redirect(route('master-data.student.edit', $student->id))
            ->with('message', 'Data siswa ' . $student->nisn . ' berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $find = Student::find($id);
        if (!$find) {
            return redirect(route('master-data.student.index'))
                ->with('error', 'Data siswa tidak ditemukan!');
        }
        $find->delete();
        return redirect(route('master-data.student.index'))
            ->with('message', 'Data siswa ' . $find->nisn . ' berhasil dihapus!');
    }

    function import(Request $request)
    {
        $request->validate([
            'file_excel' => 'required|mimes:xls,xlsx|max:5120'
        ]);

        if (!$request->file('file_excel')) {
            return redirect(route('master-data.subject.index'))
                ->with('error', 'Anda harus mengupload file dalam format Excel!');
        }

        Excel::import(new StudentImport(), $request->file('file_excel'));

        return redirect(route('master-data.student.index'))->with('message', session('dataCount') . ' data Siswa berhasil di import!');
    }
}
