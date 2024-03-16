
<div id="slider" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ul class="carousel-indicators">
    <?php $i = 0; ?>
    @foreach($slider as $row)
      <li data-target="#hagiSlider" data-slide-to="{{$i}}" 
      @if($i == 0)
      class="active"
      @endif></li>
      <?php $i++; ?>
    @endforeach
  </ul>
  
  <!-- The slideshow -->
  <div class="carousel-inner">
    <?php $j = 0; ?>
    @foreach($slider as $row)
      <div 
      @if($j == 0)
        class="carousel-item active"
      @else
        class="carousel-item"
      @endif>
      @if ($row->isCar == 0)
        <a href="{{'./tin-tuc/'.$row->tinTuc->slugName}}"><img src="{{asset('upload/slider/' . $row->image)}}" alt="{{$row->name}}"></a>
      @else
        <a href="{{'./san-pham/'.$row->tinXe->slugName}}"><img src="{{asset('upload/slider/' . $row->image)}}" alt="{{$row->name}}"></a>
      @endif
      </div>
      <?php $j++; ?>
    @endforeach
  </div>
  
  <!-- Left and right controls -->
  <a class="carousel-control-prev" href="#slider" data-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </a>
  <a class="carousel-control-next" href="#slider" data-slide="next">
    <span class="carousel-control-next-icon"></span>
  </a>
</div>
<br/>