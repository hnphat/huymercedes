@extends('layout.client.index')
@section('title')
   Tin tuyển dụng
@endsection
@section('local_css')
@endsection
@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb hyundai-headFont">
            <li class="breadcrumb-item"><a href="./">Trang chủ</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tuyển dụng</li>
        </ol>
    </nav>
    <div id="tinTucKhac" class="container hyundai-normalfont">
        <h3 class="hyundai-headFont text-left">TIN TUYỂN DỤNG</h3><br/>
        <div class="row text-justify">
            <div class="col-xs" id="tinTucKhacPanel"> 
                @foreach($tinTD as $row)
                    <div class="rowBoxShadow clearfix">
                        <div class="box-img">
                            <a href="./tin-tuc/{{$row->slugName}}"><img src="{{asset('upload/tintuc/' . $row->hinhAnh)}}" alt="{{$row->slugName}}"></a>
                        </div>
                        <div class="boxTitle">
                            <a href="./tin-tuc/{{$row->slugName}}"><h5 class="hyundai-headFont">{{$row->name}}</h5></a>
                            <p>{{$row->moTa}}</p>
                        </div>
                    </div>      
                @endforeach
                <br>
                <div class="d-flex justify-content-center">
                    {{$tinTD->links('pagination::bootstrap-4')}}
                </div>
            </div>
            <div class="col-xs" id="quangCaoPanel">
            @foreach($randomTin as $row)
                @if ($row->isTinTuc == 1)
                    <div>
                        <a href="./tin-tuc/{{$row->slugName}}">
                            <img src="{{asset('upload/tintuc/' . $row->hinhAnh)}}" alt="{{$row->slugName}}">
                        </a>
                    </div>   
                @else
                    <div>
                    <a href="./san-pham/{{$row->slugName}}">
                            <img src="{{asset('upload/tinxe/' . $row->hinhAnh)}}" alt="{{$row->slugName}}">
                        </a>
                    </div>  
                @endif
            @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
@section('local_script')
@endsection