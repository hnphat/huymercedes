@extends('layout.client.index')
@section('title')
    {{$tinTuc->name}}
@endsection
@section('local_css')
@endsection
@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb hyundai-headFont">
            <li class="breadcrumb-item"><a href="./">Trang chủ</a></li>
            <li class="breadcrumb-item">Tin tức</li>
            <li class="breadcrumb-item active" aria-current="page">{{$tinTuc->name}}</li>
        </ol>
    </nav>
    <div id="tinTucKhac" class="container hyundai-normalfont">        
        <div class="row text-justify">
            <div class="col-xs clearfix" id="tinTucKhacPanel"> 
                <h4 class="hyundai-headFont">{{$tinTuc->name}}</h4>
                <i class="text-secondary">By Admin - {{\HelpFunction::revertCreatedAt($tinTuc->created_at)}}</i>
                <div id="tinTucVeXe">
                    {!! $tinTuc->content !!}
                </div>
                <hr/>
                <div id="tinTucKhac" class="container hyundai-normalfont">
                    <h4 class="hyundai-headFont">TIN LIÊN QUAN</h4>
                    <div class="text-justify">
                        <div> 
                            @foreach($tinLienQuan as $row)
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
                        </div>                        
                    </div>
                </div><br>
                <div id="tinTucKhac" class="container hyundai-normalfont">
                    <h4 class="hyundai-headFont">TIN KHUYẾN MÃI</h4>
                    <div class="text-justify">
                        <div> 
                            @foreach($tinKM as $row)
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
                        </div>                        
                    </div>
                </div>
            </div>
            <div class="col-xs" id="aSidePanel">
                <div class="sanPhamNoiBat">
                    <h4><strong>Có thể bạn quan tâm</strong></h4>
                    <hr class="hrblue">
                    @foreach($randomCar as $row)
                        <div class="sanPhamNoiBatRow">
                        <a href="./san-pham/{{$row->xe->tin->slugName}}">
                            <img src="{{asset('upload/xe/' . $row->xe->hinhAnh)}}" alt="{{$row->xe->name}}">
                            <div class="spNoiBat">
                                Giá xe <br/> <strong class="text-danger">{{number_format($row->xe->giaBan)}}</strong>
                            </div>
                        </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('local_script')
@endsection