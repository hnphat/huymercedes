<div id="tinTuc" class="container hyundai-normalfont">
    <h3 class="hyundai-headFont">TIN TỨC KHUYẾN MÃI</h3><br/>
    <div class="row text-justify">
        @foreach($tinKM as $row)
            <div class="col-xs tinTucShadow">
                <div>
                    <a href="./tin-tuc/{{$row->slugName}}"><img src="{{asset('upload/tintuc/' . $row->hinhAnh)}}" alt="{{$row->slugName}}"></a>
                    <div class="tinTucTilte">
                    <a href="./tin-tuc/{{$row->slugName}}"><h5 class="hyundai-headFont">{{$row->name}}</h5></a>
                        <p>{{$row->moTa}}</p>
                    </div>
                </div>            
            </div>
        @endforeach
    </div>
</div>
<br/>
<div id="tinTuc" class="container hyundai-normalfont">
    <h3 class="hyundai-headFont">TIN HYUNDAI AN GIANG</h3><br/>
    <div class="row text-justify">
        @foreach($tinHAGI as $row)           
            <div class="col-xs tinTucShadow">
                <div>
                    <a href="./tin-tuc/{{$row->slugName}}"><img src="{{asset('upload/tintuc/' . $row->hinhAnh)}}" alt="{{$row->slugName}}"></a>
                    <div class="tinTucTilte">
                        <a href="./tin-tuc/{{$row->slugName}}"><h5 class="hyundai-headFont">{{$row->name}}</h5></a>
                        <p>{{$row->moTa}}</p>
                    </div>
                </div>            
            </div>
        @endforeach
    </div>
</div>
<br/>
<div id="tinTucKhac" class="container hyundai-normalfont">
    <h3 class="hyundai-headFont">TIN TỨC VÀ CHIA SẼ KINH NGHIỆM</h3><br/>
    <div class="row text-justify">
        <div class="col-xs" id="tinTucKhacPanel"> 
        @foreach($tinCS as $row) 
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