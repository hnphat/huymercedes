@extends('layout.server.index')
@section('title')
    <title>Cấu hình</title>
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
            <h1 class="m-0">Cấu hình</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="./admin">Trang chủ</a></li>
              <li class="breadcrumb-item active">Cấu hình</li>
            </ol>
          </div>
        </div>
      </div>
  </div>
@endsection
@section('content')
<div class="container_fluid">
    <div class="container_fluid">
            <form id="cauHinhForm" method="post" autocomplete="off">
              @csrf
              <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Tên công ty</label>
                            <input name="tenCongTy" value="{{$data['tenCongTy']}}" class="form-control" required="required" autofocus="autofocus">
                        </div> <!-- form-group// --> 
                        <div class="form-group">
                            <label for="">Địa chỉ</label>
                            <input name="diaChi" value="{{$data['diaChi']}}" class="form-control" required="required">
                        </div> <!-- form-group// -->  
                        <div class="form-group">
                            <label for="">Số điện thoại</label>
                            <input name="soDienThoai" value="{{$data['soDienThoai']}}" class="form-control" required="required">
                        </div> <!-- form-group// -->  
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" value="{{$data['email']}}" name="email" class="form-control" required="required">
                        </div> <!-- form-group// -->  
                        <div class="form-group">
                            <label for="">Địa chỉ bản đồ</label>
                            <input name="srcMap" value="{{$data['srcMap']}}" class="form-control" required="required">
                        </div> <!-- form-group// -->  
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Tiêu đề 1</label>
                            <input name="title1" value="{{$data['title1']}}" class="form-control" autofocus="autofocus">
                        </div> <!-- form-group// --> 
                        <div class="form-group">
                            <label for="">Tiêu đề 1 hàng 1</label>
                            <input name="t1row1" value="{{$data['t1row1']}}" class="form-control" autofocus="autofocus">
                        </div> <!-- form-group// --> 
                        <div class="form-group">
                            <label for="">Link</label>
                            <input name="t1linkrow1" value="{{$data['t1linkrow1']}}" class="form-control" autofocus="autofocus">
                        </div> <!-- form-group// --> 

                        <div class="form-group">
                            <label for="">Tiêu đề 1 hàng 2</label>
                            <input name="t1row2" value="{{$data['t1row2']}}" class="form-control" autofocus="autofocus">
                        </div> <!-- form-group// --> 
                        <div class="form-group">
                            <label for="">Link</label>
                            <input name="t1linkrow2" value="{{$data['t1linkrow2']}}" class="form-control" autofocus="autofocus">
                        </div> <!-- form-group// --> 

                        <div class="form-group">
                            <label for="">Tiêu đề 1 hàng 3</label>
                            <input name="t1row3" value="{{$data['t1row3']}}" class="form-control" autofocus="autofocus">
                        </div> <!-- form-group// --> 
                        <div class="form-group">
                            <label for="">Link</label>
                            <input name="t1linkrow3" value="{{$data['t1linkrow3']}}" class="form-control" autofocus="autofocus">
                        </div> <!-- form-group// --> 

                        <div class="form-group">
                            <label for="">Tiêu đề 1 hàng 4</label>
                            <input name="t1row4" value="{{$data['t1row4']}}" class="form-control" autofocus="autofocus">
                        </div> <!-- form-group// --> 
                        <div class="form-group">
                            <label for="">Link</label>
                            <input name="t1linkrow4" value="{{$data['t1linkrow4']}}" class="form-control" autofocus="autofocus">
                        </div> <!-- form-group// --> 
                        
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Tiêu đề 2</label>
                            <input name="title2" value="{{$data['title2']}}" class="form-control" autofocus="autofocus">
                        </div> <!-- form-group// --> 
                        <div class="form-group">
                            <label for="">Tiêu đề 2 hàng 1</label>
                            <input name="t2row1" value="{{$data['t2row1']}}" class="form-control" autofocus="autofocus">
                        </div> <!-- form-group// --> 
                        <div class="form-group">
                            <label for="">Link</label>
                            <input name="t2linkrow1" value="{{$data['t2linkrow1']}}" class="form-control" autofocus="autofocus">
                        </div> <!-- form-group// --> 

                        <div class="form-group">
                            <label for="">Tiêu đề 2 hàng 2</label>
                            <input name="t2row2" value="{{$data['t2row2']}}" class="form-control" autofocus="autofocus">
                        </div> <!-- form-group// --> 
                        <div class="form-group">
                            <label for="">Link</label>
                            <input name="t2linkrow2" value="{{$data['t2linkrow2']}}" class="form-control" autofocus="autofocus">
                        </div> <!-- form-group// --> 

                        <div class="form-group">
                            <label for="">Tiêu đề 2 hàng 3</label>
                            <input name="t2row3" value="{{$data['t2row3']}}" class="form-control" autofocus="autofocus">
                        </div> <!-- form-group// --> 
                        <div class="form-group">
                            <label for="">Link</label>
                            <input name="t2linkrow3" value="{{$data['t2linkrow3']}}" class="form-control" autofocus="autofocus">
                        </div> <!-- form-group// --> 
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Facebook</label>
                            <input name="facebooklink" value="{{$data['facebook']}}" class="form-control" autofocus="autofocus">
                        </div> <!-- form-group// --> 
                        <div class="form-group">
                            <label for="">Zalo</label>
                            <input name="zalolink" value="{{$data['zalo']}}" class="form-control" autofocus="autofocus">
                        </div> <!-- form-group// --> 
                        <div class="form-group">
                            <label for="">Youtube</label>
                            <input name="youtubelink" value="{{$data['youtube']}}" class="form-control" autofocus="autofocus">
                        </div> <!-- form-group// --> 
                    </div>
              </div>  
              <div class="col-md-2">
                  <button type="submit" id="capNhatCauHinh" class="btn btn-primary btn-block">Cập nhật</button>
               </div> <!-- form-group// -->                                                         
            </form>
    </div>
</div>
@endsection
@section('local_script')
@endsection