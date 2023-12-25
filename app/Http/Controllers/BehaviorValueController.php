<?php

namespace App\Http\Controllers;

use App\Models\BehaviorValue;
use App\Models\Student;
use Illuminate\Http\Request;

class BehaviorValueController extends Controller
{
    public function index()
    {
        $behaviorValues = BehaviorValue::all();
        return view('behavior_values.index', compact('behaviorValues'));
    }

    public function create()
    {
        $students = Student::pluck('name', 'id');
        return view('behavior_values.create', compact('students'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|integer',
            'predicate' => 'required|in:A,B,C,D,E',
            'behavior_type' => 'required|string',
            'description' => 'nullable|string',
        ]);

        BehaviorValue::create($request->all());

        return redirect()->route('behavior_values.index')->with('success', 'Behavior Value created successfully');
    }

    public function show(BehaviorValue $behaviorValue)
    {
        return view('behavior_values.show', compact('behaviorValue'));
    }

    public function edit(BehaviorValue $behaviorValue)
    {
        $students = Student::pluck('name', 'id');
        return view('behavior_values.edit', compact('behaviorValue', 'students'));
    }

    public function update(Request $request, BehaviorValue $behaviorValue)
    {
        $request->validate([
            'student_id' => 'required|integer',
            'predicate' => 'required|in:A,B,C,D,E',
            'behavior_type' => 'required|string',
            'description' => 'nullable|string',
        ]);

        $behaviorValue->update($request->all());

        return redirect()->route('behavior_values.index')->with('success', 'Behavior Value updated successfully');
    }

    public function destroy(BehaviorValue $behaviorValue)
    {
        $behaviorValue->delete();

        return redirect()->route('behavior_values.index')->with('success', 'Behavior Value deleted successfully');
    }
}
