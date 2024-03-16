@extends('layout.client.index')
@section('title')
   Cảm ơn quý khách đã gửi thông tin
@endsection
@section('local_css')
@endsection
@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb hyundai-headFont">
            <li class="breadcrumb-item"><a href="./">Trang chủ</a></li>
            <li class="breadcrumb-item">Cảm ơn quý khách đã gửi thông tin</li>
        </ol>
    </nav>
   <div class="hyundai-normalfont">
       <p class="text-center">
        <img style="max-width: 300px;" src="{{asset('images/thank.png')}}" alt="Thanks">
        <h3 class="text-center">{{$phanHoi ? $phanHoi : "Cảm ơn quý khách đã gửi thông tin, nhân viên Hyundai An Giang sẽ liên hệ quý khách!"}}</h3>
       </p>
   </div>
</div>
@endsection
@section('local_script')
@endsection