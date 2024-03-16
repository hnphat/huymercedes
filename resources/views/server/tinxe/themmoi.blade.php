@extends('layout.server.index')
@section('title')
    <title>Thêm mới tin xe</title>
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
            <h1 class="m-0">THÊM MỚI TIN XE</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="./admin">Trang chủ</a></li>
              <li class="breadcrumb-item">Quản lý xe</li>
              <li class="breadcrumb-item active">Tin xe -> Thêm mới</li>
            </ol>
          </div>
        </div>
      </div>
  </div>
@endsection
@section('content')
<div class="container_fluid">
<form id="addTinXeForm" method="post" autocomplete="off" enctype="multipart/form-data">
  @csrf
  <label for="">Tiêu đề</label><br/>  
  <div class="form-group input-group">
    <div class="input-group-prepend">
        <span class="input-group-text"> <i class="fa fa-caret-right"></i> </span>
    </div>
    <input name="tieuDe" type="text" class="form-control" placeholder="Tiêu đề tin" required="required" autofocus="autofocus">
  </div> <!-- form-group// -->    
  <label for="">Hình Ảnh</label><br/>
  <div class="form-group input-group">    
    <div class="input-group-prepend">
        <span class="input-group-text"> <i class="fa fa-caret-right"></i> </span>
    </div>
    <input name="hinhAnh" type="file" class="form-control" required="required">
  </div> <!-- form-group// -->   
  <label for="">Mô tả bài viết (tối đa 255 ký tự)</label><br/>  
  <div class="form-group input-group">
    <textarea name="moTa" id="moTa" cols="30" rows="3" class="form-control" maxlength="254"></textarea>
  </div> <!-- form-group// -->      
  <label for="">Nội dung</label><br/>  
  <div class="form-group">
    <textarea name="noiDung" id="noiDung" class="ckeditor"></textarea>
  </div> <!-- form-group// -->    
  <div class="form-group input-group">
    <input name="isAds" id="isAds" type="checkbox" style="width: 25px;"> &nbsp;
    <label for="isAds">Quảng cáo xoay vòng</label>
  </div> <!-- form-group// -->    
  <div class="form-group input-group">
    <input name="thuThap" id="thuThap" type="checkbox" style="width: 25px;"> &nbsp;
    <label for="thuThap">Thu thập dữ liệu</label>
  </div> <!-- form-group// -->    
  <label for="">Thông số kỹ thuật (*.pdf)</label><br/>
  <div class="form-group input-group">    
    <div class="input-group-prepend">
        <span class="input-group-text"> <i class="fa fa-caret-right"></i> </span>
    </div>
    <input name="thongSoKyThuat" type="file" class="form-control" required="required">
  </div> <!-- form-group// -->   
  <div class="form-group">
      <button type="submit" id="taoTinXe" class="btn btn-primary">&nbsp;&nbsp;&nbsp;Thêm&nbsp;&nbsp;&nbsp;</button>
  </div> <!-- form-group// -->                                                            
</form>
</div>
@endsection
@section('local_script')
<script type="text/javascript" language="javascript" src="{{asset('dist/ckeditor/ckeditor.js')}}<?php echo "?id=" . rand(1, 99999999);?>" ></script>
<script>
  CKEDITOR.replace('noiDung', {
    filebrowserBrowseUrl: '{{ asset('dist/ckfinder/ckfinder.html') }}',
    filebrowserImageBrowseUrl: '{{ asset('dist/ckfinder/ckfinder.html?type=Images') }}',
    filebrowserFlashBrowseUrl: '{{ asset('dist/ckfinder/ckfinder.html?type=Flash') }}',
    filebrowserUploadUrl: '{{ asset('dist/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}',
    filebrowserImageUploadUrl: '{{ asset('dist/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}',
    filebrowserFlashUploadUrl: '{{ asset('dist/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}'
  });
</script>
@endsection