@extends('layout.server.index')
@section('title')
    <title>Quản lý slider</title>
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
            <h1 class="m-0">Slider</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="./admin">Trang chủ</a></li>
              <li class="breadcrumb-item active">Quản lý slider</li>
            </ol>
          </div>
        </div>
      </div>
  </div>
@endsection
@section('content')
<div class="container_fluid">
<button data-toggle="modal" data-target="#sliderAddModal" class="btn btn-success">Thêm mới</button><br/><br/>
<!-- Modal Edit End -->
<div class="container_fluid">
  <table id="sliderTable" class="display" style="width:100%">
      <thead>
      <tr class="bg-gradient-lightblue">
          <th>TT</th>
          <th>Tên slide</th>
          <th>Ảnh</th>
          <th>Bài viết  liên quan</th>
          <th>Tác vụ</th>                                        
      </tr>
      </thead>
  </table>
</div>
</div>

<!-- Modal Add -->
<div class="modal fade" id="sliderAddModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h3>THÊM MỚI SLIDE</h3>
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
      </div>
      <div class="modal-body">
        <div style="max-width: 1200px;">
        <form id="addSliderForm" method="post" autocomplete="off">
              @csrf
              <label for="">Tên slide</label><br/>
              <div class="form-group input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa fa-caret-right"></i> </span>
                </div>
                <input name="tenSlide" class="form-control" placeholder="Tên slide" required="required" autofocus="autofocus">
              </div> <!-- form-group// -->  
              <label for="">Hình Ảnh</label><br/>
              <div class="form-group input-group">    
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa fa-caret-right"></i> </span>
                </div>
                <input name="hinhAnh" type="file" class="form-control" required="required">
              </div> <!-- form-group// -->     
              <label for="">Bài viết liên quan</label><br/>
              <div class="form-group input-group">    
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa fa-caret-right"></i> </span>
                </div>
                <select name="lienQuan" id="lienQuan" class="form-control">
                    <option value="1" selected="selected">Tin xe</option>
                    <option value="0">Tin tức</option>
                </select>
              </div> <!-- form-group// -->     
              <div class="form-group input-group" id="tinXeBoxShow">    
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa fa-caret-right"></i> </span>
                </div>
                <select name="tinXe" id="tinXe" class="form-control">
                    @foreach($tinXe as $row)
                        <option value="{{$row->id}}">{{$row->name}}</option>
                    @endforeach
                </select>
              </div> <!-- form-group// -->    
              <div class="form-group input-group" id="tinTucBoxShow"  style="display: none;">    
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa fa-caret-right"></i> </span>
                </div>
                <select name="tinTuc" id="tinTuc" class="form-control">
                    @foreach($tinTuc as $row)
                        <option value="{{$row->id}}">{{$row->name}}</option>
                    @endforeach
                </select>
              </div> <!-- form-group// -->          
              <div class="form-group">
                  <button type="submit" id="taoSlide" class="btn btn-primary btn-block">Thêm</button>
              </div> <!-- form-group// -->                                                            
            </form>
        </div>  
      </div>
    </div>
  </div>
</div>
<!-- Modal Add End-->


<!-- Modal Add -->
<div class="modal fade" id="tinSlideShowModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
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

<!-- Modal Edit -->
<div class="modal fade" id="sliderEditModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h3>CẬP NHẬT SLIDE</h3>
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
      </div>
      <div class="modal-body">
        <div style="max-width: 1200px;">
        <form id="editSliderForm" method="post" autocomplete="off">
              @csrf
              <input type="hidden" name="idSlide">
              <label for="">Tên slide</label><br/>
              <div class="form-group input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa fa-caret-right"></i> </span>
                </div>
                <input name="etenSlide" class="form-control" placeholder="Tên slide" required="required" autofocus="autofocus">
              </div> <!-- form-group// -->  
              <label for="">Hình Ảnh</label><br/>
              <img id="slideShowImage" src="" alt="hình ảnh">
              <div class="form-group input-group">    
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa fa-caret-right"></i> </span>
                </div>
                <input name="ehinhAnh" type="file" class="form-control">
              </div> <!-- form-group// -->     
              <label for="">Bài viết liên quan</label><br/>
              <div class="form-group input-group">    
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa fa-caret-right"></i> </span>
                </div>
                <select name="elienQuan" id="elienQuan" class="form-control">
                    <option value="1" selected="selected">Tin xe</option>
                    <option value="0">Tin tức</option>
                </select>
              </div> <!-- form-group// -->     
              <div class="form-group input-group" id="etinXeBoxShow">    
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa fa-caret-right"></i> </span>
                </div>
                <select name="etinXe" id="etinXe" class="form-control">
                    @foreach($tinXe as $row)
                        <option value="{{$row->id}}">{{$row->name}}</option>
                    @endforeach
                </select>
              </div> <!-- form-group// -->    
              <div class="form-group input-group" id="etinTucBoxShow">    
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa fa-caret-right"></i> </span>
                </div>
                <select name="etinTuc" id="etinTuc" class="form-control">
                    @foreach($tinTuc as $row)
                        <option value="{{$row->id}}">{{$row->name}}</option>
                    @endforeach
                </select>
              </div> <!-- form-group// -->          
              <div class="form-group">
                  <button type="submit" id="capNhatSlide" class="btn btn-info btn-block">Cập nhật</button>
              </div> <!-- form-group// -->                                                            
            </form>
        </div>  
      </div>
    </div>
  </div>
</div>
<!-- Modal Edit End-->
@endsection
@section('local_script')
@endsection