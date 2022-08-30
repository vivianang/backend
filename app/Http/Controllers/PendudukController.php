<?php

namespace App\Http\Controllers;

use App\Models\Penduduk;
use Illuminate\Http\Request;

class PendudukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $penduduk=Penduduk::query()->get();

        return response()->json($penduduk, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nik' => 'required|unique:penduduks|numeric',
            "nama_penduduk" => "required",
            "jenis_kelamin" => "required",
            'tempat_lahir' => 'required',
            "tanggal_lahir" => "required",
            "alamat" => "required"
        ]);
        $penduduk = Penduduk::create([
            'nik' => $request->nik,
            'nama_penduduk' => $request->nama_penduduk,
            "jenis_kelamin" => $request->jenis_kelamin,
            'tempat_lahir' => $request->tempat_lahir,
            "tanggal_lahir" => $request->tanggal_lahir,
            "alamat" => $request->alamat,
        ]);

        return response('Data Berhasil Ditambah',200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Penduduk  $penduduk
     * @return \Illuminate\Http\Response
     */
    public function show(Penduduk $penduduk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Penduduk  $penduduk
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $penduduk = Penduduk::find($id);

        return response()->json($penduduk, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Penduduk  $penduduk
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $validated = $request->validate([
            'nik' => 'required',
            "nama_penduduk" => "required",
            "jenis_kelamin" => "required",
            'tempat_lahir' => 'required',
            "tanggal_lahir" => "required",
            "alamat" => "required"
        ]);

        $param = [
            'nik' => $request->nik,
            'nama_penduduk' => $request->nama_penduduk,
            "jenis_kelamin" => $request->jenis_kelamin,
            'tempat_lahir' => $request->tempat_lahir,
            "tanggal_lahir" => $request->tanggal_lahir,
            "alamat" => $request->alamat,
        ];

        $penduduk = Penduduk::query()->where('id_penduduk', '=', $id)->update($param);
        return response('Data Berhasil Diubah',200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Penduduk  $penduduk
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $penduduk = Penduduk::query()->where('id_penduduk', '=', $id)->delete();
        return response('Data Berhasil Dihapus',200);
    }

    public function searchPendudukByNik($nik)
    {
        $penduduk = Penduduk::query()->where('nik', '=', $nik)->first();
        if(!$penduduk)
            return response()->json($penduduk, 404);

        return response($penduduk, 200);
    }
}
