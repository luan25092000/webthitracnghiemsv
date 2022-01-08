@extends('page.layouts.template')

@section('css')
<!-- Css for this page -->
<link rel="stylesheet" type="text/css" href="{{ asset('page/css/subject.css') }}">
@stop

@section('main')
<div class="container">
    <div class="main col-8 mb-5">
        <h1>Chi tiết bài thi</h1>
        <p class="subject-title"><span style="width: 80px;display: inline-block">Đề thi: </span><b>{{ $detail->subject->name }}</b></p>
        <p class="sinvien-fullname"><span style="width: 80px;display: inline-block">Sinh viên: </span><b>{{ $detail->student->name }}</b></p>
    </div>
    <div class="row">
        <div class="col-8" style="margin-bottom: 100px">
            @if(!empty($detail))
                <form action="">
                    @foreach ($detail->questions as $key => $question)
                    <div class="quiz-question">
                        <div class="quiz-question-title">
                            <h2>
                                <span>{{ $key+1 }}</span>
                                <div>{{ $question->name }}</div>
                            </h2>
                        </div>
                        @foreach ($question->answers as $answer)
                            <div class="quiz-question-answer">
                            @if(isset($question->pivot->selected))
                                <div class="answer-radio">
                                    @if ($question->is_multiple)
                                    <?php $selected = explode(',', $question->pivot->selected); ?>
                                        <input class="form-check-input answer-checkbox"
                                            type="checkbox"
                                            <?= (in_array($answer->id, $selected)) ? 'checked' : '' ?>
                                            name="option-<?= $answer->id ?>"
                                            value="<?= $question->id ?>-<?= $answer->id ?>" />
                                    @else
                                        <input type="radio"
                                            name="option-<?= $question->id ?>"
                                                <?= ($question->pivot->selected == $answer->id) ? 'checked' : '' ?>
                                            value="<?= $question->id ?>-<?= $answer->id ?>" />
                                   @endif
                                    <label for="question-1">
                                        <?= $answer->description ?>
                                        @if ($answer->is_correct)
                                        <i class="fa fa-check" aria-hidden="true"></i>
                                        @endif
                                    </label>
                                </div>
                           @else
                                <div class="answer-radio">
                                    @if ($question->is_multiple)
                                        <input class="form-check-input answer-checkbox"
                                            type="checkbox"
                                            name="option-<?= $answer->answer_id ?>"
                                            value="<?= $question->id ?>-<?= $answer->id ?>" />
                                   @else
                                        <input type="radio"
                                            name="option-<?= $detail['question_id']; ?>"
                                            value="<?= $question->id ?>-<?= $answer->id ?>" />
                                    @endif
                                    <label for="question-1">
                                        <?= $answer->description ?>
                                        @if ($answer->is_correct)
                                        <i class="fa fa-check" aria-hidden="true"></i>
                                        @endif
                                    </label>
                                </div>
                            @endif
                            </div>
                        @endforeach
                           
                    </div>
                    @endforeach
                </form>
            @else
                <div>Bài làm bỏ trắng</div>
            @endif
        </div>
        <div class="col-4">
            <h3 class="another-theme">Chủ đề</h3>
            @foreach ($themes as $theme)
                <div class="col-12 another-theme-item">
                    <div class="card">
                        <div class="cart-custom">
                            <div class="card-body">
                                <h5 class="card-title">{{ $theme->name }}</h5>
                            </div>
                            <div class="test-number">
                                <h5>{{ $theme->subjects_count }}</h5>
                                <small>đề thi</small>
                            </div>
                        </div>
                        <a href="{{ route('theme.show',['theme' => $theme->id]) }}" class="btn btn-detail">
                            <i class="fa fa-chevron-circle-right"></i>
                            Xem chi tiết
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="row">
        <div class="col-12 another-test">
            <h3 class="another-test-title">Đề thi có liên quan</h3>
            @foreach ($anotherExamps as $key => $exam)
                <article class="article article-quizz">
                    <div class="quizz-details">
                        <div class="info-cards">
                            <div class="info-card">
                                <div class="info-type"><i class="fa fa-question"></i> <span>QUESTIONS</span></div>
                                <div class="info-value"><h4>{{ $exam->question_count }}</h4></div>
                            </div>
                            <div class="info-card">
                                <div class="info-type"><i class="fas fa-level-up-alt"></i> <span>LEVEL</span></div>
                                <div class="info-value"><h4>{{ $exam->level }}</h4></div>
                            </div>
                        </div>
                    </div>
                    <div class="quizz-description">
                        <h2>
                            <a href="#">
                                <span class="quizz-id">{{ $key+1 }}</span>
                                {{ $exam->name }}
                            </a>
                        </h2>
                        <p class="quiz-excerpt">{{ $exam->description }}</p>
                        <div class="quizz-buttons">
                            <a href="{{ route('test.vertify',['subject' => $exam->id]) }}" class="btn btn-secondary"">
                            <i class="fa fa-chevron-circle-right"></i>
                            Làm bài thi
                            </a>
                        </div>
                    </div>
                </article>
                @endforeach
        </div>
    </div>
</div>
@stop