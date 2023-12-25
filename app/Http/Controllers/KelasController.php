<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\KelasLevel;
use App\Models\Schoolyear;
use App\Models\Student;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kelas = Kelas::orderBy('name')->get();
        return view('backend.class.index', compact('kelas'));
    }

    public function create()
    {
        $schoolyear = Schoolyear::all();
        $kelasLevel = KelasLevel::all();
        return view('backend.class.create', compact('schoolyear', 'kelasLevel'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:kelas',
        ]);
        Kelas::create($request->except('_token'));
        return redirect(route('master-data.class.index'))->with('message', 'Kelas baru berhasil ditambahkan!');
    }



    public function edit($id)
    {
        $kelas = Kelas::find($id);
        return view('backend.class.edit', compact('kelas'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);

        try {
            $kelas = Kelas::find($id);

            if (!$kelas) {
                return redirect(route('master-data.class.index'))->with('error', 'Data kelas tidak ditemukan!');
            }
            if ($request->name != $kelas->name) {
                $find = Kelas::select('name')->whereName($request->name)->first();
                if ($find) {
                    return redirect(route('master-data.class.edit', $kelas->id))
                        ->with('error', 'Data kelas ' . $request->name . ' telah ada. Silahkan input kelas yang berbeda!');
                }
            }

            $kelas->update([
                'name' => $request->post('name'),
            ]);

            return redirect(route('master-data.class.index'))
                ->with('message', 'Data kelas ' . $request->name . ' berhasil diperbarui!');
        } catch (\Throwable $th) {
            return redirect(route('master-data.class.index'))
                ->with('error', 'Telah terjadi kesalahan. Silahkan coba lagi nanti!');
        }
    }


    public function destroy($id)
    {
        $find = Kelas::select('id')->find($id);
        if (!$find) {
            return redirect(route('master-data.class.index'))->with('error', 'Data kelas tidak ditemukan!');
        }

        $find->delete();
        return redirect(route('master-data.class.index'))->with('message', 'Data kelas berhasil dihapus!');
    }

    function students($id)
    {
        $studentsOfClass = Kelas::with('student')->where('id', $id)->first();
        return view('backend.class.students', compact('studentsOfClass'));
    }

    function addStudents($id)
    {
        $studentsNoClass = Student::whereNull('kelas_id')->get();
        return view('backend.class.add-students', compact('studentsNoClass', 'id'));
    }

    function addStudentsAction(Request $request, $id)
    {
        $data = $request->except(['_token', '_method', 'datatable_length', 'student_0']);
        if (!$data) {
            return redirect(route('master-data.class.students.add', $id))
                ->with('info', 'INFO : Tdak ada data Siswa yang anda pilih!');
        }
        $checkKelas = Kelas::select('id', 'name')->find($id);
        if (!$checkKelas) {
            return redirect(route('master-data.class.students'))
                ->with('error', 'Data kelas yang anda tuju tidak ditemukan!');
        }
        $student = new Student();
        foreach ($data as $i => $row) {
            $s = $student->select('id')->find($row);
            if ($s) {
                $s->kelas_id = $id;
                $s->save();
            }
        }

        return redirect(route('master-data.class.students', $id))
            ->with('message', count($data) . ' Siswa telah berhasil ditambahkan ke kelas ', $checkKelas->name);
    }

    function removeStudent($kelasId, $studentId)
    {
        $findStudent = Student::select('id', 'kelas_id', 'nisn')
            ->with('kelas')
            ->orWhere('kelas_id', $kelasId)
            ->find($studentId);
        if (!$findStudent) {
            return redirect(route('master-data.class.students'))
                ->with('error', 'Data Siswa yang anda tuju tidak ditemukan!');
        }
        $findStudent->kelas_id = null;
        $findStudent->save();

        return redirect(route('master-data.class.students', $kelasId))
            ->with('message', 'Siswa ' . $findStudent->nisn . ' telah berhasil ditambahkan dari kelas ' . $findStudent->kelas->name,);
    }
}
