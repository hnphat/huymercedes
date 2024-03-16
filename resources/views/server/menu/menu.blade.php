@extends('layout.server.index')
@section('title')
    <title>Quản lý Menu</title>
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
            <h1 class="m-0">Menu</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="./">Trang chủ</a></li>
              <li class="breadcrumb-item active">Quản lý Menu</li>
            </ol>
          </div>
        </div>
      </div>
  </div>
@endsection
@section('content')
<div class="container_fluid">
<a href="#" data-toggle="modal" data-target="#addMenuShowModal" class="btn btn-success">Thêm mới</a><br/><br/>
<!-- Modal Edit End -->
<div class="container_fluid">
  <table id="navTable" class="display" style="width:100%">
      <thead>
      <tr class="bg-gradient-lightblue">
          <th>TT</th>
          <th>Nội dung</th>
          <th>Submenu</th>
          <th>Link</th>
          <th>Bài viết</th>
          <th>Hiển thị</th>    
          <th>Tác vụ</th>                             
      </tr>
      </thead>
  </table>
</div>
</div>

<!-- Modal Add Menu -->
<div class="modal fade" id="addMenuShowModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h3>THÊM MENU</h3>
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
      </div>
      <div class="modal-body">
        <div style="max-width: 1200px;">
          <form id="addMenuForm" method="post" autocomplete="off">
              @csrf
              <label for="">Tên Menu</label><br/>
              <div class="form-group input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa fa-caret-right"></i> </span>
                </div>
                <input name="tenMenu" class="form-control" placeholder="Tên menu" required="required">
              </div> <!-- form-group// --> 
              <label for="">Sub Menu (Menu con)</label><br/>
              <div class="form-group input-group">    
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa fa-caret-right"></i> </span>
                </div>
                <select name="hasSubMenu" id="hasSubMenu" class="form-control">
                    <option value="1" selected="selected">Có</option>
                    <option value="0">Không</option>
                </select>
              </div> <!-- form-group// --> 
              <fieldset id="menuAdvance" style="display: none;">
                <legend>Điều hướng Menu</legend>
                <label for="">Liên kết</label><br/>
                <div class="form-group input-group">    
                  <div class="input-group-prepend">
                      <span class="input-group-text"> <i class="fa fa-caret-right"></i> </span>
                  </div>
                  <select name="isBaiViet" id="isBaiViet" class="form-control">
                      <option value="1" selected="selected">Tin tức</option>
                      <option value="0">Địa chỉ web</option>
                  </select>
                </div> <!-- form-group// --> 
                <div class="form-group input-group" id="linkShow" style="display: none;">
                  <div class="input-group-prepend">
                      <span class="input-group-text"> <i class="fa fa-caret-right"></i> </span>
                  </div>
                  <input name="link" class="form-control" placeholder="Nhập địa chỉ web">
                </div> <!-- form-group// --> 
                <div class="form-group input-group" id="baiVietShow">    
                  <div class="input-group-prepend">
                      <span class="input-group-text"> <i class="fa fa-caret-right"></i> </span>
                  </div>
                  <select name="baiViet" id="baiViet" class="form-control">
                      @foreach($tinTuc as $row)
                          <option value="{{$row->id}}">{{$row->name}}</option>
                      @endforeach
                  </select>
                </div> <!-- form-group// --> 
              </fieldset>         
              <div class="form-group input-group">
                <input name="isShow" id="isShow" type="checkbox" style="width: 25px;"> &nbsp;
                <label for="isShow">Hiển thị</label>
              </div> <!-- form-group// -->              
              <div class="form-group">
                  <button type="submit" id="taoMenu" class="btn btn-primary btn-block">Thêm</button>
              </div> <!-- form-group// -->                                                            
            </form>
        </div>  
      </div>
    </div>
  </div>
</div>
<!-- Modal Add End-->

