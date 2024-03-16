@extends('layout.server.index')
@section('title')
    <title>Vị trí xe</title>
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
            <h1 class="m-0">Vị trí xe</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="./admin">Trang chủ</a></li>
              <li class="breadcrumb-item">Quản lý xe</li>
              <li class="breadcrumb-item active">Vị trí xe</li>
            </ol>
          </div>
        </div>
      </div>
  </div>
@endsection
@section('content')
<div class="container_fluid">
    <div class="container_fluid">
    <button id="addViTriXe" class="btn btn-success" data-toggle="modal" data-target="#addViTriXeModal" class="btn btn-primary center-block">Thêm mới</button><br/><br/>
    <table id="viTriXeTable" class="display" style="width:100%">
        <thead>
            <tr class="bg-gradient-lightblue">
                <th>TT</th>
                <th>Tên xe</th>
                <th>Giá bán</th>
                <th>Hình Ảnh</th>
                <th>Tác vụ</th>                                        
            </tr>
        </thead>
    </table>
    </div>
</div>
<!-- Modal Add -->
<div class="modal fade" id="addViTriXeModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4>THÊM MỚI</h4>
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
      </div>
      <div class="modal-body">
        <div class="card bg-light">
          <article class="card-body" style="max-width: 1000px;">
            <form id="addViTriXeForm" method="post" autocomplete="off">
              @csrf
              <label for="">Chọn xe</label>
              <div class="form-group input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa fa-caret-right"></i> </span>
                </div>
                <select name="chonXe" id="chonXe" class="form-control">
                @foreach($xe as $row)
                    <option value="{{$row->id}}">{{$row->name}}</option>
                @endforeach
                </select>
              </div> <!-- form-group// -->                
              <div class="form-group">
                  <button type="submit" id="taoViTriXe" class="btn btn-primary btn-block">Thêm</button>
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
<div class="modal fade" id="editViTriXeModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4>CẬP NHẬT</h4>
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
      </div>
      <div class="modal-body">
        <div class="card bg-light">
          <article class="card-body" style="max-width: 1000px;">
            <form id="editViTriXeForm" method="post" autocomplete="off">
              @csrf
              <input type="hidden" name="viTriXeId">
              <label for="">Chọn xe</label>
              <div class="form-group input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa fa-caret-right"></i> </span>
                </div>
                <select name="echonXe" id="echonXe" class="form-control">
                @foreach($xe as $row)
                    <option value="{{$row->id}}">{{$row->name}}</option>
                @endforeach
                </select>
              </div> <!-- form-group// -->                
              <div class="form-group">
                  <button type="submit" id="editViTriXe" class="btn btn-primary btn-block">Cập nhật</button>
              </div> <!-- form-group// -->                                                            
            </form>
          </article>
        </div>  
      </div>
    </div>
  </div>
</div>
<!-- Modal Edit End-->
@endsection
@section('local_script')
@endsection