<?php

namespace App\Http\Controllers;

use App\Models\Komplain;
use App\Models\Pengguna;
use App\Models\Status_Komplain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use DB;

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
//        \Log::info(json_encode($request->all()));
        $validated = $request->validate([
            "alamat" => "required",
            "isi" => "required",
            "kategori" => "required",
            "no_komplain" => "required",
            "status" => "required"
        ]);
        $path = Storage::disk('public_uploads')->putFile('foto', $request->file('foto'));
        $komplain = Komplain::create([
            'id_pengguna' => $request->user()->id_pengguna,
            'alamat' => $request->alamat,
            "berkas" => "",
            "isi" => $request->isi,
            "kategori" => $request->kategori,
            "no_komplain" => $request->no_komplain,
            "tanggal" => date("Y-m-d"),
            "status" => $request->status,
            "foto" => $path
        ]);

        return response('Data Berhasil Ditambah',200);
    }

    public function storeBerkas(Request $request)
    {
        \Log::info(json_encode($request->all()));
        $validated = $request->validate([
            "alamat" => "required",
            "isi" => "required",
            "kategori" => "required",
            "no_komplain" => "required",
            "status" => "required"
        ]);
        $path = Storage::disk('public_uploads')->putFile('berkas', $request->file('berkas'));
        $komplain = Komplain::create([
            'id_pengguna' => $request->user()->id_pengguna,
            'alamat' => $request->alamat,
            "berkas" => $path,
            "isi" => $request->isi,
            "kategori" => $request->kategori,
            "no_komplain" => $request->no_komplain,
            "tanggal" => date("Y-m-d"),
            "status" => $request->status,
            "foto" => ""
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

    public function getKomplainByKategori($kategori){
        $komplain = Komplain::query()->join('penggunas', 'penggunas.id_pengguna', '=', 'komplains.id_pengguna')
            ->join('penduduks', 'penggunas.id_penduduk', '=', 'penduduks.id_penduduk')
            ->leftJoin('sukas', 'komplains.id_komplain', '=', 'sukas.id_komplain')
            ->leftJoin('balasans', 'komplains.id_komplain', '=', 'balasans.id_komplain');
        if($kategori != "all")
            $komplain =  $komplain->where('komplains.kategori', '=', $kategori);
        $komplain = $komplain->select('komplains.*', 'penduduks.nama_penduduk as nama',  DB::raw("count(sukas.id_komplain) as jml_suka"), DB::raw("count(balasans.id_komplain) as jml_balas"))->groupBy('komplains.id_komplain')->get();

        return response()->json($komplain, 200);
    }

    public function getKomplainByPengguna($id){
        $komplain = Komplain::query()->join('penggunas', 'penggunas.id_pengguna', '=', 'komplains.id_pengguna')
            ->join('penduduks', 'penggunas.id_penduduk', '=', 'penduduks.id_penduduk')
            ->leftJoin('sukas', 'komplains.id_komplain', '=', 'sukas.id_komplain')
            ->leftJoin('balasans', 'komplains.id_komplain', '=', 'balasans.id_komplain')->where('penduduks.id_penduduk', '=', $id);
        $komplain = $komplain->select('komplains.*', 'penduduks.nama_penduduk as nama',  DB::raw("count(sukas.id_komplain) as jml_suka"), DB::raw("count(balasans.id_komplain) as jml_balas"))->groupBy('komplains.id_komplain')->get();

        return response()->json($komplain, 200);
    }

    public function getCountKomplai(){
        $komplain = Komplain::query()->select('kategori', DB::raw('COUNT(*) as "jumlah_komplain"'), DB::raw('count(*) *100 / (select count(*) from komplains) as persen'))->groupBy('kategori')->get();
        return response($komplain, 200);
    }

}
