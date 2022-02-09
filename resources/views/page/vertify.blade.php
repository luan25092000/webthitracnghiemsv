@extends('page.layouts.template')

@section('css')
<!-- Css for this page -->
<link rel="stylesheet" type="text/css" href="{{ asset('page/css/index.css') }}">
@stop

@section('main')

<div class="container">
    <div class="container d-flex justify-content-center align-content-center" style="margin-top:8rem;margin-bottom:12.67rem;">
        <div class="row gutters">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                @if (Session::has('invalid'))           
                    <div class="alert alert-danger" style="margin:0 auto">
                    <strong>{{ Session::get('invalid') }}</strong>
                    </div>
                @elseif (Session::has('danger'))           
                <div class="alert alert-danger" style="margin:0 20%  0 ">
                    <strong>{{ Session::get('danger') }}</strong>
                </div>
                @endif  
                <div class="h-100">
                    <h3>Đăng nhập vào phần bài làm</h3>
                    <form method="POST" action="{{ route('test.create') }}">
                        @csrf
                        <input type="hidden" name="id" value="{{ $data->id }}" />
                        <div class="form-group">
                            <label for="pass">Nhập mật khẩu</label>
                            <input class="form-control" type="password" name="pass" id="pass" required />
                        </div>
                        <input type="submit" name="submit" value="Đăng nhập" class="btn btn-primary mt-3" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop