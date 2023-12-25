<?php

namespace App\Http\Controllers;

use App\Models\KelasLevel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KelasLevelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kelasLevels = KelasLevel::all();
        return view('kelas.levels.index', compact('kelasLevels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kelas.levels.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'level' => 'required|string',
        ]);

        KelasLevel::create($request->all());

        return redirect()->route('kelas.levels.index')->with('success', 'Berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('kelas.levels.show', compact('kelasLevel'));
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
