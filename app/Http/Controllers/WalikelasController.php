<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;

class WalikelasController extends Controller
{

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

    function studies() {
        // $data = Subject::
        return view('backend.wali-kelas.studies');
    }

    function studyDetail($subjectId) {
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
