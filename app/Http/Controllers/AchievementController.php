<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use App\Models\Student;
use Illuminate\Http\Request;

class AchievementController extends Controller
{
    public function index()
    {
        $achievements = Achievement::all();
        return view('achievements.index', compact('achievements'));
    }

    public function create()
    {
        $students = Student::pluck('name', 'id');
        return view('achievements.create', compact('students'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|integer',
            'type' => 'required|in:akademik,non-akademik',
            'description' => 'nullable|string',
        ]);

        Achievement::create($request->all());

        return redirect()->route('achievements.index')->with('success', 'Achievement created successfully');
    }

    public function show(Achievement $achievement)
    {
        return view('achievements.show', compact('achievement'));
    }

    public function edit(Achievement $achievement)
    {
        $students = Student::pluck('name', 'id');
        return view('achievements.edit', compact('achievement', 'students'));
    }

    public function update(Request $request, Achievement $achievement)
    {
        $request->validate([
            'student_id' => 'required|integer',
            'type' => 'required|in:akademik,non-akademik',
            'description' => 'nullable|string',
        ]);

        $achievement->update($request->all());

        return redirect()->route('achievements.index')->with('success', 'Achievement updated successfully');
    }

    public function destroy(Achievement $achievement)
    {
        $achievement->delete();

        return redirect()->route('achievements.index')->with('success', 'Achievement deleted successfully');
    }

}
