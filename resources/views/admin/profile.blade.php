<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('admin/css/profile.css') }}">
</head>
<body>
    <div class="container">
        <div class="main">
            <div class="topbar">
            </div>
            <div class="row">
                <div class="col-md-4 mt-1">
                    <div class="card text-center sidebar">
                        <div class="card-body">
                            <img src="{{ asset('admin/images/avatar.svg') }}" alt="" class="rounded-circle" width="150">
                            <div class="mt-3">
                                <h3>Burk Macklin</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 mt-1">
                    <div class="card mb-3 content">
                        <h1 class="m-3 pt-3">about</h1>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <h5>Tên</h5>
                                </div>
                                <div class="col-md-9 text-secondary">
                                    {{ $result->student->name }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-3">
                                    <h5>Email</h5>
                                </div>
                                <div class="col-md-9 text-secondary">
                                    {{ $result->student->email }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-3">
                                    <h5>Số điện thoại</h5>
                                </div>
                                <div class="col-md-9 text-secondary">
                                    {{ $result->student->phone }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-3">
                                    <h5>Ngày sinh</h5>
                                </div>
                                <div class="col-md-9 text-secondary">
                                    {{ $result->student->birthday }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-3 content">
                        <h1 class="m-3">Đề thi</h1>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <h5>{{ $result->subject->name }}</h5>
                                </div>
                                <div class="col-md-9 text-secondary">
                                    {{ $result->subject->description }}
                                </div>
                            </div>
                            <?php
                                $item = explode("/",$result->result);
                                $score = $item[0] * (10/$item[1]);
                            ?>
                            <div class="row">
                                <div class="col-md-3">
                                    <h5>Điểm thi</h5>
                                </div>
                                <div class="col-md-9 text-secondary">
                                    {{ number_format($score, 2, '.', '') }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <h5>Xếp hạng</h5>
                                </div>
                                <div class="col-md-9 text-secondary">
                                    {{ $rank }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
            <button onclick="history.back()" id="printPageButton" class="btn btn-info">Quay lại</button>
            <button onclick="window.print()" id="printPageButton" class="btn btn-info">Print</button>
        
    </div>
</body>
</html>
