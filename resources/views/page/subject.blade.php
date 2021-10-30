@extends('page.layouts.template')

@section('css')
<!-- Css for this page -->
<link rel="stylesheet" type="text/css" href="{{ asset('page/css/subject.css') }}">
@stop

@section('main')

<div class="container">
    <div class="main">
        <h1>{{ $title }}</h1>
    </div>
    <div class="row">
        <div class="col-md-12">
            @foreach ($datas as $key=>$data)
                <article class="article article-quizz">
                    <div class="quizz-details">
                        <div class="info-cards">
                            <div class="info-card">
                                <div class="info-type"><i class="fa fa-question"></i> <span>QUESTIONS</span></div>
                                <div class="info-value"><h4>{{ $data->question_count }}</h4></div>
                            </div>
                            <div class="info-card">
                                <div class="info-type"><i class="fas fa-level-up-alt"></i> <span>LEVEL</span></div>
                                <div class="info-value"><h4>{{ $data->level }}</h4></div>
                            </div>
                        </div>
                    </div>
                    <div class="quizz-description">
                        <h2>
                            <a href="">
                                <span class="quizz-id">{{ $key+1 }}</span>
                                {{ $data->name }}
                            </a>
                        </h2>
                        <p class="quiz-excerpt">{{ $data->description }}</p>
                        <div class="quizz-buttons">
                            <a href="{{ route('test.vertify',['subject' => $data->id]) }}" class="btn btn-secondary"">
                            <i class="fa fa-chevron-circle-right"></i>
                            Làm bài thi
                            </a>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
    
    {{-- <?php elseif($data['count_page'] <= 0): ?>
        <div class="jumbotron">
            <p style="text-align:center;">Hiện tại chưa có bài thi nào</p>
        </div>
    <?php endif; ?> --}}
</div>



@stop