@extends('page.layouts.template')

@section('css')
<!-- Css for this page -->
<link rel="stylesheet" type="text/css" href="{{ asset('page/css/index.css') }}">
@stop

@section('main')
<div class="s130">
    <form >
        <div class="inner-form">
            <div class="input-field first-wrap">
                <div class="svg-wrapper">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"></path>
                    </svg>
                </div>
                <input id="search" name="key" type="text" placeholder="Tìm kiếm lớp học" />
            </div>
            <div class="input-field second-wrap">
                <button class="btn-search" type="submit">TÌM KIẾM</button>
            </div>
        </div>
    </form>
</div>
<div class="container">
@if (Session::has('success'))           
    <div class="alert alert-success" style="margin:0 20%  0 ">
      <strong>{{ Session::get('success') }}</strong>
    </div>
@elseif (Session::has('danger'))           
  <div class="alert alert-danger" style="margin:0 20%  0 ">
      <strong>{{ Session::get('danger') }}</strong>
  </div>
@endif 
    <h1>Danh Sách Các Lớp Học</h1>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-3 row-cols-xl-4">
        @foreach ($datas as $data)
        <div class="col mb-4">
            <div class="card">
                <div class="cart-custom">
                    <div class="card-body">
                        <h5 class="card-title">{{ $data->name }}</h5>
                    </div>
                    <div class="test-number">
                        <h5>{{ $data->subjects_count }}</h5>
                        <small>đề thi</small>
                    </div>
                </div>
                <a href="{{ route('theme.show',['theme' => $data->id]) }}" class="btn btn-detail">
                    <i class="fa fa-chevron-circle-right"></i>
                    Xem chi tiết
                </a>
            </div>
        </div>
        @endforeach
    </div>
    {{ $datas->links() }}
</div>

@stop