const detail_text = document.querySelector('.detail_text');
const score_text = document.querySelector('.score_text');


endGame = () => {
    game.classList.remove('activeGame')
    result.classList.add('activeResult')
    // document.getElementById("myForm").submit();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'POST',
        url: '/test',
        data: {
            'result': selectedAnswer,
            'subject_id': subject_id
        },
        dataType: 'json',
        success: function (data) {
            detail_text.firstElementChild.innerText = 'Số lượng đúng: ' + data.result;
            score_text.innerText = Math.round((data.score / data.count) * 10 * 100) / 100;
        },
        error: function(data) {
            var errors = $.parseJSON(data.responseText);
        }
    });
}