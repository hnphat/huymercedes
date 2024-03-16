<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MauXe;

class MauXeController extends Controller
{
    //
    public function postMauXe(Request $request) {
        $flag1 = false;
        $file1 = null;
        $nameFile1 = "";
        $etc1 = "";
        $data = new MauXe();
        $data->idXe = $request->idXe;
        $data->tenMau = $request->tenMau;
        $data->maMau = ltrim(rtrim(strtolower($request->chonseColor)));

        if ($request->hasFile('hinhAnh')){
            $file1 = $request->file('hinhAnh');
            $fileSize = $file1->getSize() / 1048576;            
            $etc1 = strtolower($file1->getClientOriginalExtension());
            $nameFile1 = \HelpFunction::changeTitle($file1->getClientOriginalName());
            if ($etc1 != 'jpg' && $etc1 != 'png' && $etc1 != 'jpeg') {               
                return response()->json([
                    'code' => 500,
                    'type' => "error",
                    'message' => 'Hình ảnh không đúng định dạng png, jpg, jpeg'                
                ]);
            } else {
                if ($fileSize > 2)
                    return response()->json([
                        'code' => 500,
                        'type' => "error",
                        'message' => 'File hình ảnh dung lượng vượt hơn cho phép (2MB)'                
                    ]);
                while(file_exists("upload/mauxe/" . $nameFile1  . "." . $etc1)) {
                    $nameFile1 = rand() . "-" . $nameFile1;
                }
                $flag1 = true;
            }
        } else {
            return response()->json([
                'code' => 500,
                'type' => "error",
                'message' => 'Không tìm thấy file hình ảnh đính kèm!'                
            ]);
        }

        if ($flag1) {          
            $data->hinhAnh = $nameFile1  . "." . $etc1;
        } else {
            return response()->json([
                'code' => 500,
                'type' => "error",
                'message' => 'Lỗi xảy ra trong quá trình xử lý file đính kèm!'                
            ]);
        }

        $data->save();

        if ($data) {
            if ($flag1) {      
                // Xử lý upload hình ảnh  
                $file1->move('upload/mauxe/', $nameFile1 . "." . $etc1);
            }
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

    public function getMauXe(Request $request) {
        $data = MauXe::find($request->id);
        if ($data) 
            return response()->json([
                'code' => 200,
                'type' => "info",
                'message' => 'Load màu xe thành công',
                'data' => $data                
            ]);
        else 
            return response()->json([
                'code' => 500,
                'type' => "error",
                'message' => 'Không thể load màu xe'                
            ]);
    }

    public function deleteMauXe(Request $request) {
        $data = MauXe::find($request->id);
        if (file_exists('upload/mauxe/' . $data->hinhAnh) && !empty($data->hinhAnh))
            unlink('upload/mauxe/'.$data->hinhAnh);
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
