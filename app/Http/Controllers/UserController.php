<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    //
    public function index() {
        return view('server.taikhoan.quanlytaikhoan');
    }

    public function loadData() {
        $user = User::all();
        if ($user)
            return response()->json([
                'status_code' => 200,
                'message' => 'Load data success',
                'data' => $user,
            ]);
        else
            return response()->json([
                'status_code' => 500,
                'message' => 'Load data fail',
                'data' => null,
            ]); 
    }

    public function postData(Request $request) {
        $u = new User();
        $u->name = $request->tenDangNhap;
        $u->email = $request->email;
        $u->password = bcrypt($request->matKhau);
        $u->save();
        if ($u) {
            return response()->json([
                'status_code' => 200,
                'type' => "info",
                'message' => 'Đã thêm mới tài khoản'                
            ]); 
        } else {
            return response()->json([
                'status_code' => 500,
                'type' => "error",
                'message' => 'Không thể thêm tài khoản'                
            ]); 
        }
    }

    public function delete(Request $request) {
        $u = User::find($request->id);
        $u->delete();
        if ($u)
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
        $u = User::find($request->id);
        if ($u)
            return response()->json([
                'status_code' => 200,
                'message' => 'Đã tìm thấy dữ liệu',
                'type' => 'success',
                'data' => $u
            ]);
        else
            return response()->json([
                'status_code' => 500,
                'message' => 'Lỗi load dữ liệu',
                'type' => 'error'
            ]); 
    }

    public function postEdit(Request $request) {
        $oldpass = User::find($request->idEditTaiKhoan)->password;        
        $u = User::find($request->idEditTaiKhoan);
        $u->name = $request->etenDangNhap;
        $u->email = $request->eemail;
        $u->password = ($request->ematKhau) ? bcrypt($request->ematKhau): $oldpass;
        $u->save();
        if ($u) {
            return response()->json([
                'status_code' => 200,
                'type' => "info",
                'message' => 'Đã cập nhật tài khoản'                
            ]); 
        } else {
            return response()->json([
                'status_code' => 500,
                'type' => "error",
                'message' => 'Không thể cập nhật tài khoản'                
            ]); 
        }
    }

}
