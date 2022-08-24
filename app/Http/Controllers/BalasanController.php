<?php

namespace App\Http\Controllers;

use App\Models\Balasan;
use App\Models\Suka;
use Illuminate\Http\Request;

class BalasanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($idKomplain)
    {
        $balasan = Balasan::query()->join('komplains', 'balasans.id_komplain', '=', 'komplains.id_komplain')
            ->join('penggunas', 'penggunas.id_Pengguna', '=', 'balasans.id_Pengguna')
            ->leftJoin('admins', 'admins.id_admin', '=', 'balasans.id_Pengguna')
            ->where('komplains.id_komplain', '=', $idKomplain)
            ->get();
        if(count($balasan) == 0)
            return response()->json([$balasan], 404);

        return response()->json($balasan, 200);
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
        $user = $request->user();
        $validated = $request->validate([
            'id_komplain' => 'required',
            "balasan" => "required"
        ]);
        $balasan = Balasan::create([
            'id_komplain' => $request->id_komplain,
            'id_pengguna' => $user->id_admin,
            "balasan" => $request->balasan
        ]);
        return response($balasan,200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Balasan  $balasan
     * @return \Illuminate\Http\Response
     */
    public function show(Balasan $balasan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Balasan  $balasan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $balasan = Balasan::find($id);

        return response()->json(['data' => $balasan], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Balasan  $balasan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Balasan $balasan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Balasan  $balasan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Balasan $balasan)
    {
        //
    }
}
