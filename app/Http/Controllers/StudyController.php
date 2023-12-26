<?php

namespace App\Http\Controllers;

use App\Models\Study;
use App\Models\Kelas;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;

class StudyController extends Controller
{
    public function index()
    {
        $studies = Study::with('kelas')->with('subject')->with('teacher')->get();
        return view('studies.index', compact('studies'));
    }

    public function create()
    {
        // $kelasList = Kelas::pluck('name', 'id');
        // $subjectList = Subject::pluck('name', 'id');
        // $teacherList = Teacher::pluck('name', 'id');

        $student = Student::pluck('id', 'name', 'nisn');
        $teacher = Teacher::pluck('id', 'name', 'nuptk');
        $subject = Subject::pluck('id', 'name');
        $kelas = Kelas::with('teacher')->get();
        return view('studies.create', compact('student', 'teacher', 'kelas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kelas_id' => 'required|integer',
            'subject_id' => 'required|integer',
            'teacher_id' => 'required|integer',
            'standard' => 'required|integer',
        ]);

        Study::create($request->all());

        return redirect()->route('studies.index')->with('success', 'Study created successfully');
    }

    public function show(Study $study)
    {
        return view('studies.show', compact('study'));
    }

    public function edit(Study $study)
    {
        $kelasList = Kelas::pluck('name', 'id');
        $subjectList = Subject::pluck('name', 'id');
        $teacherList = Teacher::pluck('name', 'id');

        return view('studies.edit', compact('study', 'kelasList', 'subjectList', 'teacherList'));
    }

    public function update(Request $request, Study $study)
    {
        $request->validate([
            'kelas_id' => 'required|integer',
            'subject_id' => 'required|integer',
            'teacher_id' => 'required|integer',
            'standard' => 'required|integer',
        ]);

        $study->update($request->all());

        return redirect()->route('studies.index')->with('success', 'Study updated successfully');
    }

    public function destroy(Study $study)
    {
        $study->delete();

        return redirect()->route('studies.index')->with('success', 'Study deleted successfully');
    }
}
