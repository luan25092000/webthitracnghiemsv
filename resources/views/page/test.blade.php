<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Test Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="{{ asset('page/css/test.css') }}">
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
            <div class="d-flex justify-content-center file" id="file">
                {{-- <img id="myImg" src="{{ asset('uploads/image/1635740165-image.jpg') }}" >
                <video id='myVi' src="{{ asset('uploads/video/1635740165-video.mp4') }}"controls></video> --}}
            </div>
            
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
                <button class="back_btn">Back</button>
                <button class="next_btn">Next</button>
                <button class="submit_btn" onclick="endGame()">Submit</button>
            </div>
        </div> 
        <div id="box-result-container">  
            @include('page.includes.box')
        </div>
        </div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script >
    let questions = <?= $questions ?>;
    let time = <?= $time ?>;
    let subject_id = <?= $subject_id ?>;
</script>
<script src="{{ asset('page/js/countdown.js') }}"></script>
<script src="{{ asset('page/js/result.js') }}"></script>
<script src="{{ asset('page/js/test.js') }}"></script>



</body>
</html>