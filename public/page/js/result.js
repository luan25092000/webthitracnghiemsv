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
        success: function (res) {
            if (res.status == 200) {
                $("#box-result-container").html(res.data);
            }
        },
        error: function(res) {
            var errors = $.parseJSON(res.responseText);
        }
    });
}