<div class="container-fluid" id="header">
    <div class="row">
        <div class="col-md-6 text-left">
            <img id="logoleft" src="{{asset('')}}/images/header/logoleft.png" alt="Logo left">
        </div>
        <div class="col-md-6 text-right">
            <img id="logoright" src="{{asset('')}}/images/header/logoright.png" width="300" height="auto" alt="Logo right">
        </div>
    </div>
</div>


<div class="container" id="menu">
    <nav class="navbar navbar-expand-md">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="fa fa-align-justify"></span>
        </button>
        <div class="navbar-brand hyundai-headFont text-left" id="navformobile">
                <img id="logohyundai" src="{{asset('')}}/images/header/logohyundai.png" alt="Logo hyundai">
                <img id="logohyundaiag" src="{{asset('')}}/images/header/logoright.png" width="300" height="auto" alt="Logo Hyundai An Giang">
        </div>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav hyundai-headFont">
            <li class="nav-item">
                <a class="nav-link" href="./">TRANG CHỦ</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="sanPham" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                SẢN PHẨM
                </a>
                <div class="dropdown-menu" aria-labelledby="sanPham">
                    <div id="navcarbox">
                        @foreach($xe as $row)
                        <div class="boxcar">
                            <a href="./san-pham/{{$row->xe->tin->slugName}}">
                                <p class="text-center">
                                    <img class="carimage" src="{{asset('upload/xe/' . $row->xe->hinhAnh)}}" alt="{{$row->xe->name}}">
                                    <br/>{{$row->xe->name}}
                                </p>
                            </a>
                        </div>
                        @endforeach
                    </div>                
                    <!-- <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Something else here</a> -->
                </div>
            </li>
            @foreach($menu as $row)
                @if($row->isShow)
                    @if($row->hasSubMenu)
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="itemChonsen" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{$row->name}}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="itemChonsen">   
                            @foreach($row->submenu as $rowsub)
                                @if($rowsub->isShow)
                                    <a class="dropdown-item" href="{{$rowsub->isBaiViet ? './tin-tuc/'.$rowsub->tin->slugName : $rowsub->link}}">{{$rowsub->name}}</a>
                                @endif
                            @endforeach
                        </div>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{$row->link}}"> {{$row->name}} </a>
                    </li>
                    @endif
                @endif
            @endforeach
            </ul>
        </div>
    </nav>
</div>
