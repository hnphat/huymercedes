@extends('layout.server.index')
@section('title')
    <title>Thêm mới xe</title>
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
            <h1 class="m-0">THÊM MỚI XE</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="./admin">Trang chủ</a></li>
              <li class="breadcrumb-item">Quản lý xe</li>
              <li class="breadcrumb-item active">Xe -> Thêm mới</li>
            </ol>
          </div>
        </div>
      </div>
  </div>
@endsection
@section('content')
<div class="container_fluid">
<form id="addXeForm" method="post" autocomplete="off" enctype="multipart/form-data">
  @csrf
  <label for="">Tên xe</label><br/>  
  <div class="form-group input-group">
    <div class="input-group-prepend">
        <span class="input-group-text"> <i class="fa fa-caret-right"></i> </span>
    </div>
    <input name="tenXe" type="text" class="form-control" placeholder="Tên xe" required="required" autofocus="autofocus">
  </div> <!-- form-group// --> 
  <label for="">Dòng xe</label><br/>   
  <div class="form-group input-group">
    <div class="input-group-prepend">
        <span class="input-group-text"> <i class="fa fa-caret-right"></i> </span>
    </div>
    <select name="dongXe" id="dongXe" class="form-control">
        @foreach($dongXe as $row)
          <option value="{{$row->id}}">{{$row->name}}</option>
        @endforeach
    </select>
  </div> <!-- form-group// -->    
  <label for="">Hình Ảnh</label><br/>
  <div class="form-group input-group">    
    <div class="input-group-prepend">
        <span class="input-group-text"> <i class="fa fa-caret-right"></i> </span>
    </div>
    <input name="hinhAnh" type="file" class="form-control" required="required">
  </div> <!-- form-group// -->     
  <label for="">Kiểu dáng</label><br/>   
  <div class="form-group input-group">
    <div class="input-group-prepend">
        <span class="input-group-text"> <i class="fa fa-caret-right"></i> </span>
    </div>
    <select name="loaiXe" id="loaiXe" class="form-control">
        <option value="SUV">SUV - Sport Utility Vehicle</option>
        <option value="MPV">MPV - Multi Purpose Vehecle</option>
        <option value="Sedan">Sedan</option>
        <option value="Hatchback">Hatchback</option>
        <option value="Crossover">Crossover</option>
        <option value="Coupe">Coupe</option>
        <option value="Bán tải">Bán tải</option>
        <option value="Xe tải">Xe tải</option>
    </select>
  </div> <!-- form-group// -->   
  <label for="">Hộp số</label><br/>   
  <div class="form-group input-group">
    <div class="input-group-prepend">
        <span class="input-group-text"> <i class="fa fa-caret-right"></i> </span>
    </div>
    <select name="hopSo" id="hopSo" class="form-control">
        <option value="AT">AT - Số tự động</option>
        <option value="MT">MT - Số sàn</option>
        <option value="AT/MT">AT/MT</option>
    </select>
  </div> <!-- form-group// -->   
  <label for="">Nhiên liệu</label><br/>   
  <div class="form-group input-group">
    <div class="input-group-prepend">
        <span class="input-group-text"> <i class="fa fa-caret-right"></i> </span>
    </div>
    <select name="nhienLieu" id="nhienLieu" class="form-control">
        <option value="Xăng">Xăng</option>
        <option value="Xăng/Dầu">Xăng/Dầu</option>
        <option value="Dầu">Dầu</option>
        <option value="Điện">Điện</option>
        <option value="Điện/Dầu">Điện/Dầu</option>
        <option value="Điện/Xăng">Điện/Xăng</option>
    </select>
  </div> <!-- form-group// --> 
  <label for="">Chỗ ngồi</label><br/>   
  <div class="form-group input-group">
    <div class="input-group-prepend">
        <span class="input-group-text"> <i class="fa fa-caret-right"></i> </span>
    </div>
    <select name="choNgoi" id="choNgoi" class="form-control">
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="6/7">6/7</option>
        <option value="7">7</option>
        <option value="9">9</option>
        <option value="16">16</option>
    </select>
  </div> <!-- form-group// -->     
  <label for="">Giá xe</label><br/>  
  <p id="showGiaXe"></p>
  <div class="form-group input-group">
    <div class="input-group-prepend">
        <span class="input-group-text"> <i class="fa fa-caret-right"></i> </span>
    </div>
    <input name="giaBan" id="giaBan" value="0" type="number" class="form-control" placeholder="Giá bán" required="required">
  </div> <!-- form-group// --> 
  <div class="form-group input-group">
    <input name="isNew" id="isNew" type="checkbox" style="width: 25px;"> &nbsp;
    <label for="isNew">Xe mới</label>
  </div> <!-- form-group// -->    
  <div class="form-group input-group">
    <input name="isKhuyenMai" id="isKhuyenMai" type="checkbox" style="width: 25px;"> &nbsp;
    <label for="isKhuyenMai">Khuyến mãi</label>
  </div> <!-- form-group// -->    
  <div class="form-group input-group">
    <input name="isShow" id="isShow" type="checkbox" style="width: 25px;"> &nbsp;
    <label for="isShow">Hiển thị</label>
  </div> <!-- form-group// -->      
  <label for="">Tin xe</label><br/>   
  <div class="form-group input-group">
    <div class="input-group-prepend">
        <span class="input-group-text"> <i class="fa fa-caret-right"></i> </span>
    </div>
    <select name="tinXe" id="tinXe" class="form-control">
        @foreach($tinXe as $row)
          <option value="{{$row->id}}">{{$row->name}}</option>
        @endforeach
    </select>
  </div> <!-- form-group// -->     
  <div class="form-group">
      <button type="submit" id="taoXe" class="btn btn-primary">&nbsp;&nbsp;&nbsp;Thêm&nbsp;&nbsp;&nbsp;</button>
  </div> <!-- form-group// -->                                                            
</form>
</div>
@endsection
@section('local_script')
<script type="text/javascript" language="javascript" src="{{asset('dist/ckeditor/ckeditor.js')}}<?php echo "?id=" . rand(1, 99999999);?>" ></script>
@endsection