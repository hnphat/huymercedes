<div id="sanPham" class="container hyundai-headFont">
    <h3>SẢN PHẨM KINH DOANH</h3><br/>
    <div class="row text-center">
        @foreach($xe as $row)
            <div class="col-xs shadow_box">
                <div>
                    <a href="./san-pham/{{$row->xe->tin->slugName}}"><img src="{{asset('upload/xe/' . $row->xe->hinhAnh)}}" alt="{{$row->xe->name}}"></a>
                    <h5><a href="./san-pham/{{$row->xe->tin->slugName}}">{{$row->xe->name}}</a></h5> 
                    <h4 class="giaXe">{{number_format($row->xe->giaBan)}}đ</h4>
                </div>            
            </div>
        @endforeach
    </div>
</div>
<br/>