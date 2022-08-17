<?php

namespace App\Http\Controllers;

use App\Models\Komplain;
use App\Models\Status_Komplain;
use Illuminate\Http\Request;

class StatusKomplainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $statusKomplain = Status_Komplain::query()->join('komplains', 'komplains.id_komplain', '=', 'status__komplains.id_komplain')->get();
        $komplain = Komplain::query()->get();
        $data = [
            'statusKomplain' => $statusKomplain,
            'komplain' => $komplain
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
            'id_komplain' => 'required',
            "nama_pemeroses" => "required",
            "pesan" => "required",
            "status" => "required"
        ]);
        $statusKomplain = Status_Komplain::create([
            'id_komplain' => $request->id_komplain,
            'nama_pemeroses' => $request->nama_pemeroses,
            "pesan" => $request->pesan,
            "status" => $request->status,
        ]);
        return response('Data Berhasil Ditambah',200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Status_Komplain  $status_Komplain
     * @return \Illuminate\Http\Response
     */
    public function show(Status_Komplain $status_Komplain)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Status_Komplain  $status_Komplain
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $statusKomplain = Status_Komplain::find($id);

        return response()->json(['data' => $statusKomplain], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Status_Komplain  $status_Komplain
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $validated = $request->validate([
            'id_komplain' => 'required',
            "nama_pemeroses" => "required",
            "pesan" => "required",
            "status" => "required"
        ]);

        $param = [
            'id_komplain' => $request->id_komplain,
            'nama_pemeroses' => $request->nama_pemeroses,
            "pesan" => $request->pesan,
            "status" => $request->status,
        ];
        $statusKomplain = Status_Komplain::query()->where('id_status_komplain', '=', $id)->update($param);
        return response('Data Berhasil Diubah',200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Status_Komplain  $status_Komplain
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $statusKomplain = Status_Komplain::query()->where('id_status_komplain', '=', $id)->delete();
        return response('Data Berhasil Dihapus',200);
    }
}
