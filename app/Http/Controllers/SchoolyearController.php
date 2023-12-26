<?php

namespace App\Http\Controllers;

use App\Models\Schoolyear;
use Illuminate\Http\Request;

class SchoolyearController extends Controller
{
    public function index()
    {
        $schoolyears = Schoolyear::all();
        return view('schoolyears.index', compact('schoolyears'));
    }

    public function create()
    {
        return view('schoolyears.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'start_year' => 'required|numeric',
            'end_year' => 'required|numeric',
            'semester_type' => 'required|in:gasal,genap',
            'description' => 'nullable|string',
        ]);

        Schoolyear::create($request->all());

        return redirect()->route('schoolyears.index')->with('success', 'School Year created successfully');
    }

    public function show(Schoolyear $schoolyear)
    {
        return view('schoolyears.show', compact('schoolyear'));
    }

    public function edit(Schoolyear $schoolyear)
    {
        return view('schoolyears.edit', compact('schoolyear'));
    }

    public function update(Request $request, Schoolyear $schoolyear)
    {
        $request->validate([
            'start_year' => 'required|numeric',
            'end_year' => 'required|numeric',
            'semester_type' => 'required|in:gasal,genap',
            'description' => 'nullable|string',
        ]);

        $schoolyear->update($request->all());

        return redirect()->route('schoolyears.index')->with('success', 'School Year updated successfully');
    }

    public function destroy(Schoolyear $schoolyear)
    {
        $schoolyear->delete();

        return redirect()->route('schoolyears.index')->with('success', 'School Year deleted successfully');
    }

}
