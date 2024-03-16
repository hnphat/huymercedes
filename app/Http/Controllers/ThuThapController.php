<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ThuThap;

class ThuThapController extends Controller
{
    //
    public function index() {
        return view('server.thuthapdulieu.thuthap');
    }

    public function loadData() {
        $arr = [];
        $data = ThuThap::select("*")->orderBy('id','desc')->get();
        foreach($data as $row) {
            $temp = $row;
            $temp->ngayTao = \HelpFunction::revertCreatedAt($row->created_at);
            array_push($arr, $temp);
        }
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
