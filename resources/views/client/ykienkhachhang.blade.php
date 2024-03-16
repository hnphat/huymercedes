@extends('layout.client.index')
@section('title')
   Ý kiến khách hàng
@endsection
@section('local_css')
@endsection
@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb hyundai-headFont">
            <li class="breadcrumb-item"><a href="./">Trang chủ</a></li>
            <li class="breadcrumb-item">CSKH</li>
            <li class="breadcrumb-item active" aria-current="page">Ý kiến khách hàng</li>
        </ol>
    </nav>
   <div class="hyundai-normalfont">
    <form id="formDongGopYKien" action="{{route('post.data.gopy')}}" method="post">
        @csrf
        <p class="hyundai-normalfont"><strong>Hyundai An Giang</strong> cảm ơn quý khách hàng đã tin tưởng và 
        sử dụng sản phẩm Hyundai. Để góp phần nâng cao chất lượng dịch vụ, 
        <strong>Hyundai An Giang</strong> rất mong nhận được ý kiến đóng góp của quý khách. 
        Vui lòng giành chút thời gian gửi ý kiến của quý khách bên dưới. Xin cảm ơn!</p>
        <div class="form-group">
            <input type="text" name="hoTenDongGop" class="form-control" placeholder="Họ tên" required>
        </div>
        <div class="form-group">
            <input type="text" name="soDienThoaiDongGop" class="form-control" placeholder="Số điện thoại" required>
        </div>
        <div class="form-group">
            <input type="text" name="noiDungDongGop" class="form-control" placeholder="Nội dung góp ý" required>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-danger">GỬI</button>
        </div>
    </form>
   </div>
</div>
@endsection
@section('local_script')
@endsection