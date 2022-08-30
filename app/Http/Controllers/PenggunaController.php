<?php

namespace App\Http\Controllers;

use App\Models\Penduduk;
use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PenggunaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pengguna = Pengguna::query()->join('penduduks', 'penduduks.id_penduduk', '=', 'penggunas.id_penduduk')->get();
        $penduduk = Penduduk::query()->get();
        $data = [
            'pengguna' => $pengguna,
            'penduduk' => $penduduk
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
        $validator = \Validator::make($request->all(), [
            'id_penduduk' => 'required|unique:penggunas',
            "password" => "required",
            "no_telpon" => "required"
        ]);

        if ($validator->fails()) {
            return response($validator->errors(), 302);
        }

        $validator = \Validator::make($request->all(), [
            'email' => 'required|unique:penggunas',
        ]);

        if ($validator->fails()) {
            return response($validator->errors(), 409);
        }

        $pengguna = Pengguna::create([
            'id_penduduk' => $request->id_penduduk,
            'email' => $request->email,
            "password" => Hash::make($request->password),
            "no_telpon" => $request->no_telpon
        ]);
        return response('Data Berhasil Ditambah',200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pengguna  $pengguna
     * @return \Illuminate\Http\Response
     */
    public function show(Pengguna $pengguna)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pengguna  $pengguna
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pengguna = Pengguna::find($id);

        return response()->json(['data' => $pengguna], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pengguna  $pengguna
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $validated = $request->validate([
            'id_penduduk' => 'required',
            "email" => "required",
            "password" => "required",
            "no_telpon" => "required"
        ]);

        $param = [
            'id_penduduk' => $request->id_penduduk,
            'email' => $request->email,
            "password" => Hash::make($request->password),
            "no_telpon" => $request->no_telpon
        ];
        $pengguna = Pengguna::query()->where('id_pengguna', '=', $id)->update($param);
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
        $pengguna = Pengguna::query()->where('id_pengguna', '=', $id)->delete();
        return response('Data Berhasil Dihapus',200);
    }
}
