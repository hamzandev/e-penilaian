<?php

namespace App\Http\Controllers;

use App\Models\FinalValue;
use App\Models\Student;
use Illuminate\Http\Request;

class FinalValueController extends Controller
{
    public function index()
    {
        $finalValues = FinalValue::all();
        return view('final_values.index', compact('finalValues'));
    }

    public function create()
    {
        $students = Student::pluck('name', 'id');
        return view('final_values.create', compact('students'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|integer',
            'knowledge' => 'required|numeric',
            'ability' => 'required|numeric',
            'pts' => 'required|numeric',
            'pas' => 'required|numeric',
            'average' => 'required|numeric',
        ]);

        FinalValue::create($request->all());

        return redirect()->route('final_values.index')->with('success', 'Final Value created successfully');
    }

    public function show(FinalValue $finalValue)
    {
        return view('final_values.show', compact('finalValue'));
    }

    public function edit(FinalValue $finalValue)
    {
        $students = Student::pluck('name', 'id');
        return view('final_values.edit', compact('finalValue', 'students'));
    }

    public function update(Request $request, FinalValue $finalValue)
    {
        $request->validate([
            'student_id' => 'required|integer',
            'knowledge' => 'required|numeric',
            'ability' => 'required|numeric',
            'pts' => 'required|numeric',
            'pas' => 'required|numeric',
            'average' => 'required|numeric',
        ]);

        $finalValue->update($request->all());

        return redirect()->route('final_values.index')->with('success', 'Final Value updated successfully');
    }

    public function destroy(FinalValue $finalValue)
    {
        $finalValue->delete();

        return redirect()->route('final_values.index')->with('success', 'Final Value deleted successfully');
    }
}
