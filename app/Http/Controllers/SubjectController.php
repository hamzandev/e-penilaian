<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subject = Subject::orderBy('name')->get();
        return view('backend.subject.index', compact('subject'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.subject.create');
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
        return view('backend.subject.edit', compact('subject'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subject $subject)
    {
        $request->validate([
            'name' => 'required|string'
        ]);

        if ($request->name != $subject->name) {
            $check = Subject::select('name')->whereName($request->name);
            if ($check) {
                return redirect(route('master-data.subject.edit', $subject->id))
                    ->with('error', 'Mata Pelajaran ' . $request->name . ' telah ada. Gunakan mata pelajaran lain!');
            }
        }

        $subject->update($request->except(['_token', '_method']));
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
