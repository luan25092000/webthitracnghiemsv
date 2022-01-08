const question = document.querySelector('#question');
const question_note = document.querySelector('#question_note');
const choices = Array.from(document.querySelectorAll('.choice-text'));
const progressText = document.querySelector('#progressText');
const scoreText = document.querySelector('#score');
const progressBarFull = document.querySelector('#progressBarFull');
const back_btn = document.querySelector(".nav .back_btn");
const next_btn = document.querySelector(".nav .next_btn");
const game = document.querySelector(".game");
const result = document.querySelector(".result_box");
const src = document.getElementById("file");

let currentQuestion = {}
let acceptingAnswers = true
let acceptingChanges = false
let score = 0
let questionCounter = 0
let questionNow = 0
let availableQuestions = []
let selectedAnswer = ''
let is_multi = false
let is_last = false

const SCORE_POINTS = 100
const MAX_QUESTIONS = questions.length

startGame = () => {
    questionCounter = 0
    availableQuestions = [...questions]
    game.classList.add('activeGame')
    getNewQuestion()
}

back_btn.addEventListener('click', e => {
    questionNow--
    progressText.innerText = `Question ${questionNow+1} of ${MAX_QUESTIONS}`
    progressBarFull.style.width = `${(questionNow+1/MAX_QUESTIONS) * 100}%`

    currentQuestion = questions[questionNow]
    question.innerText = currentQuestion[0].question
    deleteChild()
    if ( currentQuestion[0].image) {
        var img = document.createElement("img");
        img.src = window.location.origin + "/uploads/image/"+ currentQuestion[0].image;
       
        src.appendChild(img);
    }
    if ( currentQuestion[0].video) {
        var obj, source;

        obj = document.createElement('video');
        $(obj).attr('controls', ' ');
        $(obj).attr('preload', 'auto');

        source = document.createElement('source');
        $(source).attr('type', 'video/mp4');
        $(source).attr('src', window.location.origin + "/uploads/video/"+ currentQuestion[0].video);

        src.append(obj);
        $(obj).append(source);
    }
   

    if (currentQuestion[0].is_multi) {
        question_note.innerText = '( Có thể chọn nhiều đáp án )'
        is_multi = true
    } else {
        question_note.innerText = ''
        is_multi = false
    }
   
    if(questionCounter > questionNow) {       
        next_btn.classList.add("show") 
        questionNow < 1 ? back_btn.classList.remove("show") : back_btn.classList.add("show")
    }
    choices.forEach(choice => {
        const number = choice.dataset['number']
        const value = `${currentQuestion[0].question_id}` + `-` + `${currentQuestion[number].answer_id}`
        choice.dataset['value'] = value
        choice.innerText = currentQuestion[number].answer
        if(selectedAnswer.indexOf(value) != -1) {
            choice.parentElement.classList.add('correct')
        } else {
            choice.parentElement.classList.remove('correct')
        }
        acceptingChanges = true 
    })
})

next_btn.addEventListener('click', e => {
    if(questionCounter = questionNow +1) {
        acceptingChanges = false
        is_last = true
        getNewQuestion()
    } else {
        nextStep()
    }
})

nextStep = () => {
    
    questionNow++
    progressText.innerText = `Question ${questionNow+1} of ${MAX_QUESTIONS}`
    progressBarFull.style.width = `${(questionNow+1/MAX_QUESTIONS) * 100}%`
    
    currentQuestion = questions[questionNow]
    question.innerText = currentQuestion[0].question
    deleteChild()
    if ( currentQuestion[0].image) {
        var img = document.createElement("img");
        img.src = window.location.origin + "/uploads/image/"+ currentQuestion[0].image;
       
        src.appendChild(img);
    }
    if ( currentQuestion[0].video) {
        var obj, source;

        obj = document.createElement('video');
        $(obj).attr('controls', ' ');
        $(obj).attr('preload', 'auto');

        source = document.createElement('source');
        $(source).attr('type', 'video/mp4');
        $(source).attr('src', window.location.origin + "/uploads/video/"+ currentQuestion[0].video);

        src.append(obj);
        $(obj).append(source);
    }

    if (currentQuestion[0].is_multi) {
        question_note.innerText = '( Có thể chọn nhiều đáp án )'
        is_multi = true
    } else {
        question_note.innerText = ''
        is_multi = false
    }

    back_btn.classList.add("show")
    if(questionCounter > questionNow+1 ) {
        acceptingChanges = true  
    } else {
        acceptingChanges = false,  
        next_btn.classList.remove("show") 
    }
    choices.forEach(choice => {
        const number = choice.dataset['number']
        const value = `${currentQuestion[0].question_id}` + `-` + `${currentQuestion[number].answer_id}`
        choice.dataset['value'] = value
        choice.innerText = currentQuestion[number].answer
        if(selectedAnswer.indexOf(value) != -1) {
            choice.parentElement.classList.add('correct')
        } else {
            choice.parentElement.classList.remove('correct')
        }
       
    })
}

