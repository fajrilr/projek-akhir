<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Firebase\JWT\JWT;
use Illuminate\Support\Str;

class AuthController extends Controller {
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request) {
        $this->request = $request;
    }

    protected function jwt(Mahasiswa $mahasiswa) {
    $payload = [
      'iss' => 'projectAkhir', //issuer of the token
      'sub' => $mahasiswa->nim, //subject of the token
      'iat' => time(), //time when JWT was issued.
      'exp' => time() + 60 * 60 //time when JWT will expire
    ];

    return JWT::encode($payload, env('JWT_SECRET'), 'HS256');
  }

    public function register(Request $request) {
        $nim = $request->nim;
        $nama = $request->nama;
        $angkatan = $request->angkatan;
        $password = $request->password;

        $mahasiswa = Mahasiswa::create([
            'nim' => $nim,
            'nama' => $nama,
            'angkatan' => $angkatan,
            'password' => $password
        ]);

        return response()->json([
            'status' => 'Success',
            'message' => 'Data mahasiswa telah ditambah',
            'data' => [
                'mahasiswa' => $mahasiswa,
            ]
        ],200);
    }

    public function login(Request $request) {
    $nim = $request->nim;
    $password = $request->password;

    $mahasiswa = Mahasiswa::where('nim', $nim)->first();

    if (!$mahasiswa) {
      return response()->json([
        'status' => 'Error',
        'message' => 'user not exist',
      ], 404);
    }

    if ($password != $mahasiswa->password) {
      return response()->json([
        'status' => 'Error',
        'message' => 'wrong password',
      ], 400);
    }

    $mahasiswa->token = $this->jwt($mahasiswa); 
    $mahasiswa->save();

    return response()->json([
      'status' => 'Success',
      'message' => 'successfully login',
      'token'=>$mahasiswa->token,
      'data' => [
        'user' => $mahasiswa,
      ]
    ], 200);
  }
}