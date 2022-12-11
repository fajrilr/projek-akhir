<?php

namespace App\Http\Controllers;

use App\Models\Matakuliah;
use Illuminate\Http\Request;

class MatakuliahController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function createMk(Request $request) {
        $mk = Matakuliah::create([
            'nama' => $request->nama
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Matakuliah berhasil dibuat',
            'matakuliah' => $mk
        ]);

    }
    public function getAllMk(Request $request) {
        $mk = Matakuliah::all();

        return response()->json([
            'success' => true, 
            'message' => 'Berikut adalah pilihan matakuliah yang tersedia',
            'matakuliah' => $mk

        ], 200);
    }

    public function addMK(Request $requset){
        
    }

}
