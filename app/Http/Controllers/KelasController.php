<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kelas = Kelas::orderBy('name')->get();
        return view('backend.class.index', compact('kelas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.class.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:kelas',
        ]);
        Kelas::create($request->except('_token'));
        return redirect(route('master-data.class.index'))->with('message', 'Kelas baru berhasil ditambahkan!');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $kelas = Kelas::find($id);
        return view('backend.class.edit', compact('kelas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);

        try {
            $kelas = Kelas::find($id);

            if (!$kelas) {
                return redirect(route('master-data.class.index'))->with('error', 'Data kelas tidak ditemukan!');
            }
            if ($request->name != $kelas->name) {
                $find = Kelas::select('name')->whereName($request->name)->first();
                if ($find) {
                    return redirect(route('master-data.class.edit', $kelas->id))
                        ->with('error', 'Data kelas ' . $request->name . ' telah ada. Silahkan input kelas yang berbeda!');
                }
            }

            $kelas->update([
                'name' => $request->post('name'),
            ]);

            return redirect(route('master-data.class.index'))
                ->with('message', 'Data kelas ' . $request->name . ' berhasil diperbarui!');
        } catch (\Throwable $th) {
            return redirect(route('master-data.class.index'))
                ->with('error', 'Telah terjadi kesalahan. Silahkan coba lagi nanti!');
        }
    }


    public function destroy($id)
    {
        $find = Kelas::select('id')->find($id);
        if (!$find) {
            return redirect(route('master-data.class.index'))->with('error', 'Data kelas tidak ditemukan!');
        }

        $find->delete();
        return redirect(route('master-data.class.index'))->with('message', 'Data kelas berhasil dihapus!');
    }
}
