@extends('layout.client.index')
@section('title')
   Đặt lịch hẹn sửa chữa
@endsection
@section('local_css')
@endsection
@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb hyundai-headFont">
            <li class="breadcrumb-item"><a href="./">Trang chủ</a></li>
            <li class="breadcrumb-item">DỊCH VỤ</li>
            <li class="breadcrumb-item active" aria-current="page">Đặt lịch hẹn sửa chữa</li>
        </ol>
    </nav>
   <div class="hyundai-normalfont">
    <form id="formDatHen" action="{{route('post.data.dathen')}}" method="post">
        @csrf
        <input type="hidden" name="nguonDangKyLaiThu">
        <p class="hyundai-normalfont">Quý khách chỉ cần đặt hẹn, việc còn lại để <strong>Hyundai An Giang</strong> lo. 
        <br/>Lợi ích đặt hẹn: Quý khách sẽ được chọn thời gian phù hợp và không phải chờ đợi đến lượt <br/>
        <i>(Hoặc liên hệ hotline: <strong><a href="tel:0869505020">0869 50 50 20</a></strong> để đặt hẹn qua điện thoại. Luôn có nhân viên chăm sóc khách hàng trực máy hỗ trợ quý khách</i>)</p>
        <div class="form-group">
            <select id="form_need" name="xeDatHen" class="form-control" required="required" data-error="Vui lòng chọn">
                <option value="" selected disabled>Vui lòng chọn xe</option> 
                @foreach($xe as $row)
                <option value="{{$row->xe->name }}">{{$row->xe->name}}</option>
                @endforeach
            </select>
                    
        </div>
        <div class="form-group">
            <input type="text" name="hoTenDatHen" class="form-control" placeholder="Họ tên" required>
        </div>
        <div class="form-group">
            <input type="text" name="soDienThoaiDatHen" class="form-control" placeholder="Số điện thoại" required>
        </div>
        <div class="form-group">
            <input type="date" name="ngayDatLich" class="form-control" required>
        </div>
        <div class="form-group">
            <input type="text" name="noiDungHen" class="form-control" placeholder="Nội dung yêu cầu đặt hẹn" required>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-danger">ĐẶT LỊCH HẸN</button>
        </div>
    </form>
   </div>
</div>
@endsection
@section('local_script')
@endsection