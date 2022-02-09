$('#theme').change(function () {
    var id = $(this).find(':selected').val();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'POST',
        url: 'getdata',
        data: {
            'id': id
        },
        dataType: 'json',
        success: function (data) {
            var $subject = $('#subject');
            $subject.children().remove();
            if (data<1) $subject.append('<option >Không có đề thi nào </option>');
            
            for (var i = 0; i < data.length; i++) {
                $subject.append('<option value=' + data[i].id + '>' + data[i].name + '</option>');
            }
        },
        error: function(data) {
            var errors = $.parseJSON(data.responseText);
        }
    });
});

$("#btnShow").click(function(){
    var theme_id = $('#theme').find(':selected').val();
    var subject_id = $('#subject').find(':selected').val();
    // alert(subject_id);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'POST',
        url: 'showtable',
        data: {
            'theme_id': theme_id,
            'subject_id': subject_id
        },
        dataType: 'json',
        success: function (data) {
           
            var $subject = $('#example');
            $subject.children().remove();
            var html = '<thead>\n'+
                            '<tr>\n'+
                                '<th>Tên</th>\n'+
                                '<th>Điểm</th>\n'+
                                '<th>Xếp hạng</th>\n'+
                                '<th>Action</th>\n'+
                            '</tr>\n'+  
                        '</thead>\n'+
                        '<tbody>';
            if(data.length == 0) {
                html += '<td colspan="4" class="text-center">Chưa có bài thi nào</td>'
            }
            for (var i = 0; i < data.length; i++) {
                var rank = i+1;
                data.sort((a, b) => a.result.split("/")[0] - b.result.split("/")[0]);
                data.reverse();
                var result = data[i].result.split("/");
                var score = result[0]*(10/result[1]);
                html += '<tr>\n'+
                            '<td>'+ data[i].student.name + '</td>\n'+
                            '<td>'+ score + '/10</td>\n'+
                            '<td>'+ rank + '</td>\n'+
                            '<td><a href="/ad/profile/'+ data[i].id +'/'+ rank +'" class="btn btn-outline-info btn-icon-text"><i class="ti-printer btn-icon-append"></i> Print</a></td>\n'+
                        '</tr>\n';
            }
            html +=  '</tbody>';
            $subject.append(html);
        },
        error: function(data) {
            var errors = $.parseJSON(data.responseText);
        }
    });
});
