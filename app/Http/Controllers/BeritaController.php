<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\BalasanBerita;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $berita = Berita::query()->join('admins', 'admins.id_admin', '=', 'beritas.id_admin')->get();


        return response()->json($berita, 200);
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
        $path = Storage::disk('public_uploads')->putFile('berita', $request->file('foto'));
        \Log::info($path);
        $berita = Berita::create([
            'id_admin' => $request->user()->id_admin,
            'isi_berita' => $request->isi_berita,
            'foto'  => $path,
            'judul' => $request->judul
        ]);
        return response('Data Berhasil Ditambah',200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $berita = Berita::find($id);

        return response()->json(['data' => $berita], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $validated = $request->validate([
            'id_admin' => 'required',
            'isi_berita' => 'required',
        ]);
        $path = Storage::disk('public_uploads')->putFile('berita', $request->file('foto'));
        $param = [
            'id_admin' => $request->id_admin,
            'isi_berita' => $request->isi_berita,
            'foto' => $path
        ];
        $berita = Berita::query()->where('id_berita', '=', $id)->update($param);
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
        $berita = Berita::query()->where('id_berita', '=', $id)->delete();
        return response('Data Berhasil Dihapus',200);
    }

    public function addBalasan(Request $request){
        $user = $request->user();

        if(isset($user->id_pengguna))
            $idUser = $user->id_pengguna;
        else
            $idUser = $user->id_admin;
        $validated = $request->validate([
            'id_berita' => 'required',
            "balasan" => "required"
        ]);
        $balasan = BalasanBerita::create([
            'id_berita' => $request->id_berita,
            'id_pengguna' => $idUser,
            "balasan" => $request->balasan
        ]);
        return response($balasan,200);
    }

    public function getBalasan($id){
        $balasanAdmin = BalasanBerita::query()->join('beritas', 'balasans_berita.id_berita', '=', 'beritas.id_berita')
            ->leftJoin('admins', 'admins.id_admin', '=', 'balasans_berita.id_pengguna')
            ->select('balasans_berita.id_balasan','balasans_berita.balasan as balasan', 'admins.email as email', 'admins.nama as nama')
            ->where('nama', '!=', null)
            ->where('beritas.id_berita', '=', $id)->get()->toArray();
        $balasanPengguna = BalasanBerita::query()->join('beritas', 'balasans_berita.id_berita', '=', 'beritas.id_berita')
            ->leftJoin('penggunas', 'penggunas.id_pengguna', '=', 'balasans_berita.id_pengguna')
            ->leftJoin('penduduks', 'penduduks.id_penduduk', '=', 'penggunas.id_penduduk')
            ->select('balasans_berita.id_balasan','balasans_berita.balasan as balasan', 'penggunas.email as email', 'penduduks.nama_penduduk as nama')
            ->where('penduduks.nama_penduduk', '!=', null)
            ->where('beritas.id_berita', '=', $id)->get()->toArray();

        $balasan = array_merge($balasanAdmin, $balasanPengguna);
        if(count($balasan) == 0)
            return response()->json($balasan, 404);

        return response()->json($balasan, 200);
    }
}
