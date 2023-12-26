<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Kelas;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $grade = Grade::with(['student', 'teacher', 'subject'])->get();
        // return dd($grade);
        return view('backend.grade.index', compact('grade'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $student = Student::select('id', 'name', 'nisn')->get();
        $teacher = Teacher::select('id', 'name', 'nuptk')->get();
        $kelas = Subject::select('id', 'name')->get();
        return view('backend.grade.create', compact('kelas', 'teacher', 'student'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return dd($request->all());
        Grade::create($request->except('_token'));
        // return redirect(route('master-data.subject.index'))
        // ->with('error', 'Anda harus mengupload file dalam format Excel!');
        $mapel = Subject::select('name')->find($request->post('subject_id'));
        $student = Student::select('name')->find($request->post('student_id'));
        return redirect(route('academics.grades.index'))
            ->with('message', 'Data nilai ' . $mapel->name . ' Siswa ' . $student->name . ' berhasil diinput!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Grade $grade)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Grade $grade)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Grade $grade)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Grade $grade)
    {
        //
    }
}
