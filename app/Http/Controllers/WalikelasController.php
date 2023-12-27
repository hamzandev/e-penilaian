<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Kelas;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;

class WalikelasController extends Controller
{

    function studentDetail($kelasId, $teacherId, $studentId)
    {
        $data = Student::whereHas('kelas', function ($query) use ($kelasId, $teacherId) {
            $query->whereHas('teacher', function ($q) use ($teacherId) {
                $q->where('id', $teacherId);
            })->whereKelasId($kelasId);
        })->find($studentId);

        $subjects = Subject::select('id', 'name')->get();
        $values = Grade::whereStudentId($studentId)->get();
        // return dd($data);

        return view('backend.wali-kelas.students-detail', compact('data', 'subjects', 'values'));
        // $grades =
    }

    function studentDetailAction(Request $request, $kelasId, $teacherId, $studentId)
    {
        // $data = Student::whereHas('kelas', function ($query) use ($kelasId) {
        //     $query->whereKelasId($kelasId);
        // })->find($studentId);
        $inputs = ($request->except(['_token', '_method', 'datatable_length']));
        $keys = array_keys($inputs);
        $data = array_values($inputs);
        // return dd($data);
        foreach ($keys as $i => $key) {
            Grade::whereId($key)->updateOrCreate([
                'student_id' => $studentId,
                'teacher_id' => $teacherId,
                'subject_id' => $key,
                'value' => $data[$i],
            ]);
        }

        return redirect(route('wali-kelas.students', [$kelasId, $teacherId]))
            ->with('message', 'Nilai siswa berhasil di Simpan!');

        // $subjects = Subject::select('id', 'name')->get();
        // $values = Grade::whereStudentId($studentId)->get();

        // return view('backend.wali-kelas.students-detail', compact('data', 'subjects', 'values'));
        // $grades =
    }

    function index()
    {
        $currentUser = User::select('id')->with('teacher')->find(auth()->user()->id);
        $myClasses = Kelas::with('teacher')
            ->with('schoolyear')
            ->with('kelasLevel')
            ->whereTeacherId($currentUser->teacher->id)->get();
        return view('backend.wali-kelas.my-class', compact('myClasses'));
    }

    public function classDetail($kelasId, $teacherId)
    {
        $currentUser = User::select('id')->with('teacher')->find(auth()->user()->id);
        // $studentsOfClass = Kelas::with('student')->whereTeacherId($currentUser->teacher->id)->first();
        $studentsOfClass = Kelas::with('student')
            ->with('schoolyear')
            ->with('kelasLevel')
            ->whereTeacherId($teacherId)->where('id', $kelasId)->first();


        return view('backend.wali-kelas.students', compact('studentsOfClass'));
    }

    function studies()
    {
        // $data = Subject::
        return view('backend.wali-kelas.studies');
    }

    function studyDetail($subjectId)
    {
        return view('backend.wali-kelas.study-detail');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