getNewQuestion = () => {
    if( questionCounter >= MAX_QUESTIONS) {
        endGame()
    }
    questionNow = questionCounter
    questionCounter++
   
    
    progressText.innerText = `Question ${questionCounter} of ${MAX_QUESTIONS}`
    progressBarFull.style.width = `${(questionCounter/MAX_QUESTIONS) * 100}%`

    const questionsIndex = Math.floor(Math.random() * availableQuestions.length)
    
    currentQuestion = questions[questionNow]
    question.innerText = currentQuestion[0].question
    deleteChild()
    if ( currentQuestion[0].image) {
        var img = document.createElement("img");
        img.src = window.location.origin + "/uploads/image/"+ currentQuestion[0].image;
       
        src.appendChild(img);
    }
    if ( currentQuestion[0].video) {
        var obj, source;

        obj = document.createElement('video');
        $(obj).attr('controls', ' ');
        $(obj).attr('preload', 'auto');

        source = document.createElement('source');
        $(source).attr('type', 'video/mp4');
        $(source).attr('src', window.location.origin + "/uploads/video/"+ currentQuestion[0].video);

        src.append(obj);
        $(obj).append(source);
    }

    if (currentQuestion[0].is_multi) {
        question_note.innerText = '( Có thể chọn nhiều đáp án )'
        is_multi = true
    } else {
        question_note.innerText = ''
        is_multi = false
    }
    

    if(questionCounter > 1) {        
        back_btn.classList.add("show")
    }

    choices.forEach(choice => {
        choice.parentElement.classList.remove('correct')
        const number = choice.dataset['number']
        const value = `${currentQuestion[0].question_id}` + `-` + `${currentQuestion[number].answer_id}`
        choice.dataset['value'] = `${currentQuestion[0].question_id}` + `-` + `${currentQuestion[number].answer_id}`
        choice.innerText = currentQuestion[number].answer
        if(is_last && selectedAnswer.indexOf(value) != -1 ) {
            choice.parentElement.classList.add('correct')
        } else {
            choice.parentElement.classList.remove('correct')
        }
    })
    
    availableQuestions.splice(questionsIndex, 1)

    acceptingAnswers = true
}

choices.forEach(choice => {
    
    choice.addEventListener('click', e => {
        let classToApply = 'correct'
        const selectedChoice = e.target
        let valueOfChoice = selectedChoice.dataset['value']

        if(is_multi){
            if (selectedAnswer.indexOf(valueOfChoice) != -1) {
                selectedAnswer = selectedAnswer.replace(`${selectedChoice.dataset['value']},`, '')
                selectedChoice.parentElement.classList.remove(classToApply)
            } else {
                selectedAnswer += valueOfChoice + ','
                selectedChoice.parentElement.classList.add(classToApply)
            }
            setTimeout( () => {
                next_btn.classList.add("show")
            }, 1000)
        } else if(acceptingChanges) {
            let getEle = document.getElementsByClassName("choice-container correct")[0]
            selectedAnswer = selectedAnswer.replace(getEle.lastElementChild.dataset['value'], valueOfChoice)
            getEle.classList.remove(classToApply)
            selectedChoice.parentElement.classList.add(classToApply)
            acceptingChanges = false
            setTimeout( () => {
                nextStep()
            }, 1000)

        } else {
            if(!acceptingAnswers) return

            acceptingAnswers = true
            selectedAnswer += valueOfChoice + ','
            
            selectedChoice.parentElement.classList.add(classToApply)
            
            setTimeout( () => {
                selectedChoice.parentElement.classList.remove(classToApply)
                getNewQuestion()
            }, 500)
        }
    })
})

deleteChild = () => {
    var child = src.lastElementChild; 
    while (child) {
        src.removeChild(child);
        child = src.lastElementChild;
    }
}

startGame()
