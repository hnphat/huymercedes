<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TinTuc;

class TinTucController extends Controller
{
    //
    public function index() {
        return view('server.tintuc.tintuc');
    }

    public function loadData() {
        $data = TinTuc::select("*")->orderBy('id', 'desc')->get();
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

    public function themMoi() {
        return view('server.tintuc.themmoi');
    }

    public function postData(Request $request) {
        $flag1 = false;
        $file1 = null;
        $nameFile1 = "";
        $etc1 = "";
        $data = new TinTuc();
        $data->name = $request->tieuDe;
        $data->loaiTin = $request->loaiTin;
        $data->slugName = \HelpFunction::changeTitle($request->tieuDe);
        $data->moTa = $request->moTa;
        $data->content = $request->noiDung;
        $data->thuThap = $request->thuThap ? true : false;
        $data->quangCaoRamdom = $request->isAds ? true : false;
        $data->show = $request->hienThi ? true : false;

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
                while(file_exists("upload/tintuc/" . $nameFile1  . "." . $etc1)) {
                    $nameFile1 = rand() . "-" . $nameFile1;
                }
                $flag1 = true;
                // $file->move('upload/tinxe/', $name . "." . $etc);
                // $data->hinhAnh = $name  . "." . $etc;
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
                $file1->move('upload/tintuc/', $nameFile1 . "." . $etc1);              
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

    public function delete(Request $request) {
        $data = TinTuc::find($request->id);
        if (file_exists('upload/tintuc/' . $data->hinhAnh) && !empty($data->hinhAnh))
            unlink('upload/tintuc/'.$data->hinhAnh);
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

    public function getTinTuc(Request $request) {
        $data = TinTuc::find($request->id);
        if ($data) {
            return response()->json([
                'code' => 200,
                'type' => "info",
                'message' => 'Load successfull!',
                'tieuDe' => $data->name,
                'moTa' => $data->moTa,
                'noiDung' => $data->content              
            ]); 
        } else {
            return response()->json([
                'code' => 500,
                'type' => "error",
                'message' => 'Load Fail!',
                'data' => null              
            ]); 
        }
    }

    public function getEdit($idtintuc) {
        $data = TinTuc::find($idtintuc);
        return view('server.tintuc.capnhat', ['data' => $data]);
    }

    public function postEdit(Request $request, $idtintuc) {
        $flag1 = false;
        $file1 = null;
        $nameFile1 = "";
        $etc1 = "";
        $data = TinTuc::find($idtintuc);
        $data->name = $request->etieuDe;
        $data->loaiTin = $request->eloaiTin;
        $data->slugName = \HelpFunction::changeTitle($request->etieuDe);
        $data->moTa = $request->emoTa;
        $data->content = $request->enoiDung;
        $data->thuThap = $request->ethuThap ? true : false;
        $data->quangCaoRamdom = $request->eisAds ? true : false;
        $data->show = $request->ehienThi ? true : false;

        if ($request->hasFile('ehinhAnh')){
            $file1 = $request->file('ehinhAnh');
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
                while(file_exists("upload/tintuc/" . $nameFile1  . "." . $etc1)) {
                    $nameFile1 = rand() . "-" . $nameFile1;
                }
                $flag1 = true;
            }
        } 

        if ($flag1) {      
            $data->hinhAnh = $nameFile1  . "." . $etc1;           
        } 

        $data->save();

        if ($data) {
            if ($flag1) {      
                // Xử lý upload hình ảnh  
                $file1->move('upload/tintuc/', $nameFile1 . "." . $etc1);              
            }
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
}
