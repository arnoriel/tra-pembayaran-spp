<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Spp;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $siswa = Siswa::with('kelas', 'spp')->paginate(5);
        $kelas = Kelas::all();
        $spp = Spp::all();
        return view('admin.siswa.index', compact('siswa', 'kelas', 'spp'));
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
        $this->validate($request, [
            'nisn' => 'required|unique:siswas,nisn',
            'nis' => 'required|unique:siswas,nis',
            'nama' => 'required',
            'kelas_id' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
            'spp_id' => 'required',
        ]);

        $siswa = Siswa::create([
            'nisn' => $request->input('nisn'),
            'nis' => $request->input('nis'),
            'nama' => $request->input('nama'),
            'kelas_id' => $request->input('kelas_id'),
            'alamat' => $request->input('alamat'),
            'no_hp' => $request->input('no_hp'),
            'spp_id' => $request->input('spp_id'),
        ]);

        if($siswa){
            return redirect()->route('siswa.index')->with(['success' => 'Data Siswa Berhasil Disimpan!']);
        }else{
            return redirect()->route('siswa.index')->with(['error' => 'Data Siswa Tidak Dapat Disimpan :(']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Siswa $siswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Siswa $siswa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nisn' => 'required|unique:siswas,nisn',
            'nis' => 'required|unique:siswas,nis',
            'nama' => 'required',
            'kelas_id' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
            'spp_id' => 'required',      
        ]);

        $siswa = Siswa::findOrFail($id);
        $siswa->update([
            'nisn' => $request->input('nisn'),
            'nis' => $request->input('nis'),
            'nama' => $request->input('nama'),
            'kelas_id' => $request->input('kelas_id'),
            'alamat' => $request->input('alamat'),
            'no_hp' => $request->input('no_hp'),
            'spp_id' => $request->input('spp_id'),
        ]);

        if($siswa){
            return redirect()->route('siswa.index')->with(['update' => 'Data Siswa Berhasil Di Update!']);
        }else{
            return redirect()->route('siswa.index')->with(['error' => 'Data Siswa Tidak Dapat Di Update :(']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);
        $siswa->delete();

        if($siswa){
            return redirect()->route('siswa.index')->with(['delete' => 'Data Siswa Berhasil Di Delete!']);
        }else{
            return redirect()->route('siswa.index')->with(['error' => 'Data Siswa Tidak Dapat Di Delete :(']);
        }
    }
}
