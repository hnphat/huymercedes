<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TuyenDung;

class TuyenDungController extends Controller
{
    //
    public function index() {
        return view('server.tuyendung.tuyendung');
    }

    public function loadData() {
        $data = TuyenDung::all();
        if ($data)
            return response()->json([
                'code' => 200,
                'message' => 'Load data success',
                'data' => $data,
            ]);
        else
            return response()->json([
                'code' => 500,
                'message' => 'Load data fail',
                'data' => null,
            ]); 
    }
}
