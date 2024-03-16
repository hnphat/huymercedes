@extends('layout.server.index')
@section('title')
    <title>Tin tức</title>
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
            <h1 class="m-0">TIN TỨC</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="./admin">Trang chủ</a></li>
              <li class="breadcrumb-item active">Quản lý tin tức</li>
            </ol>
          </div>
        </div>
      </div>
  </div>
@endsection
@section('content')
<div class="container_fluid">
<a href="{{route('tintuc.post.themmoi')}}" target="_blank" class="btn btn-success">Thêm mới</a><br/><br/>
<!-- Modal Edit End -->
<div class="container_fluid">
  <table id="tinTucTable" class="display" style="width:100%">
      <thead>
      <tr class="bg-gradient-lightblue">
          <th>TT</th>
          <th>Tiêu đề</th>
          <th>Ảnh</th>
          <th>Mô tả</th>
          <th>Loại tin</th>
          <th>Thu thập dữ liệu</th>
          <th>Quảng cáo xoay vòng</th>
          <th>Hiển thị</th>
          <th>Tác vụ</th>                                        
      </tr>
      </thead>
  </table>
</div>
</div>

<!-- Modal Add -->
<div class="modal fade" id="tinTucShowModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
      </div>
      <div class="modal-body">
        <div style="max-width: 1200px;">
            <h2 id="tieuDeShow"></h2>
            <p id="moTaShow"></p>
            <div id="noiDungShow">

            </div>
        </div>  
      </div>
    </div>
  </div>
</div>
<!-- Modal Add End-->
@endsection
@section('local_script')
@endsection