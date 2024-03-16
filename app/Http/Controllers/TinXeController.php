<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TinXe;

class TinXeController extends Controller
{
    //
    public function index() {
        return view('server.tinxe.tinxe');
    }

    public function loadData() {
        $data = TinXe::select("*")->orderBy('id', 'desc')->get();
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
        return view('server.tinxe.themmoi');
    }

    public function postData(Request $request) {
        $flag1 = false;
        $flag2 = false;
        $file1 = null;
        $file2 = null;
        $nameFile1 = "";
        $nameFile2 = "";
        $etc1 = "";
        $etc2 = "";
        $data = new TinXe();
        $data->name = $request->tieuDe;

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
                while(file_exists("upload/tinxe/" . $nameFile1  . "." . $etc1)) {
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

        $data->slugName = \HelpFunction::changeTitle($request->tieuDe);
        $data->moTa = $request->moTa;
        $data->content = $request->noiDung;
        $data->thuThap = $request->thuThap ? true : false;
        $data->quangCaoRamdom = $request->isAds ? true : false;
        if ($request->hasFile('thongSoKyThuat')){
            $file2 = $request->file('thongSoKyThuat');
            $fileSize = $file2->getSize() / 1048576;   
            $etc2 = strtolower($file2->getClientOriginalExtension());
            $nameFile2 = \HelpFunction::changeTitle($file2->getClientOriginalName());
            if ($etc2 != 'pdf') {
                return response()->json([
                    'code' => 500,
                    'type' => "error",
                    'message' => 'Thông số kỹ thuật không đúng định dạng pdf'                
                ]);
            } else {
                if ($fileSize > 5) 
                    return response()->json([
                        'code' => 500,
                        'type' => "error",
                        'message' => 'File thông số kỹ thuật dung lượng vượt mức cho phép (5MB)'                
                    ]);
                while(file_exists("upload/tinxe/thongsokythuat/" . $nameFile2 . "." . $etc2)) {
                    $nameFile2 = rand() . "-" . $nameFile2;
                }
                $flag2 = true;
                // $file->move('upload/tinxe/thongsokythuat', $name . "." . $etc);
                // $data->thongSoKyThuat = $name . "." . $etc;
            }
        } else {
            return response()->json([
                'code' => 500,
                'type' => "error",
                'message' => 'Không tìm thấy file thông số kỹ thuật đính kèm!'                
            ]);
        }

        if ($flag1 && $flag2) {      
            $data->hinhAnh = $nameFile1  . "." . $etc1;
            $data->thongSoKyThuat = $nameFile2 . "." . $etc2;
        } else {
            return response()->json([
                'code' => 500,
                'type' => "error",
                'message' => 'Lỗi xảy ra trong quá trình xử lý file đính kèm!'                
            ]);
        }

        $data->save();

        if ($data) {
            if ($flag1 && $flag2) {      
                // Xử lý upload hình ảnh  
                $file1->move('upload/tinxe/', $nameFile1 . "." . $etc1);
                // Xử lý upload thông số kỹ thuật
                $file2->move('upload/tinxe/thongsokythuat', $nameFile2 . "." . $etc2);
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
        $data = TinXe::find($request->id);
        if (file_exists('upload/tinxe/' . $data->hinhAnh) && !empty($data->hinhAnh))
            unlink('upload/tinxe/'.$data->hinhAnh);
        if (file_exists('upload/tinxe/thongsokythuat/' . $data->thongSoKyThuat) && !empty($data->thongSoKyThuat))
            unlink('upload/tinxe/thongsokythuat/'.$data->thongSoKyThuat);
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

    public function getEdit($idtinxe) {
        $data = TinXe::find($idtinxe);
        return view('server.tinxe.capnhat', ['data' => $data]);
    }

    public function postEdit(Request $request, $idtinxe) {
        $flag1 = false;
        $flag2 = false;
        $file1 = null;
        $file2 = null;
        $nameFile1 = "";
        $nameFile2 = "";
        $etc1 = "";
        $etc2 = "";
        $data = TinXe::find($idtinxe);
        $data->name = $request->etieuDe;

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
                while(file_exists("upload/tinxe/" . $nameFile1  . "." . $etc1)) {
                    $nameFile1 = rand() . "-" . $nameFile1;
                }
                $flag1 = true;
            }
        }

        $data->slugName = \HelpFunction::changeTitle($request->etieuDe);
        $data->moTa = $request->emoTa;
        $data->content = $request->enoiDung;
        $data->thuThap = $request->ethuThap ? true : false;
        $data->quangCaoRamdom = $request->eisAds ? true : false;
        if ($request->hasFile('ethongSoKyThuat')){
            $file2 = $request->file('ethongSoKyThuat');
            $fileSize = $file2->getSize() / 1048576;   
            $etc2 = strtolower($file2->getClientOriginalExtension());
            $nameFile2 = \HelpFunction::changeTitle($file2->getClientOriginalName());
            if ($etc2 != 'pdf') {
                return response()->json([
                    'code' => 500,
                    'type' => "error",
                    'message' => 'Thông số kỹ thuật không đúng định dạng pdf'                
                ]);
            } else {
                if ($fileSize > 5) 
                    return response()->json([
                        'code' => 500,
                        'type' => "error",
                        'message' => 'File thông số kỹ thuật dung lượng vượt mức cho phép (5MB)'                
                    ]);
                while(file_exists("upload/tinxe/thongsokythuat/" . $nameFile2 . "." . $etc2)) {
                    $nameFile2 = rand() . "-" . $nameFile2;
                }
                $flag2 = true;
            }
        } 

        if ($flag1) {      
            // Xoá hình ảnh nếu có
            if (file_exists('upload/tinxe/' . $data->hinhAnh) && !empty($data->hinhAnh))
                unlink('upload/tinxe/'.$data->hinhAnh);        
            // Xử lý upload hình ảnh  
            $data->hinhAnh = $nameFile1  . "." . $etc1;           
        } 

        if ($flag2) {
            // Xoá thông số kỹ thuật cũ nếu có
            if (file_exists('upload/tinxe/thongsokythuat/' . $data->thongSoKyThuat) && !empty($data->thongSoKyThuat))
                unlink('upload/tinxe/thongsokythuat/'.$data->thongSoKyThuat);    
            // Xử lý upload thông số kỹ thuật
            $data->thongSoKyThuat = $nameFile2 . "." . $etc2;
        }

        $data->save();

        if ($data) {
            if ($flag1) {    
                // Xử lý upload hình ảnh  
                $file1->move('upload/tinxe/', $nameFile1 . "." . $etc1);    
            } 
    
            if ($flag2) {
                // Xử lý upload thông số kỹ thuật
                $file2->move('upload/tinxe/thongsokythuat', $nameFile2 . "." . $etc2);
            }

            return response()->json([
                'code' => 200,
                'type' => "info",
                'message' => 'Đã cập nhật',
                'data' => $data           
            ]); 
        } else {
            return response()->json([
                'code' => 500,
                'type' => "error",
                'message' => 'Không thể cập nhật'                
            ]); 
        }
    }

    public function getTinXe(Request $request) {
        $data = TinXe::find($request->id);
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
}
