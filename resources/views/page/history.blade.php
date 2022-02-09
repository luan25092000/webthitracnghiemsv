@extends('page.layouts.template')

@section('css')
<!-- Css for this page -->
<link rel="stylesheet" type="text/css" href="{{ asset('page/css/history.css') }}">
<style>
td {
    padding:30px 0px !important;
}
</style>
@stop

@section('main')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <section class="ftco-section">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-6 text-center mb-5">
                                <h2 class="heading-section">
                                    Các lần thi của thí sinh<br><b>{{ Auth::user()->name }}</b>
                                </h2>
                            </div>
                            @if (count($records))
                            <div class="col-md-6 text-center mb-5">
                                <h2 class="heading-section">
                                    Kết quả lần thi gần nhất<br>
                                    <b style="color: #f8bd32;font-size: 50px;">
                                        {{ $records[count($records)-1]->result }}
                                    </b>
                                </h2>
                            </div>
                            @endif                           
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-wrap">
                                    <table class="table">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>#</th>
                                                <th>Đề thi</th>
                                                <th>Lớp</th>
                                                <th>Level</th>
                                                <th style="width:30px;">Số câu đúng/Tổng số câu</th>
                                                <th>Điểm thi</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (!count($records))
                                                <tr class="alert" role="alert">
                                                    <td colspan="7">Bạn chưa thi lần nào</td>
                                                </tr>
                                            @else
                                                @foreach ($records as $key => $record)
                                                <?php
                                                    $item = explode("/", $record->result);
                                                    $score = $item[0]*(10/$item[1]);
                                                ?>
                                                <tr class="alert" role="alert">
                                                    <td>{{ $key+1 }}</td>
                                                    <td>{{ $record->subject->name }}</td>
                                                    <td>{{ $record->subject->theme->name }}</td>
                                                    <td>{{ $levels[$record->subject->level] }}</td>
                                                    <td>{{ $record->result }}</td>
                                                    <td><?= number_format($score, 2, '.', '') ?>/10</td>
                                                    <td>
                                                        <a href="{{ route('test.detail',['id' => $record->id]) }}" class="test-detail" style="color: #fff">Xem chi tiết</a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@stop