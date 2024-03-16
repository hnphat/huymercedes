@extends('layout.client.index')
@section('title')
    {{$tinXe->name}}
@endsection
@section('local_css')
@endsection
@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb hyundai-headFont">
            <li class="breadcrumb-item"><a href="./">Trang chủ</a></li>
            <li class="breadcrumb-item">Sản phẩm</li>
            <li class="breadcrumb-item active" aria-current="page">{{$tinXe->name}}</li>
        </ol>
    </nav>
   <div class="hyundai-normalfont">
        <div class="row">
            <div class="col-md-8">
                <img id="mauxeshow" class="carimage" src="{{asset('upload/xe/' . $tinXe->xe->hinhAnh)}}" alt="{{$tinXe->xe->name}}">
                <!-- <h5 class="text-center"><img class="carcolor" src="{{asset('')}}/images/car/360.png" alt="Demo car"></h5> -->
            </div>
            <div class="col-md-4">
                <h3><strong>{{$tinXe->name}}</strong></h3>
                <h4><strong>Giá xe: <span class="text-danger">{{number_format($tinXe->xe->giaBan)}}</span></strong></h4>
                <h4><strong>Màu sắc: </strong>
                    <ul class="navbarcolor">
                        @foreach($tinXe->xe->mau as $row)
                            <li> 
                                <img id="onclickcolor" data-anhmau="{{asset('upload/mauxe/' . $row->hinhAnh)}}" class="carcolor" src="{{asset('upload/mauxe/' . $row->hinhAnh)}}" alt="{{$row->tenMau}}">
                            </li>
                        @endforeach
                    </ul>         
                </h4>          
                <h5><strong>Kiểu dáng: </strong>{{$tinXe->xe->loaiXe}}</h5>
                <h5><strong>Hộp số: </strong>{{$tinXe->xe->hopSo}}</h5>
                <h5><strong>Nhiên liệu: </strong>{{$tinXe->xe->nhienLieu}}</h5>
                <h5><strong>Số chỗ: </strong>{{$tinXe->xe->choNgoi}}</h5>
                <p class="text-center"><button class="btn btn-info" data-toggle="modal" data-target="#modalBaoGia">Nhận báo giá</button> &nbsp;
                <a href="tel:0868505050"><button class="btn btn-outline-danger">Gọi ngay</button></a></p>
                <button class="btn btn-warning" data-toggle="modal" data-target="#modalDangKyLaiThu" style="width:100%;">Đăng ký lái thử</button>
            </div>
        </div>
        <div class="row text-justify">
            <h2><strong>CHI TIẾT XE</strong></h2>
            <div id="tinTucVeXe">
                <a href="{{asset('upload/tinxe/thongsokythuat/' . $tinXe->thongSoKyThuat)}}" class="btn btn-primary clearfix" target="_blank">
                    THÔNG SỐ KỸ THUẬT
                </a> <br/><br/>
                {!! $tinXe->content !!}
            </div>
        </div>
   </div>
</div>
@endsection
@section('local_script')
@endsection