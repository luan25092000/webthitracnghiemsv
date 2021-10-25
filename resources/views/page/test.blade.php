<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Test Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('page/test.css') }}">
</head>
<body>
    <div class="container">
        <div id="game" class="justify-center flex-column game">
            <div id="hud">
                <div class="hud-item">
                    <p id="progressText" class="hud-prefix">
                        Câu hỏi thứ 1 of 4
                    </p>
                    <div id="progressBar">
                        <div id="progressBarFull"></div>
                    </div>
                </div>
                <div class="hud-item">
                    <p class="hud-prefix">
                        Thời gian làm bài
                    </p>
                    <h1 class="hud-main-text" id="time"></h1>
                </div>
            </div>
            <h1 id="question" class="text-center">TC co may ngoi?</h1>
            <h4 id="question_note" class="text-center" ></h4>
            <div class="ans ">
                <div class="row">
                    <div class="col">
                        <div class="choice-container" style="margin-right:0!important">
                            <p class="choice-prefix">A.</p>
                            <p class="choice-text" data-value="2" data-number="1">Choice</p>
                        </div>
                    </div>
                    <div class="col">
                        <div class="choice-container" style="margin-left:0!important">
                            <p class="choice-prefix">B.</p>
                            <p class="choice-text" data-value="2" data-number="2">Choice</p>
                        </div>
                    </div>
                    <div class="w-100"></div>
                    <div class="col">
                        <div class="choice-container" style="margin-right:0!important">
                            <p class="choice-prefix">C.</p>
                            <p class="choice-text" data-value="2" data-number="3">Choice</p>
                        </div>
                    </div>
                    <div class="col">
                        <div class="choice-container" style="margin-left:0!important">
                            <p class="choice-prefix">D.</p>
                            <p class="choice-text" data-value="2" data-number="4">Choice</p>
                        </div>
                    </div>
                  </div>
                
                
                
                
            </div>
            <div class="nav">
                <button class="back_btn">Back Que</button>
                <button class="next_btn">Next Que</button>
            </div>
        </div>
        <form action="{{ route('test.store') }}" id="request-form" method="POST">
            @csrf
            <input type="hidden" value="" name="result" id="request-input" />
            <input type="hidden" value="{{ $subject_id }}" name="subject_id"  />
        </form>
   
            <div class="result_box">
                <div class="icon">
                    <h2>Chúc mừng bạn đã hoàn thành bài thi!!</h2>
                </div>
                <div class="container-fluid" style="color: ">
                    <h2>Thí sinh : Demo</h2>
                    <div class="detail_text">
                        <span>Số lượng đúng: 10/10</span>
                    </div>
                    <div class="complete_text text-center">Điểm của bạn:
                        <div class="score_text">
                            10
                        </div>
                    </div>
                    <div class="buttons flex-column">
                        <button class="restart">Replay Quiz</button>
                        <button class="quit">Quit Quiz</button>
                    </div>
                </div>
                
            </div>
        </div>
    
    
<script >
    let questions = <?= $questions ?>;
</script>
<script src="{{ asset('page/test.js') }}"></script>
<script src="{{ asset('page/countdown.js') }}"></script>


</body>
</html>