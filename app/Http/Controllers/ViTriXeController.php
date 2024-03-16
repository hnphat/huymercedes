<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ViTriXe;
use App\Models\Xe;

class ViTriXeController extends Controller
{
    //
    public function index() {
        $data = Xe::select("*")->where('isShow', true)->orderBy('id','desc')->get();
        return view('server.vitrixe.vitrixe', ['xe' => $data]);
    }

    public function loadData() {
        $data = ViTriXe::select("*")->orderBy('id','desc')->get();
        $arr = [];
        foreach($data as $row) {
            $xe = Xe::find($row->idXe);
            $obj = [];
            $obj = (object) $obj;
            $obj->tenXe = $xe->name;
            $obj->id = $row->id;
            $obj->giaBan = $xe->giaBan;
            $obj->hinhAnh = $xe->hinhAnh;
            array_push($arr, $obj);
        }
        if ($data)
            return response()->json([
                'code' => 200,
                'message' => 'Load data success',
                'data' => $arr,
            ]);
        else
            return response()->json([
                'code' => 500,
                'message' => 'Load data fail',
                'data' => null,
            ]); 
    }

    public function postData(Request $request) {
        $data = new ViTriXe();
        $data->idXe = $request->chonXe;
        $data->save();
        if ($data) {
            return response()->json([
                'code' => 200,
                'type' => "info",
                'message' => 'Đã thêm mới'                
            ]); 
        } else {
            return response()->json([
                'code' => 500,
                'type' => "error",
                'message' => 'Không thể thêm'                
            ]); 
        }
    }

    public function getEdit(Request $request) {
        $data = ViTriXe::find($request->id);
        if ($data)
            return response()->json([
                'code' => 200,
                'message' => 'Đã tìm thấy dữ liệu',
                'type' => 'success',
                'data' => $data
            ]);
        else
            return response()->json([
                'code' => 500,
                'message' => 'Lỗi load dữ liệu',
                'type' => 'error'
            ]); 
    }

    public function postEdit(Request $request) {
        $data = ViTriXe::find($request->viTriXeId);
        $data->idXe = $request->echonXe;
        $data->save();
        if ($data) {
            return response()->json([
                'code' => 200,
                'type' => "info",
                'message' => 'Đã cập nhật'                
            ]); 
        } else {
            return response()->json([
                'code' => 500,
                'type' => "error",
                'message' => 'Không thể cập nhật'                
            ]); 
        }
    }

    public function delete(Request $request) {
        $data = ViTriXe::find($request->id);
        $data->delete();
        if ($data)
            return response()->json([
                'code' => 200,
                'message' => 'Đã xoá',
                'type' => 'success'
            ]);
        else
            return response()->json([
                'code' => 500,
                'message' => 'Không thể xoá',
                'type' => 'error'
            ]); 
    }
}
