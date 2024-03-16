@extends('layout.server.index')
@section('title')
    <title>Quản lý dòng xe</title>
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
            <h1 class="m-0">QUẢN LÝ DÒNG XE</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="./admin">Trang chủ</a></li>
              <li class="breadcrumb-item">Quản lý xe</li>
              <li class="breadcrumb-item active">Dòng xe</li>
            </ol>
          </div>
        </div>
      </div>
  </div>
@endsection
@section('content')
<div class="container_fluid">
<button id="addDongXe" class="btn btn-success" data-toggle="modal" data-target="#addDongXeModal" class="btn btn-primary center-block">Thêm mới</button><br/><br/>
<!-- Modal Add -->
<div class="modal fade" id="addDongXeModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4>THÊM DÒNG XE</h4>
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
      </div>
      <div class="modal-body">
        <div class="card bg-light">
          <article class="card-body" style="max-width: 1000px;">
            <form id="addDongXeForm" method="post" autocomplete="off">
              @csrf
              <i><strong class="text-danger" id="thongBaoDongXe"></strong></i>
              <div class="form-group input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa fa-caret-right"></i> </span>
                </div>
                <input name="tenDongXe" class="form-control" placeholder="Tên dòng xe" required="required" autofocus="autofocus">
              </div> <!-- form-group// -->  
              <div class="form-group input-group">
                <input name="isShow" id="isShow" type="checkbox" style="width: 25px;"> &nbsp;
                <label for="isShow">Hiển thị</label>
              </div> <!-- form-group// -->                  
              <div class="form-group">
                  <button type="submit" id="taoDongXe" class="btn btn-primary btn-block">Thêm</button>
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
<div class="modal fade" id="editDongXeModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4>CẬP NHẬT</h4>
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
      </div>
      <div class="modal-body">
        <div class="card bg-light">
          <article class="card-body" style="max-width: 1000px;">
            <form id="editDongXeForm" method="post" autocomplete="off">
              @csrf
            <i><strong class="text-danger" id="thongBaoEditDongXe"></strong></i>
              <input type="hidden" name="idEditDongXe">
              <div class="form-group input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa fa-caret-right"></i> </span>
                </div>
                <input name="etenDongXe" class="form-control" placeholder="Tên dòng xe" required="required" autofocus="autofocus">
              </div> <!-- form-group// -->         
              <div class="form-group input-group">
                <input name="eisShow" id="eisShow" type="checkbox" style="width: 25px;"> &nbsp;
                <label for="eisShow">Hiển thị</label>
              </div> <!-- form-group// -->                            
              <div class="form-group">
                  <button type="submit" id="editDongXe" class="btn btn-primary btn-block"> Cập nhật </button>
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
  <table id="dongXeTable" class="display" style="width:100%">
      <thead>
      <tr class="bg-gradient-lightblue">
          <th>TT</th>
          <th>Tên dòng xe</th>
          <th>Hiển thị</th>
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