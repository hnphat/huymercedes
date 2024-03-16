<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\TinTuc;
use App\Models\SubMenu;

class MenuController extends Controller
{
    //
    public function index() {
        $tinTuc = TinTuc::select("*")->orderBy('id','desc')->get();
        return view('server.menu.menu', ['tinTuc' => $tinTuc]);
    }

    public function loadData() {
        $arr = [];
        $data = Menu::all();
        foreach($data as $row) {
            $temp = $row;
            $subMenu = [];
            $sub = SubMenu::where("idMenu",$row->id)->get();
            foreach($sub as $rowSub) {
                $obj = [];               
                $obj = (object) $obj;
                $obj->name = $rowSub->name;
                $obj->id = $rowSub->id;
                $obj->isBaiViet = $rowSub->isBaiViet;
                $obj->link = $rowSub->link;
                $obj->baiViet = $rowSub->baiViet;
                $obj->isShow = $rowSub->isShow;
                $obj->slugBaiViet = $rowSub->isBaiViet ? TinTuc::find($rowSub->baiViet)->slugName : "";
                array_push($subMenu,$obj);
            }
            $temp->subMenu = $subMenu;
            array_push($arr, $temp);
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
        $data = new Menu();
        $data->name = $request->tenMenu;
        $data->hasSubMenu = $request->hasSubMenu;
        $data->isBaiViet = $request->isBaiViet;
        if (!$request->hasSubMenu) {
            if ($request->isBaiViet) {
                $data->baiViet = $request->baiViet ? $request->baiViet : null;
                $data->link = null;
            }
            else {
                $data->link = $request->link ? $request->link : "#";
                $data->baiViet = null;
            }
        }
        $data->isShow = $request->isShow ? true : false;
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
        $data = Menu::find($request->id);
        if ($data)
            return response()->json([
                'code' => 200,
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

    public function delete(Request $request) {
        $data = Menu::find($request->id);
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

    public function postEdit(Request $request) {
        $data = Menu::find($request->idMenu);
        $data->name = $request->etenMenu;
        $data->hasSubMenu = $request->ehasSubMenu;
        $data->isBaiViet = $request->eisBaiViet;
        if (!$request->ehasSubMenu) {
            if ($request->eisBaiViet) {
                $data->baiViet = $request->ebaiViet ? $request->ebaiViet : null;
                $data->link = null;
            }
            else {
                $data->link = $request->elink ? $request->elink : "#";
                $data->baiViet = null;
            }
        } else {
            $data->baiViet = null;
            $data->link = null;
        }
        $data->isShow = $request->eisShow ? true : false;
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

    public function postDataSubMenu(Request $request) {
        $data = new SubMenu();
        $data->idMenu = $request->idParentMenu;
        $data->name = $request->tenSubMenu;
        $data->isBaiViet = $request->isBaiVietSub;
        if ($request->isBaiVietSub) {
            $data->baiViet = $request->baiVietSub ? $request->baiVietSub : null;
            $data->link = null;
        }
        else {
            $data->link = $request->linkSub ? $request->linkSub : "#";
            $data->baiViet = null;
        }
        $data->isShow = $request->isShowSub ? true : false;
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

    public function deleteSubMenu(Request $request) {
        $data = SubMenu::find($request->id);
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

    public function setOff(Request $request) {
        $data = SubMenu::find($request->id);
        $data->isShow = false;
        $data->save();
        if ($data)
            return response()->json([
                'code' => 200,
                'message' => 'Đã tắt hiển thị',
                'type' => 'success'
            ]);
        else
            return response()->json([
                'code' => 500,
                'message' => 'Không thể tắt hiển thị',
                'type' => 'error'
            ]); 
    }

    public function setOn(Request $request) {
        $data = SubMenu::find($request->id);
        $data->isShow = true;
        $data->save();
        if ($data)
            return response()->json([
                'code' => 200,
                'message' => 'Đã mở hiển thị',
                'type' => 'success'
            ]);
        else
            return response()->json([
                'code' => 500,
                'message' => 'Không thể mở hiển thị',
                'type' => 'error'
            ]); 
    }

    public function getEditSubMenu(Request $request) {
        $data = SubMenu::find($request->id);
        if ($data)
            return response()->json([
                'code' => 200,
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

    public function postEditSubMenu(Request $request) {
        $data = SubMenu::find($request->idSubMenu);
        $data->name = $request->etenSubMenu;
        $data->isBaiViet = $request->eisBaiVietSub;
        if ($request->eisBaiVietSub) {
            $data->baiViet = $request->ebaiVietSub ? $request->ebaiVietSub : null;
            $data->link = null;
        }
        else {
            $data->link = $request->elinkSub ? $request->elinkSub : "#";
            $data->baiViet = null;
        }
        $data->isShow = $request->eisShowSub ? true : false;
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
}
