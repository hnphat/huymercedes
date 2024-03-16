<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Xe;
use App\Models\DongXe;
use App\Models\TinXe;
use App\Models\MauXe;

class XeController extends Controller
{
    //
    public function index() {
        return view('server.xe.xe');
    }

    public function loadData() {
        $arr = [];
        $data = Xe::select("*")->orderBy('id', 'desc')->get();
        foreach($data as $row) {
            $arrMauXe = [];
            $temp = $row;
            $dongXe = DongXe::find($row->idDongXe);
            $mauXe = MauXe::where('idXe',$row->id)->get();
            if ($mauXe) {
                foreach($mauXe as $rowMauXe) {
                    $obj = [];
                    $obj = (object) $obj;
                    $obj->tenMau = $rowMauXe->tenMau;
                    $obj->hinhAnh = $rowMauXe->hinhAnh;
                    $obj->maMau = $rowMauXe->maMau;
                    $obj->idXe = $row->id;
                    $obj->id = $rowMauXe->id;
                    array_push($arrMauXe, $obj);
                }
            }
            $temp->dongXe = $dongXe->name;
            $temp->mauXe = $arrMauXe;
            array_push($arr, $temp);
        }

        if ($data)
            return response()->json([
                'status_code' => 200,
                'message' => 'Load data success',
                'data' => $arr,
            ]);
        else
            return response()->json([
                'status_code' => 500,
                'message' => 'Load data fail',
                'data' => null,
            ]); 
    }

    public function themMoi() {
        $dongXe = DongXe::select("*")->where('isShow', true)->orderBy('id','desc')->get();
        $tinXe = TinXe::all();
        return view('server.xe.themmoi', ['dongXe' => $dongXe, 'tinXe' => $tinXe]);
    }

    public function postData(Request $request) {
        $flag1 = false;
        $file1 = null;
        $nameFile1 = "";
        $etc1 = "";
        $data = new Xe();
        $data->name = $request->tenXe;
        $data->idDongXe = $request->dongXe;
        $data->slugName = \HelpFunction::changeTitle($request->tenXe);
        $data->loaiXe = $request->loaiXe;
        $data->hopSo = $request->hopSo;
        $data->nhienLieu = $request->nhienLieu;
        $data->choNgoi = $request->choNgoi;
        $data->giaBan = $request->giaBan;
        $data->isNew = $request->isNew ? true : false;
        $data->isKhuyenMai = $request->isKhuyenMai ? true : false;
        $data->isShow = $request->isShow ? true : false;
        $data->tinXe = $request->tinXe;

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
                while(file_exists("upload/xe/" . $nameFile1  . "." . $etc1)) {
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
                $file1->move('upload/xe/', $nameFile1 . "." . $etc1);
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

    public function delete(Request $request) {
        $data = Xe::find($request->id);
        if (file_exists('upload/xe/' . $data->hinhAnh) && !empty($data->hinhAnh))
            unlink('upload/xe/'.$data->hinhAnh);
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

    public function getEdit($idxe) {
        $data = Xe::find($idxe);
        $dongXe = DongXe::all();
        $tinXe = TinXe::all();
        return view('server.xe.capnhat', ['data' => $data, 'dongXe' => $dongXe, 'tinXe' => $tinXe]);
    }

    public function postEdit(Request $request, $idxe) {
        $flag1 = false;
        $file1 = null;
        $nameFile1 = "";
        $etc1 = "";
        $data = Xe::find($idxe);
        $data->name = $request->etenXe;
        $data->idDongXe = $request->edongXe;
        $data->slugName = \HelpFunction::changeTitle($request->etenXe);
        $data->loaiXe = $request->eloaiXe;
        $data->hopSo = $request->ehopSo;
        $data->nhienLieu = $request->enhienLieu;
        $data->choNgoi = $request->echoNgoi;
        $data->giaBan = $request->egiaBan;
        $data->isNew = $request->eisNew ? true : false;
        $data->isKhuyenMai = $request->eisKhuyenMai ? true : false;
        $data->isShow = $request->eisShow ? true : false;
        $data->tinXe = $request->etinXe;

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
                while(file_exists("upload/xe/" . $nameFile1  . "." . $etc1)) {
                    $nameFile1 = rand() . "-" . $nameFile1;
                }
                $flag1 = true;
            }
        } 

        if ($flag1) {          
             // Xoá hình ảnh nếu có
            if (file_exists('upload/xe/' . $data->hinhAnh) && !empty($data->hinhAnh))
                unlink('upload/xe/'.$data->hinhAnh);        
            $data->hinhAnh = $nameFile1  . "." . $etc1;
        } 

        $data->save();

        if ($data) {
            if ($flag1) {   
                // Xử lý upload hình ảnh  
                $file1->move('upload/xe/', $nameFile1 . "." . $etc1);
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
