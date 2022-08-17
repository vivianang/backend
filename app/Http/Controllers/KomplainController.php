<?php

namespace App\Http\Controllers;

use App\Models\Komplain;
use App\Models\Pengguna;
use Illuminate\Http\Request;

class KomplainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $komplain = Komplain::query()->join('penggunas', 'penggunas.id_pengguna', '=', 'komplains.id_pengguna')->get();
        $pengguna = Pengguna::query()->get();
        $data = [
            'komplain' => $komplain,
            'pengguna' => $pengguna
        ];

        return response()->json([$data], 200);
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
            'id_pengguna' => 'required',
            "alamat" => "required",
            "berkas" => "required",
            "foto" => "required",
            "isi" => "required",
            "kategori" => "required",
            "no_komplain" => "required",
            "tanggal" => "required",
            "status" => "required"
        ]);
        $komplain = Komplain::create([
            'id_pengguna' => $request->id_pengguna,
            'alamat' => $request->alamat,
            "berkas" => $request->berkas,
            "foto" => $request->foto,
            "isi" => $request->isi,
            "kategori" => $request->kategori,
            "no_komplain" => $request->no_komplain,
            "tanggal" => $request->tanggal,
            "status" => $request->status
        ]);
        return response('Data Berhasil Ditambah',200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Komplain  $komplain
     * @return \Illuminate\Http\Response
     */
    public function show(Komplain $komplain)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Komplain  $komplain
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $komplain = Komplain::find($id);

        return response()->json(['data' => $komplain], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Komplain  $komplain
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $validated = $request->validate([
            'id_pengguna' => 'required',
            "alamat" => "required",
            "berkas" => "required",
            "foto" => "required",
            "isi" => "required",
            "kategori" => "required",
            "no_komplain" => "required",
            "tanggal" => "required",
            "status" => "required"
        ]);

        $param = [
            'id_pengguna' => $request->id_pengguna,
            'alamat' => $request->alamat,
            "berkas" => $request->berkas,
            "foto" => $request->foto,
            "isi" => $request->isi,
            "kategori" => $request->kategori,
            "no_komplain" => $request->no_komplain,
            "tanggal" => $request->tanggal,
            "status" => $request->status
        ];
        $komplain = Komplain::query()->where('id_komplain', '=', $id)->update($param);
        return response('Data Berhasil Diubah',200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $komplain = Komplain::query()->where('id_komplain', '=', $id)->delete();
        return response('Data Berhasil Dihapus',200);
    }
}