<!-- Modal Edit Menu -->
<div class="modal fade" id="editMenuShowModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h3>CẬP NHẬT MENU</h3>
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
      </div>
      <div class="modal-body">
        <div style="max-width: 1200px;">
          <form id="editMenuForm" method="post" autocomplete="off">
              @csrf
              <input type="hidden" name="idMenu" />
              <label for="">Tên Menu</label><br/>
              <div class="form-group input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa fa-caret-right"></i> </span>
                </div>
                <input name="etenMenu" class="form-control" placeholder="Tên menu" required="required">
              </div> <!-- form-group// --> 
              <label for="">Sub Menu (Menu con)</label><br/>
              <div class="form-group input-group">    
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa fa-caret-right"></i> </span>
                </div>
                <select name="ehasSubMenu" id="ehasSubMenu" class="form-control">
                    <option value="1" selected="selected">Có</option>
                    <option value="0">Không</option>
                </select>
              </div> <!-- form-group// --> 
              <fieldset id="emenuAdvance" style="display: none;">
                <legend>Điều hướng Menu</legend>
                <label for="">Liên kết</label><br/>
                <div class="form-group input-group">    
                  <div class="input-group-prepend">
                      <span class="input-group-text"> <i class="fa fa-caret-right"></i> </span>
                  </div>
                  <select name="eisBaiViet" id="eisBaiViet" class="form-control">
                      <option value="1" selected="selected">Tin tức</option>
                      <option value="0">Địa chỉ web</option>
                  </select>
                </div> <!-- form-group// --> 
                <div class="form-group input-group" id="elinkShow" style="display: none;">
                  <div class="input-group-prepend">
                      <span class="input-group-text"> <i class="fa fa-caret-right"></i> </span>
                  </div>
                  <input name="elink" class="form-control" placeholder="Nhập địa chỉ liên kết">
                </div> <!-- form-group// --> 
                <div class="form-group input-group" id="ebaiVietShow" style="display: none;">    
                  <div class="input-group-prepend">
                      <span class="input-group-text"> <i class="fa fa-caret-right"></i> </span>
                  </div>
                  <select name="ebaiViet" id="ebaiViet" class="form-control">
                      @foreach($tinTuc as $row)
                          <option value="{{$row->id}}">{{$row->name}}</option>
                      @endforeach
                  </select>
                </div> <!-- form-group// --> 
              </fieldset>      
              <div class="form-group input-group">
                <input name="eisShow" id="eisShow" type="checkbox" style="width: 25px;"> &nbsp;
                <label for="eisShow">Hiển thị</label>
              </div> <!-- form-group// -->              
              <div class="form-group">
                  <button type="submit" id="capNhatMenu" class="btn btn-primary btn-block">Cập nhật</button>
              </div> <!-- form-group// -->                                                            
            </form>
        </div>  
      </div>
    </div>
  </div>
</div>
<!-- Modal Edit End-->

