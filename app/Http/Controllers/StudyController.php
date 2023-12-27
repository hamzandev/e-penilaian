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
        // $request->validate([
        //     'kelas_id' => 'required|integer',
        //     'subject_id' => 'required|integer',
        //     'teacher_id' => 'required|integer',
        //     'standard' => 'required|integer',
        // ]);

        // Study::create($request->all());

        // return redirect()->route('studies.index')->with('success', 'Study created successfully');
        // return dd();
        $data = $request->except(['_token', 'datatable_length']);

        // Loop melalui data siswa dari form

        // return (dd($data));
        $inputArray = [
            "knowledge2" => "8",
            "ability2" => "8",
            "pts2" => "8",
            "pas2" => "8",
            "description2" => "989",
            "student_id1" => "1",
            "knowledge1" => "8",
            "ability1" => "8",
            "pts1" => "8",
            "pas1" => "8",
            "description1" => "8",
            "student_id3" => "3",
            "knowledge3" => "8",
            "ability3" => "8",
            "pts3" => "8",
            "pas3" => "8",
            "description3" => "8",
        ];

        $newArrays = [];
        $currentStudentId = null;

        foreach ($inputArray as $key => $value) {
            preg_match('/^(\w+)(\d+)$/', $key, $matches);

            if (count($matches) == 3) {
                $field = $matches[1];
                $studentId = $matches[2];

                // Memulai array baru jika student_id berubah
                if ($studentId != $currentStudentId) {
                    $currentStudentId = $studentId;
                    $newArrays[$currentStudentId] = [];
                }

                // Menambahkan data ke dalam array baru
                $newArrays[$currentStudentId][$field] = $value;
            }
        }

        // Menghapus elemen array yang memiliki index numerik
        $newArrays = array_filter($newArrays, function ($key) {
            return is_numeric($key); // Sesuaikan dengan kebutuhan Anda
        }, ARRAY_FILTER_USE_KEY);

        // Reindex array
        $newArrays = array_values($newArrays);

        // Cetak hasil
        print_r($newArrays);

        // FinalValue
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
