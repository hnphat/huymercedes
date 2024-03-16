@extends('layout.client.index')
@section('title')
   Đăng ký lái thử
@endsection
@section('local_css')
@endsection
@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb hyundai-headFont">
            <li class="breadcrumb-item"><a href="./">Trang chủ</a></li>
            <li class="breadcrumb-item active" aria-current="page">Đăng ký lái thử</li>
        </ol>
    </nav>
   <div class="hyundai-normalfont">
    <form id="formDangKyLaiThuXe" action="{{route('post.data.dangkylaithu')}}" method="post">
        @csrf
        <input type="hidden" name="nguonDangKyLaiThu">
        <p class="hyundai-normalfont">Quý khách vui lòng để lại thông tin, để <strong>Hyundai An Giang</strong> sắp xếp xe lái thử cho quý khách</p>
        <div class="form-group">
            <select id="form_need" name="xeLaiThu" class="form-control" required="required" data-error="Vui lòng chọn">
                <option value="" selected disabled>Vui lòng chọn xe lái thử</option> 
                <option value="Hyundai Custin">Hyundai Custin</option>
                <option value="Hyundai Elantra">Hyundai Elantra</option>
                <option value="Hyundai Creta">Hyundai Creta</option>
                <option value="Hyundai Stargazer">Hyundai Stargazer</option>
            </select>
                    
        </div>
        <div class="form-group">
            <input type="text" name="hoTenLaiThu" class="form-control" placeholder="Họ tên" required>
        </div>
        <div class="form-group">
            <input type="text" name="soDienThoaiLaiThu" class="form-control" placeholder="Số điện thoại" required>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-danger">ĐĂNG KÝ</button>
        </div>
    </form>
   </div>
</div>
@endsection
@section('local_script')
@endsection