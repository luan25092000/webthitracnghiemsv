$('#room').change(function () {
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
    var room_id = $('#room').find(':selected').val();
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
            'room_id': room_id,
            'subject_id': subject_id
        },
        dataType: 'json',
        success: function (data) {
            var $subject = $('#example');
            var html = '<thead>\n'+
                            '<tr>\n'+
                                '<th>Tên</th>\n'+
                                '<th>Điểm</th>\n'+
                                '<th>Xếp hạng</th>\n'+
                                '<th>Action</th>\n'+
                            '</tr>\n'+  
                        '</thead>\n'+
                        '<tbody>';
            for (var i = 0; i < data.length; i++) {
                var rank = i+1;
                var result = data[i].result.split("/")
                var score = result[0]*(10/result[1]);
                html += '<tr>\n'+
                            '<td>'+ data[i].student.name + '</td>\n'+
                            '<td>'+ score + '/10</td>\n'+
                            '<td>'+ rank + '</td>\n'+
                            '<td><a href="/ad/profile" class="btn btn-outline-info btn-icon-text"><i class="ti-printer btn-icon-append"></i> Print</a></td>\n'+
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
