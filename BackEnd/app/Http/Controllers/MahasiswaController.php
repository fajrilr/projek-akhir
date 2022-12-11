<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller {
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function getMahasiswaById(Request $request) {
        $mahasiswa = Mahasiswa::find($request->nim);

        // if(){

        // };

        return response()->json([
            'success' => true, 
            'message' => 'Berikut adalah detailnya',
            'data' => $mahasiswa
        ]);
    }

    public function getAllMhs(Request $request) {
        $mahasiswas = Mahasiswa::all();

        return response()->json([
            'success' => true, 
            'message' => 'Berikut adalah semua daftar mahasiswa',
            'mahasiswas' => $mahasiswas
            
        ], 200);
    }

    public function getMhsToken(Request $request) {
        
        return response()->json([
            'success' => true,
            'message' => 'grabbed user by token',
            'data' => $request->user,
          ], 200);
    }

    public function addMk(Request $request) {
        $mahasiswa = Mahasiswa::find($request->nim);

        $mahasiswa->matakuliah()->attach($request->mkId);

        return response()->json([
            'success' => true,
            'message' => 'Matakuliah berhasil ditambahkan'
        ]);
    }

}
