@extends('layout.server.index')
@section('title')
    <title>Quản lý tài khoản</title>
@endsection
@section('local_css')
<style>
  .divider-text {
    position: relative;
    text-align: center;
    margin-top: 15px;
    margin-bottom: 15px;
}
.divider-text span {
    padding: 7px;
    font-size: 12px;
    position: relative;   
    z-index: 2;
}
.divider-text:after {
    content: "";
    position: absolute;
    width: 100%;
    border-bottom: 1px solid #ddd;
    top: 55%;
    left: 0;
    z-index: 1;
}

.btn-facebook {
    background-color: #405D9D;
    color: #fff;
}
.btn-twitter {
    background-color: #42AEEC;
    color: #fff;
}
.center {
    margin-top:50px;   
}

.modal-header {
	padding-bottom: 5px;
}

.modal-footer {
    	padding: 0;
	}
    
.modal-footer .btn-group button {
	height:40px;
	border-top-left-radius : 0;
	border-top-right-radius : 0;
	border: none;
	border-right: 1px solid #ddd;
}
	
.modal-footer .btn-group:last-child > button {
	border-right: 0;
}
</style>
@endsection
@section('content_header')
 <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">QUẢN LÝ TÀI KHOẢN</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="./admin">Trang chủ</a></li>
              <li class="breadcrumb-item active">Quản lý tài khoản</li>
            </ol>
          </div>
        </div>
      </div>
  </div>
@endsection
@section('content')
<div class="container_fluid">
<button id="addTaiKhoan" class="btn btn-success" data-toggle="modal" data-target="#addTaiKhoanModal" class="btn btn-primary center-block">Thêm mới</button><br/><br/>
<!-- Modal Add -->
<div class="modal fade" id="addTaiKhoanModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4>THÊM MỚI TÀI KHOẢN</h4>
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
      </div>
      <div class="modal-body">
        <div class="card bg-light">
          <article class="card-body" style="max-width: 1000px;">
            <form id="addTaiKhoanForm" method="post" autocomplete="off">
              @csrf
            <i><strong class="text-danger" id="thongBaoTaiKhoan"></strong></i>
              <div class="form-group input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa fa-caret-right"></i> </span>
                </div>
                <input name="tenDangNhap" class="form-control" placeholder="Tên đăng nhập" required="required" autofocus="autofocus">
              </div> <!-- form-group// -->   
              <div class="form-group input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa fa-caret-right"></i> </span>
                </div>
                <input name="email" type="email" class="form-control" placeholder="Email" required="required">
              </div> <!-- form-group// --> 
              <div class="form-group input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa fa-caret-right"></i> </span>
                </div>
                <input name="matKhau" type="password" class="form-control" placeholder="Mật khẩu" required="required">
              </div> <!-- form-group// --> 
              <div class="form-group input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa fa-caret-right"></i> </span>
                </div>
                <input name="nhapLaiMatKhau" type="password" class="form-control" placeholder="Nhập lại mật khẩu" required="required">
              </div> <!-- form-group// -->                                  
              <div class="form-group">
                  <button type="submit" id="taoTaiKhoan" class="btn btn-primary btn-block"> Tạo tài khoản </button>
              </div> <!-- form-group// -->                                                            
            </form>
          </article>
        </div>  
      </div>
    </div>
  </div>
</div>
<!-- Modal Add End-->
<!-- Modal Edit -->
<div class="modal fade" id="editTaiKhoanModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4>CẬP NHẬT TÀI KHOẢN</h4>
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
      </div>
      <div class="modal-body">
        <div class="card bg-light">
          <article class="card-body" style="max-width: 1000px;">
            <form id="editTaiKhoanForm" method="post" autocomplete="off">
              @csrf
            <i><strong class="text-danger" id="thongBaoEditTaiKhoan"></strong></i>
              <input type="hidden" name="idEditTaiKhoan">
              <div class="form-group input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa fa-caret-right"></i> </span>
                </div>
                <input name="etenDangNhap" class="form-control" placeholder="Tên đăng nhập" required="required" autofocus="autofocus">
              </div> <!-- form-group// -->   
              <div class="form-group input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa fa-caret-right"></i> </span>
                </div>
                <input name="eemail" type="email" class="form-control" placeholder="Email" required="required">
              </div> <!-- form-group// --> 
              <div class="form-group input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa fa-caret-right"></i> </span>
                </div>
                <input name="ematKhau" type="password" class="form-control" placeholder="Để trống nếu không thay đổi">
              </div> <!-- form-group// --> 
              <div class="form-group input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa fa-caret-right"></i> </span>
                </div>
                <input name="enhapLaiMatKhau" type="password" class="form-control" placeholder="Để trống nếu không thay đổi">
              </div> <!-- form-group// -->                                  
              <div class="form-group">
                  <button type="submit" id="editTaiKhoan" class="btn btn-primary btn-block"> Cập nhật </button>
              </div> <!-- form-group// -->                                                            
            </form>
          </article>
        </div>  
      </div>
    </div>
  </div>
</div>
<!-- Modal Edit End -->
<div class="container_fluid">
  <table id="taiKhoanTable" class="display" style="width:100%">
      <thead>
      <tr class="bg-gradient-lightblue">
          <th>TT</th>
          <th>Tên tài khoản</th>
          <th>Email</th>
          <th>Ngày tạo</th>
          <th>Ngày cập nhật</th>
          <th>Tác vụ</th>                                        
      </tr>
      </thead>
  </table>
</div>
</div>
@endsection
@section('local_script')
@endsection