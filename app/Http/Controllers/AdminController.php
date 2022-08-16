<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admin=Admin::query()->get();

        $data=['$admin'=>$admin];

        return $data;
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
            'nama' => 'required',
            "email" => "required",
            "password" => "required"
        ]);
        $admin = Admin::create([
            'nama' => $request->nama,
            'email' => $request->email,
            "password" => Hash::make($request->password),
        ]);

        return 'Data Admin Berhasil Ditambah';
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $admin = Admin::find($id);

        return response()->json(['data' => $admin]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'email' => 'required',
        ]);

        $param = [
            'nama' => $request->nama,
            'email' => $request->email
        ];

        $admin = Admin::query()->where('id_admin', '=', $id)->update($param);
        return 'Data Admin Berhasil Diubah';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $admin = Admin::query()->where('id_admin', '=', $id)->delete();
        return 'Data Admin Berhasil Dihapus';
    }
}