<!-- Modal Add Sub Menu -->
<div class="modal fade" id="subMenuAddModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h3>THÊM SUBMENU</h3>
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
      </div>
      <div class="modal-body">
        <div style="max-width: 1200px;">
          <form id="addSubMenuForm" method="post" autocomplete="off">
              @csrf
              <input type="hidden" name="idParentMenu" />
              <label for="">Tên SubMenu</label><br/>
              <div class="form-group input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa fa-caret-right"></i> </span>
                </div>
                <input name="tenSubMenu" class="form-control" placeholder="Tên submenu" required="required">
              </div> <!-- form-group// --> 
              <fieldset id="menuAdvanceSub">
                <legend>Điều hướng Menu</legend>
                <label for="">Liên kết</label><br/>
                <div class="form-group input-group">    
                  <div class="input-group-prepend">
                      <span class="input-group-text"> <i class="fa fa-caret-right"></i> </span>
                  </div>
                  <select name="isBaiVietSub" id="isBaiVietSub" class="form-control">
                      <option value="1" selected="selected">Tin tức</option>
                      <option value="0">Địa chỉ web</option>
                  </select>
                </div> <!-- form-group// --> 
                <div class="form-group input-group" id="linkShowSub" style="display: none;">
                  <div class="input-group-prepend">
                      <span class="input-group-text"> <i class="fa fa-caret-right"></i> </span>
                  </div>
                  <input name="linkSub" class="form-control" placeholder="Nhập địa chỉ web">
                </div> <!-- form-group// --> 
                <div class="form-group input-group" id="baiVietShowSub">    
                  <div class="input-group-prepend">
                      <span class="input-group-text"> <i class="fa fa-caret-right"></i> </span>
                  </div>
                  <select name="baiVietSub" id="baiVietSub" class="form-control">
                      @foreach($tinTuc as $row)
                          <option value="{{$row->id}}">{{$row->name}}</option>
                      @endforeach
                  </select>
                </div> <!-- form-group// --> 
              </fieldset>         
              <div class="form-group input-group">
                <input name="isShowSub" id="isShowSub" type="checkbox" style="width: 25px;"> &nbsp;
                <label for="isShowSub">Hiển thị</label>
              </div> <!-- form-group// -->              
              <div class="form-group">
                  <button type="submit" id="taoSubMenu" class="btn btn-primary btn-block">Thêm</button>
              </div> <!-- form-group// -->                                                            
            </form>
        </div>  
      </div>
    </div>
  </div>
</div>
<!-- Modal Add End-->

<!-- Modal Edit Sub Menu -->
<div class="modal fade" id="subMenuEditModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h3>CẬP NHẬT SUBMENU</h3>
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
      </div>
      <div class="modal-body">
        <div style="max-width: 1200px;">
          <form id="editSubMenuForm" method="post" autocomplete="off">
              @csrf
              <input type="hidden" name="idSubMenu" />
              <label for="">Tên SubMenu</label><br/>
              <div class="form-group input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa fa-caret-right"></i> </span>
                </div>
                <input name="etenSubMenu" class="form-control" placeholder="Tên submenu" required="required">
              </div> <!-- form-group// --> 
              <fieldset id="emenuAdvanceSub">
                <legend>Điều hướng Menu</legend>
                <label for="">Liên kết</label><br/>
                <div class="form-group input-group">    
                  <div class="input-group-prepend">
                      <span class="input-group-text"> <i class="fa fa-caret-right"></i> </span>
                  </div>
                  <select name="eisBaiVietSub" id="eisBaiVietSub" class="form-control">
                      <option value="1" selected="selected">Tin tức</option>
                      <option value="0">Địa chỉ web</option>
                  </select>
                </div> <!-- form-group// --> 
                <div class="form-group input-group" id="elinkShowSub" style="display: none;">
                  <div class="input-group-prepend">
                      <span class="input-group-text"> <i class="fa fa-caret-right"></i> </span>
                  </div>
                  <input name="elinkSub" class="form-control" placeholder="Nhập địa chỉ web">
                </div> <!-- form-group// --> 
                <div class="form-group input-group" id="ebaiVietShowSub">    
                  <div class="input-group-prepend">
                      <span class="input-group-text"> <i class="fa fa-caret-right"></i> </span>
                  </div>
                  <select name="ebaiVietSub" id="ebaiVietSub" class="form-control">
                      @foreach($tinTuc as $row)
                          <option value="{{$row->id}}">{{$row->name}}</option>
                      @endforeach
                  </select>
                </div> <!-- form-group// --> 
              </fieldset>         
              <div class="form-group input-group">
                <input name="eisShowSub" id="eisShowSub" type="checkbox" style="width: 25px;"> &nbsp;
                <label for="eisShowSub">Hiển thị</label>
              </div> <!-- form-group// -->              
              <div class="form-group">
                  <button type="submit" id="capNhatSubMenu" class="btn btn-primary btn-block">Cập nhật</button>
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