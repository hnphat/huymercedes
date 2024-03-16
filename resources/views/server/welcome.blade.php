@extends('layout.server.index')
@section('title')
    <title>Welcome</title>
@endsection
@section('local_css')
    
@endsection
@section('content_header')
 <!-- <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Welcome</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Welcome</li>
            </ol>
          </div>
        </div>
      </div>
  </div> -->
@endsection
@section('content')
<div class="container_fluid">
  <h1>Xin chao {{ $pass }}</h1>
</div>
@endsection
@section('local_script')
@endsection