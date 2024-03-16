<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CauHinhController extends Controller
{
    //
    public function index() {
        $jsonString = file_get_contents('cauhinh/footer.json');
        $data = json_decode($jsonString, true);   
        return view('server.cauhinh.cauhinh', ['data' => $data]);
    }

    public function postData(Request $request) {
        $data["tenCongTy"] = $request->tenCongTy; 
        $data["diaChi"] = $request->diaChi; 
        $data["soDienThoai"] = $request->soDienThoai;  
        $data["email"] = $request->email; 
        $data["srcMap"] = $request->srcMap; 
        $data["title1"] = $request->title1; 
        $data["t1row1"] = $request->t1row1; 
        $data["t1linkrow1"] = $request->t1linkrow1; 
        $data["t1row2"] = $request->t1row2; 
        $data["t1linkrow2"] = $request->t1linkrow2; 
        $data["t1row3"] = $request->t1row3; 
        $data["t1linkrow3"] = $request->t1linkrow3; 
        $data["t1row4"] = $request->t1row4; 
        $data["t1linkrow4"] = $request->t1linkrow4; 
        $data["title2"] = $request->title2; 
        $data["t2row1"] = $request->t2row1; 
        $data["t2linkrow1"] = $request->t2linkrow1;
        $data["t2row2"] = $request->t2row2; 
        $data["t2linkrow2"] = $request->t2linkrow2; 
        $data["t2row3"] = $request->t2row3;
        $data["t2linkrow3"] = $request->t2linkrow3; 
        $data["facebook"] = $request->facebooklink; 
        $data["zalo"] = $request->zalolink;
        $data["youtube"] = $request->youtubelink;

        $newJsonString = json_encode($data, JSON_PRETTY_PRINT);
        file_put_contents('cauhinh/footer.json', $newJsonString);
        return response()->json([
            'type' => 'success',
            'message' => 'Đã lưu cấu hình',
            'code' => 200
        ]);
    }
}
