@extends('layout.server.index')
@section('title')
    <title>Cập nhật xe</title>
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
            <h1 class="m-0">CẬP NHẬT XE</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="./admin">Trang chủ</a></li>
              <li class="breadcrumb-item">Quản lý xe</li>
              <li class="breadcrumb-item active">Xe -> Cập nhật</li>
            </ol>
          </div>
        </div>
      </div>
  </div>
@endsection
@section('content')
<div class="container_fluid">
<form id="editXeForm" method="post" autocomplete="off" enctype="multipart/form-data">
  @csrf
  <label for="">Tên xe</label><br/>  
  <div class="form-group input-group">
    <div class="input-group-prepend">
        <span class="input-group-text"> <i class="fa fa-caret-right"></i> </span>
    </div>
    <input name="etenXe" value="{{$data->name}}" type="text" class="form-control" placeholder="Tên xe" required="required" autofocus="autofocus">
  </div> <!-- form-group// --> 
  <label for="">Dòng xe</label><br/>   
  <div class="form-group input-group">
    <div class="input-group-prepend">
        <span class="input-group-text"> <i class="fa fa-caret-right"></i> </span>
    </div>
    <select name="edongXe" id="edongXe" class="form-control">
        @foreach($dongXe as $row)
          <option value="{{$row->id}}" 
          @if($data->idDongXe == $row->id)
            selected="selected"
          @endif
          >{{$row->name}}</option>
        @endforeach
    </select>
  </div> <!-- form-group// -->    
  <label for="">Hình Ảnh</label><br/>
  <img class='picminiedit' id="imgEdit" src="./upload/xe/{{$data->hinhAnh}}" alt="Hình ảnh">
  <div class="form-group input-group">    
    <div class="input-group-prepend">
        <span class="input-group-text"> <i class="fa fa-caret-right"></i> </span>
    </div>
    <input name="ehinhAnh" type="file" class="form-control">
  </div> <!-- form-group// -->     
  <label for="">Kiểu dáng</label><br/>   
  <div class="form-group input-group">
    <div class="input-group-prepend">
        <span class="input-group-text"> <i class="fa fa-caret-right"></i> </span>
    </div>
    <select name="eloaiXe" id="eloaiXe" class="form-control">
        <option value="SUV" 
        @if($data->loaiXe == "SUV")
            selected="selected"
        @endif
        >SUV - Sport Utility Vehicle</option>
        <option value="MPV"
        @if($data->loaiXe == "MPV")
            selected="selected"
        @endif
        >MPV - Multi Purpose Vehecle</option>
        <option value="Sedan"
        @if($data->loaiXe == "Sedan")
            selected="selected"
        @endif
        >Sedan</option>
        <option value="Hatchback"
        @if($data->loaiXe == "Hatchback")
            selected="selected"
        @endif
        >Hatchback</option>
        <option value="Crossover"
        @if($data->loaiXe == "Crossover")
            selected="selected"
        @endif
        >Crossover</option>
        <option value="Coupe"
        @if($data->loaiXe == "Coupe")
            selected="selected"
        @endif
        >Coupe</option>
        <option value="Bán tải"
        @if($data->loaiXe == "Bán tải")
            selected="selected"
        @endif
        >Bán tải</option>
        <option value="Xe tải"
        @if($data->loaiXe == "Xe tải")
            selected="selected"
        @endif
        >Xe tải</option>
    </select>
  </div> <!-- form-group// -->   
  <label for="">Hộp số</label><br/>   
  <div class="form-group input-group">
    <div class="input-group-prepend">
        <span class="input-group-text"> <i class="fa fa-caret-right"></i> </span>
    </div>
    <select name="ehopSo" id="ehopSo" class="form-control">
        <option value="AT"
        @if($data->hopSo == "AT")
            selected="selected"
        @endif
        >AT - Số tự động</option>
        <option value="MT"
        @if($data->hopSo == "MT")
            selected="selected"
        @endif
        >MT - Số sàn</option>
        <option value="AT/MT"
        @if($data->hopSo == "AT/MT")
            selected="selected"
        @endif
        >AT/MT</option>
    </select>
  </div> <!-- form-group// -->   
  <label for="">Nhiên liệu</label><br/>   
  <div class="form-group input-group">
    <div class="input-group-prepend">
        <span class="input-group-text"> <i class="fa fa-caret-right"></i> </span>
    </div>
    <select name="enhienLieu" id="enhienLieu" class="form-control">
        <option value="Xăng"
        @if($data->nhienLieu == "Xăng")
            selected="selected"
        @endif
        >Xăng</option>
        <option value="Xăng/Dầu"
        @if($data->nhienLieu == "Xăng/Dầu")
            selected="selected"
        @endif
        >Xăng/Dầu</option>
        <option value="Dầu"
        @if($data->nhienLieu == "Dầu")
            selected="selected"
        @endif
        >Dầu</option>
        <option value="Điện"
        @if($data->nhienLieu == "Điện")
            selected="selected"
        @endif
        >Điện</option>
        <option value="Điện/Dầu"
        @if($data->nhienLieu == "Điện/Dầu")
            selected="selected"
        @endif
        >Điện/Dầu</option>
        <option value="Điện/Xăng"
        @if($data->nhienLieu == "Điện/Xăng")
            selected="selected"
        @endif
        >Điện/Xăng</option>
    </select>
  </div> <!-- form-group// --> 
  <label for="">Chỗ ngồi</label><br/>   
  <div class="form-group input-group">
    <div class="input-group-prepend">
        <span class="input-group-text"> <i class="fa fa-caret-right"></i> </span>
    </div>
    <select name="echoNgoi" id="echoNgoi" class="form-control">
        <option value="4"
        @if($data->choNgoi == 4)
            selected="selected"
        @endif
        >4</option>
        <option value="5"
        @if($data->choNgoi == 5)
            selected="selected"
        @endif
        >5</option>
        <option value="6"
        @if($data->choNgoi == 6)
            selected="selected"
        @endif
        >6</option>
        <option value="6/7"
        @if($data->choNgoi == "6/7")
            selected="selected"
        @endif
        >6/7</option>
        <option value="7"
        @if($data->choNgoi == 7)
            selected="selected"
        @endif
        >7</option>
        <option value="9"
        @if($data->choNgoi == 9)
            selected="selected"
        @endif
        >9</option>
        <option value="16"
        @if($data->choNgoi == 16)
            selected="selected"
        @endif
        >16</option>
    </select>
  </div> <!-- form-group// -->     
  <label for="">Giá xe</label><br/>  
  <p id="eshowGiaXe"></p>
  <div class="form-group input-group">
    <div class="input-group-prepend">
        <span class="input-group-text"> <i class="fa fa-caret-right"></i> </span>
    </div>
    <input name="egiaBan" id="egiaBan" value="{{$data->giaBan}}" type="number" class="form-control" placeholder="Giá bán" required="required">
  </div> <!-- form-group// --> 
  <div class="form-group input-group">
    <input name="eisNew" id="eisNew" type="checkbox" style="width: 25px;"
    @if($data->isNew)
      checked="checked"
    @endif
    > &nbsp;
    <label for="eisNew">Xe mới</label>
  </div> <!-- form-group// -->    
  <div class="form-group input-group">
    <input name="eisKhuyenMai" id="eisKhuyenMai" type="checkbox" style="width: 25px;"
    @if($data->isKhuyenMai)
      checked="checked"
    @endif
    > &nbsp;
    <label for="eisKhuyenMai">Khuyến mãi</label>
  </div> <!-- form-group// -->    
  <div class="form-group input-group">
    <input name="eisShow" id="eisShow" type="checkbox" style="width: 25px;"
    @if($data->isShow)
      checked="checked"
    @endif
    > &nbsp;
    <label for="eisShow">Hiển thị</label>
  </div> <!-- form-group// -->      
  <label for="">Tin xe</label><br/>   
  <div class="form-group input-group">
    <div class="input-group-prepend">
        <span class="input-group-text"> <i class="fa fa-caret-right"></i> </span>
    </div>
    <select name="etinXe" id="etinXe" class="form-control">
        @foreach($tinXe as $row)
          <option value="{{$row->id}}"
          @if($data->tinXe == $row->id)
            selected="selected"
          @endif
          >{{$row->name}}</option>
        @endforeach
    </select>
  </div> <!-- form-group// -->     
  <div class="form-group">
      <button type="submit" id="capNhatXe" class="btn btn-primary">&nbsp;&nbsp;&nbsp;Cập nhật&nbsp;&nbsp;&nbsp;</button>
  </div> <!-- form-group// -->                                                            
</form>
</div>
@endsection
@section('local_script')
<script type="text/javascript" language="javascript" src="{{asset('dist/ckeditor/ckeditor.js')}}<?php echo "?id=" . rand(1, 99999999);?>" ></script>
@endsection