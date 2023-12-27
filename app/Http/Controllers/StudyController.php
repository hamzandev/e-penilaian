<?php

namespace App\Http\Controllers;

use App\Models\FinalValue;
use App\Models\Grade;
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
        $studies = Subject::whereHas('teacher', function ($q) {
            $q->whereHas('kelas', function ($query) {
                $query->with('kelasLevel');
            })->whereTeacherId(auth()->user()->id);
        })->get();

        // $data = Study::with(['teacher'])
        // return dd($studies[0]->teacher->kelas);

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
            'knowledge.*' => 'required|numeric',
            'ability.*' => 'required|numeric',
            'pts.*' => 'required|numeric',
            'pas.*' => 'required|numeric',
            'description.*' => 'nullable|string',
        ]);

        $knowledge = $request->input('knowledge');
        $ability = $request->input('ability');
        $pts = $request->input('pts');
        $pas = $request->input('pas');
        $description = $request->input('description');

        foreach ($knowledge as $i => $knowledgeValue) {
            // Lakukan penyimpanan ke database per baris
            $study = FinalValue::updateOrCreate([
                'student_id' => $request->input('student_id')[$i],
            ], [
                'knowledge' => $knowledgeValue,
                'ability' => $ability[$i],
                'pts' => $pts[$i],
                'pas' => $pas[$i],
                'average' => intval(intval($knowledge) + intval($pts[$i]) + intval($pas[$i]) + intval($ability[$i])) / 4,
            ]);

            $average = ($knowledgeValue + $ability[$i] + $pts[$i] + $pas[$i]) / 4;

            $study->description = $description[$i];
            $study->average = $average;
            $study->save();
        }

        return redirect()->back();
    }

    public function show($id)
    {
        $data = Subject::whereHas('teacher', function ($q) {
            $q->whereHas('kelas', function ($query) {
                $query->with('kelasLevel')->whereHas('student', function ($q) {
                    $q->with('finalValue');
                });
            })->whereTeacherId(auth()->user()->id);
        })->find($id);

        // $siswas = $data->teacher->kelas->student;
        // foreach ($siswas as $key => $siswa) {
        //     $grades = Grade::whereHas('student', function($query) use ($siswa){
        //         $query->whereId($siswa->id);
        //     })->get();
        // }
        // return dd($data->teacher->kelas->student);
        // return dd($nilaiSiswas);

        // $studies = FinalValue::whereHas('student', function($query){
        //     $query->whereHas('kelas', function($q){
        //         $q->whereHas('teacher', function($q){
        //             $q->
        //         })->whereId(auth()->user()->id);
        //     })
        // })->get();
        // return dd($studies);
        // $data = Kelas::with('student')->where('teacher_id', auth()->user()->id)->find($id)->student;
        // return dd($data->student);
        // $studentsId = [];
        // foreach($data as $s){
        //     $dataArr[] = $s->id;
        // }

        // return dd($data);
        // $data = Student

        $studentsId = [];
        foreach ($data->teacher->kelas->student as $key => $student) {
            $studentsId[] = $student->id;
        }

        // return dd($studentsId);

        return view('studies.show', compact('data'));
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
        // $request->validate([
        //     'kelas_id' => 'required|integer',
        //     'subject_id' => 'required|integer',
        //     'teacher_id' => 'required|integer',
        //     'standard' => 'required|integer',
        // ]);

        return dd($request->all());

        // return redirect()->route('studies.index')->with('success', 'Study updated successfully');
    }

    public function destroy(Study $study)
    {
        $study->delete();

        return redirect()->route('studies.index')->with('success', 'Study deleted successfully');
    }
}
