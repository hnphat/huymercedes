<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DongXe;

class DongXeController extends Controller
{
    //
    public function index() {
        return view('server.danhmucxe.danhmucxe');
    }

    public function loadData() {
        $data = DongXe::all();
        if ($data)
            return response()->json([
                'status_code' => 200,
                'message' => 'Load data success',
                'data' => $data,
            ]);
        else
            return response()->json([
                'status_code' => 500,
                'message' => 'Load data fail',
                'data' => null,
            ]); 
    }

    public function postData(Request $request) {
        $data = new DongXe();
        $data->name = $request->tenDongXe;
        $data->isShow = $request->isShow ? true : false;
        $data->save();
        if ($data) {
            return response()->json([
                'status_code' => 200,
                'type' => "info",
                'message' => 'Đã thêm mới'                
            ]); 
        } else {
            return response()->json([
                'status_code' => 500,
                'type' => "error",
                'message' => 'Không thể thêm'                
            ]); 
        }
    }

    public function delete(Request $request) {
        $data = DongXe::find($request->id);
        $data->delete();
        if ($data)
            return response()->json([
                'status_code' => 200,
                'message' => 'Đã xoá',
                'type' => 'success'
            ]);
        else
            return response()->json([
                'status_code' => 500,
                'message' => 'Không thể xoá',
                'type' => 'error'
            ]); 
    }

    public function getEdit(Request $request) {
        $data = DongXe::find($request->id);
        if ($data)
            return response()->json([
                'status_code' => 200,
                'message' => 'Đã tìm thấy dữ liệu',
                'type' => 'success',
                'data' => $data
            ]);
        else
            return response()->json([
                'status_code' => 500,
                'message' => 'Lỗi load dữ liệu',
                'type' => 'error'
            ]); 
    }

    public function postEdit(Request $request) {
        $data = DongXe::find($request->idEditDongXe);
        $data->name = $request->etenDongXe;
        $data->isShow = $request->eisShow ? true : false;
        $data->save();
        if ($data) {
            return response()->json([
                'status_code' => 200,
                'type' => "info",
                'message' => 'Đã cập nhật'                
            ]); 
        } else {
            return response()->json([
                'status_code' => 500,
                'type' => "error",
                'message' => 'Không thể cập nhật'                
            ]); 
        }
    }
}
