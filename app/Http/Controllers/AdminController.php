<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index() {
        $datas = DB::select('select * from mobil');

        return view('admin.index')->with('datas', $datas);
    }

    public function create() {
        return view('admin.add');
    }

    public function store(Request $request) {
        $request->validate([
            'Id_mobil' => 'required',
            'kapasitas_penumpang' => 'required',
            'id_pembeli' => 'required',
        ]);

        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::insert('INSERT INTO mobil(Id_mobil, kapasitas_penumpang, id_pembeli) VALUES (:Id_mobil, :kapasitas_penumpang, :id_pembeli)',
        [
            'Id_mobil' => $request->Id_mobil,
            'kapasitas_penumpang' => $request->kapasitas_penumpang,
            'id_pembeli' => $request->id_pembeli,
        ]
        );

        // Menggunakan laravel eloquent
        // Admin::create([
        //     'id_admin' => $request->id_admin,
        //     'nama_admin' => $request->nama_admin,
        //     'alamat' => $request->alamat,
        //     'username' => $request->username,
        //     'password' => Hash::make($request->password),
        // ]);

        return redirect()->route('admin.index')->with('success', 'Data Mobil berhasil disimpan');
    }

    public function edit($id) {
        $data = DB::table('mobil')->where('Id_mobil', $id)->first();

        return view('admin.edit')->with('data', $data);
    }

    public function update($id, Request $request) {
        $request->validate([
            'Id_mobil' => 'required',
            'kapasitas_penumpang' => 'required',
            'id_pembeli' => 'required',
        ]);

        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::update('UPDATE mobil SET Id_mobil = :Id_mobil, kapasitas_penumpang = :kapasitas_penumpang, id_pembeli = :id_pembeli WHERE Id_mobil = :id',
        [
            'id' => $id,
            'Id_mobil' => $request->Id_mobil,
            'kapasitas_penumpang' => $request->kapasitas_penumpang,
            'id_pembeli' => $request->id_pembeli,
        ]
        );

        // Menggunakan laravel eloquent
        // Admin::where('id_admin', $id)->update([
        //     'id_admin' => $request->id_admin,
        //     'nama_admin' => $request->nama_admin,
        //     'alamat' => $request->alamat,
        //     'username' => $request->username,
        //     'password' => Hash::make($request->password),
        // ]);

        return redirect()->route('admin.index')->with('success', 'Data Mobil berhasil diubah');
    }

    public function delete($id) {
        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::delete('DELETE FROM mobil WHERE Id_mobil = :Id_mobil', ['Id_mobil' => $id]);

        // Menggunakan laravel eloquent
        // Admin::where('id_admin', $id)->delete();

        return redirect()->route('admin.index')->with('success', 'Data Mobil berhasil dihapus');
    }

}