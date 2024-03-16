<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\TinXe;
use App\Models\TinTuc;

class SliderController extends Controller
{
    //
    public function index() {
        $tinXe = TinXe::select("*")->orderBy('id','desc')->get();
        $tinTuc = TinTuc::select("*")->orderBy('id','desc')->get();
        return view('server.slider.slider', ['tinXe' => $tinXe, 'tinTuc' => $tinTuc]);
    }

    public function loadData() {
        $data = Slider::select("*")->orderBy('id', 'desc')->get();
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

    public function postData(Request $request) {
        $flag1 = false;
        $file1 = null;
        $nameFile1 = "";
        $etc1 = "";
        $data = new Slider();
        $data->name = $request->tenSlide;
        $data->slugName = \HelpFunction::changeTitle($request->tenSlide);
        $data->isCar = $request->lienQuan;
        if ($request->lienQuan) {
            $data->baiViet = $request->tinXe;
        } else {
            $data->baiViet = $request->tinTuc;
        }
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
                while(file_exists("upload/slider/" . $nameFile1  . "." . $etc1)) {
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
            $data->image = $nameFile1  . "." . $etc1;
        } else {
            return response()->json([
                'code' => 500,
                'type' => "error",
                'message' => 'Lỗi xảy ra trong quá trình xử lý file đính kèm!'                
            ]);
        }

        $data->save();

        if ($data) {
            if ($flag1 ) {      
                // Xử lý upload hình ảnh  
                $file1->move('upload/slider/', $nameFile1 . "." . $etc1);
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

    public function getTin(Request $request) {
        $chosen = $request->isCar;
        if ($chosen)  
            $data = TinXe::find($request->id);
        else 
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

    public function delete(Request $request) {
        $data = Slider::find($request->id);
        if (file_exists('upload/slider/' . $data->image) && !empty($data->image))
            unlink('upload/slider/'.$data->image);
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

    public function getEdit(Request $request) {
        $data = Slider::find($request->id);
        if ($data) {
            return response()->json([
                'code' => 200,
                'type' => "info",
                'message' => 'Load successfull!',
                'data' => $data            
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

    public function postEdit(Request $request) {
        $flag1 = false;
        $file1 = null;
        $nameFile1 = "";
        $etc1 = "";
        $data = Slider::find($request->idSlide);
        $data->name = $request->etenSlide;
        $data->slugName = \HelpFunction::changeTitle($request->etenSlide);
        $data->isCar = $request->elienQuan;

        if ($request->elienQuan) {
            $data->baiViet = $request->etinXe;
        } else {
            $data->baiViet = $request->etinTuc;
        }

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
                while(file_exists("upload/slider/" . $nameFile1  . "." . $etc1)) {
                    $nameFile1 = rand() . "-" . $nameFile1;
                }
                $flag1 = true;
            }
        } 

        if ($flag1) {      
            // Xoá hình ảnh nếu có
            if (file_exists('upload/slider/' . $data->image) && !empty($data->image))
            unlink('upload/slider/'.$data->image);       
            $data->image = $nameFile1  . "." . $etc1;
        }

        $data->save();

        if ($data) {
            if ($flag1 ) {   
                // Xử lý upload hình ảnh  
                $file1->move('upload/slider/', $nameFile1 . "." . $etc1);
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
