<?php

namespace App\Http\Controllers;

use App\Models\Suka;
use Illuminate\Http\Request;

class SukaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suka = Suka::query()->join('komplains', 'sukas.id_komplain', '=', 'komplains.id_komplain')
            ->join('penggunas', 'penggunas.id_Pengguna', '=', 'sukas.id_Pengguna')
            ->get();
        $data = [
            'suka' => $suka,
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
            'id_komplain' => 'required',
            "id_pengguna" => "required"
        ]);
        $pengguna = Suka::create([
            'id_komplain' => $request->id_komplain,
            'id_pengguna' => $request->id_pengguna
        ]);
        return response('Data Berhasil Ditambah',200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Suka  $suka
     * @return \Illuminate\Http\Response
     */
    public function show(Suka $suka)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Suka  $suka
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $suka = Suka::find($id);

        return response()->json(['data' => $suka], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Suka  $suka
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Suka $suka)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Suka  $suka
     * @return \Illuminate\Http\Response
     */
    public function destroy(Suka $suka)
    {
        //
    }
}
