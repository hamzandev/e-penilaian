<?php

namespace App\Http\Controllers;

use App\Imports\SubjectImport;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class SubjectController extends Controller
{

    function import(Request $request)
    {
        $request->validate([
            'file_excel' => 'required|mimes:xls,xlsx|max:5120'
        ]);

        if (!$request->file('file_excel')) {
            return redirect(route('master-data.subject.index'))
                ->with('error', 'Anda harus mengupload file dalam format Excel!');
        }

        Excel::import(new SubjectImport(), $request->file('file_excel'));

        return redirect(route('master-data.subject.index'));
    }

    public function index()
    {
        $subject = Subject::with('teacher')->orderBy('name')->get();
        return view('backend.subject.index', compact('subject'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $teachers = Teacher::orderBy('name')->get();
        return view('backend.subject.create', compact('teachers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:subjects'
        ]);

        Subject::create($request->except('_token'));
        return redirect(route('master-data.subject.index'))->with('message', 'Mata Pelajaran baru berhasil ditambahkan!');
    }

    public function edit(Subject $subject)
    {
        $teachers = Teacher::orderBy('name')->get();
        return view('backend.subject.edit', compact('subject', 'teachers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subject $subject)
    {
        $request->validate([
            'name' => 'required|string',
            'teacher_id' => 'required|numeric|not_in:0',
        ]);

        if ($request->name != $subject->name) {
            $check = Subject::select('name')
                ->whereName($request->name)
                ->first();

            if ($check) {
                return redirect(route('master-data.subject.edit', $subject->id))
                    ->with('error', 'Mata Pelajaran ' . $request->name . ' telah ada. Gunakan mata pelajaran lain!');
            }
        }
        // if ($request->teacher_id != $request->teacher_id) {
        //     $checkTeacher = Subject::select('teacher_id')
        //         ->whereTeacherId($request->teacher_id)
        //         ->first();

        //     if ($checkTeacher) {
        //         return redirect(route('master-data.subject.edit', $subject->id))
        //             ->with('error', 'Maaf telah ada. Gunakan mata pelajaran lain!');
        //     }
        // }

        $subject->name = $request->name;
        $subject->teacher_id = $request->teacher_id;
        $subject->save();

        return redirect(route('master-data.subject.index'))
            ->with('message', 'Mata Pelajaran ' . $subject->name . '  berhasil diperbarui menjadi ' . $request->name);
    }


    public function destroy(Subject $subject)
    {
        $subject->delete();
        return redirect(route('master-data.subject.index'))
            ->with('message', 'Mata Pelajaran ' . $subject->name . '  berhasil dihapus');
    }
}
