<?php

namespace App\Http\Controllers;

use App\Models\Precense;
use App\Models\Student;
use Illuminate\Http\Request;

class PrecenseController extends Controller
{
    public function index()
    {
        $precenses = Precense::all();
        return view('precenses.index', compact('precenses'));
    }

    public function create()
    {
        $students = Student::pluck('name', 'id');
        return view('precenses.create', compact('students'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|integer',
            'sick' => 'nullable|integer',
            'permit' => 'nullable|integer',
            'absent' => 'nullable|integer',
        ]);

        Precense::create($request->all());

        return redirect()->route('precenses.index')->with('success', 'Precense created successfully');
    }

    public function show(Precense $precense)
    {
        return view('precenses.show', compact('precense'));
    }

    public function edit(Precense $precense)
    {
        $students = Student::pluck('name', 'id');
        return view('precenses.edit', compact('precense', 'students'));
    }

    public function update(Request $request, Precense $precense)
    {
        $request->validate([
            'student_id' => 'required|integer',
            'sick' => 'nullable|integer',
            'permit' => 'nullable|integer',
            'absent' => 'nullable|integer',
        ]);

        $precense->update($request->all());

        return redirect()->route('precenses.index')->with('success', 'Precense updated successfully');
    }

    public function destroy(Precense $precense)
    {
        $precense->delete();

        return redirect()->route('precenses.index')->with('success', 'Precense deleted successfully');
    }
}
