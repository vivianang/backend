<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Berita;
use Illuminate\Http\Request;

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
        $admin = Admin::query()->get();
        echo $berita;
        $data = [
            'berita' => $berita,
            'admin' => $admin
        ];

        return $data;
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
            'id_admin' => 'required',
            "isi_berita" => "required"
        ]);
        $berita = Berita::create([
            'id_admin' => $request->id_admin,
            'isi_berita' => $request->isi_berita,
        ]);
        return "Data berhasil tersimpan";
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

        return response()->json(['data' => $berita]);
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

        $param = [
            'id_admin' => $request->id_admin,
            'isi_berita' => $request->isi_berita,
        ];
        $berita = Berita::query()->where('id_berita', '=', $id)->update($param);
        return 'Data Berita Berhasil Diubah';
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
        return 'Data Berita Berhasil Dihapus';
    }
}
