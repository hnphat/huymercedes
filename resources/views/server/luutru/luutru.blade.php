@extends('layout.server.index')
@section('title')
    <title>Quản lý lưu trữ</title>
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
            <h1 class="m-0">QUẢN LÝ LƯU TRỮ</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="./admin">Trang chủ</a></li>
              <li class="breadcrumb-item active">Quản lý lưu trữ</li>
            </ol>
          </div>
        </div>
      </div>
  </div>
@endsection
@section('content')
<div class="container_fluid">
    <div id="luuTruPanel">
        <iframe style="padding:0; margin:0; width: 100%; min-height: 500px;" src="
        @if(App::environment() == 'local')
          http://localhost/carsaleproject/public/dist/ckfinder/ckfinder.html?CKEditor=noiDung&CKEditorFuncNum=1&langCode=en
        @else
          https://hyundaiangiang.com/public/dist/ckfinder/ckfinder.html?CKEditor=noiDung&CKEditorFuncNum=1&langCode=en
        @endif" frameborder="0"></iframe>
    </div>
</div>
@endsection
@section('local_script')
@endsection