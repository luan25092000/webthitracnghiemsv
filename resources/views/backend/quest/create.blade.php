@extends('layouts.admin')

@section('css')
  
   <!-- Plugin css for this page -->
   <link rel="stylesheet"  href="{{ asset('backend') }}/vendors/select2/select2.min.css">
   <link rel="stylesheet"  href="{{ asset('backend') }}/vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
   <!-- End plugin css for this page -->
 
@stop

@section('title')
    <h4 class="card-title">Câu hỏi</h4>
    <p class="card-description">
        ---------- <code>Thêm mới</code>
      </p>
@stop

@section('main')
<form action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="name">Nội dung câu hỏi:</label>
        <textarea class="form-control" style="height:auto" name="name" placeholder="Nhập nội dung câu hỏi"  required rows="4"></textarea>
    </div>
    <div class="form-group">
        <label for="file_img">Ảnh câu hỏi (không bắt buộc)</label>
        <br>
        <input type="file"  name="file_img" accept="image/x-png,image/gif,image/jpeg,image/jpg" />
    </div>
    <div class="form-group">
        <label for="file_vid">Video câu hỏi (không bắt buộc)</label>
        <br>
        <input type="file"  name="file_vid" accept="video/mp4" />
    </div>
    <div class="form-group">
        <label for="exampleFormControlSelect2">Cấp độ</label>
        <select class="form-control" id="exampleFormControlSelect2"  required>
            <option>Vui lòng chọn cấp độ</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
        </select>
    </div>
    <div class="form-group">
        <label class="col-sm-3 col-form-label">Câu hỏi này có nhiều đáp án đúng?</label>
        <div class="row">
            <div class="col-sm-1">
                <div class="form-check" >
                    <label class="form-check-label">
                      <input type="radio"  class="form-check-input" name="is_multiple" id="membershipRadios1" value="1" >
                      Có
                    </label>
                </div>
            </div>
            <div class="col-sm-1">
                <div class="form-check" >
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="is_multiple" id="membershipRadios1" value="0" checked>
                        Không
                    </label>
                </div>
            </div>
        </div>
    </div>
    <div id="form-sum" style="display: none" class="form-group">
        <div class="row">
            <div class="col-sm-8">
                <label class="" for="">Đáp án</label>
            </div>
            <div class="col-sm-2 text-center">
                <label class="" for="">Đáp án đúng</label>
            </div>
            <div class="col-sm-2 text-center">
                <label class="" for="">Xóa</label>
            </div>
        </div>
        <div class="row" id="form-summary">
            <div class="row form-answer" data-count="1">
                <div class="col-sm-8">
                    <textarea class="form-control"
                            rows="2"
                            style="height: auto; margin-bottom:2%"
                            placeholder="Nhập đáp án"
                            name="answer[1][]"
                            required
                            maxlength="255">
                    </textarea>
                </div>
                <div class="col-sm-2 text-center">
                    <input class="form-check-input" type="checkbox" name="is_correct[1][]" style="cursor: pointer">
                </div>
                <div class="col-sm-2 text-center answer-remove" data-count="1">
                    <i class="mdi mdi-close-circle-outline" style="font-size:23px;cursor:pointer;"></i>
                </div>
            </div>
        </div>
        <div style="margin-top: 20px;">
            <a href="javascript: void(0)"
               style="border-radius: 5px; border: 1px solid #288ad6; padding: 10px 20px; text-decoration: none;"
               id="add-answer">Thêm đáp án</a>
        </div>
    </div>
    
    <button type="submit" class="btn btn-primary me-2">Submit</button>
   
  </form>
  
@stop

@section('js')

 <!-- Plugin js for this page -->
 <script src="{{asset('backend')}}/vendors/typeahead.js/typeahead.bundle.min.js"></script>
 <script src="{{asset('backend')}}/vendors/select2/select2.min.js"></script>
 <script src="{{asset('backend')}}/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
 <script>
    $(document).ready(function() {
        $('#membershipRadios1').on('change', function () {
            var value = $(this).val();
            if (value) {
                $('#form-sum').show();
            } else {
                $('#form-sum').hide();
            }
        });
        $('body').on('click', '.answer-remove', function () {
        var item = $(this).attr('data-count');
            var sum = $('.form-answer').length;
            if (sum > 1) {
                $('.form-answer[data-count="'+item+'"]').remove();
            }
        });
        $('#add-answer').on('click', function () {
        var sum = $('.form-answer').length;
                if ((Number(sum) + 1) > 4) {
                    alert('Bạn chỉ được thêm 4 đáp án');
                } else {
                    var count = $('.form-answer:last-child').attr('data-count');
                    var html = '';
                    html += '<div class="row form-answer" data-count="'+(Number(count) + 1)+'">\n' +
                        '   <div class="col-sm-8">\n' +
                        '   <textarea class="form-control"\n' +
                        '   rows="2"\n' +
                        '   style="height: auto; margin-bottom:2%"\n' +
                        '   placeholder="Nhập đáp án"\n' +
                        '   name="answer['+(Number(count) + 1)+'][]"\n' +
                        '   required\n' +
                        '   maxlength="255"></textarea>\n' +
                        '   </div>\n' +
                        '   <div class="col-sm-2 text-center">\n' +
                        '   <input class="form-check-input" type="checkbox" name="is_correct['+(Number(count) + 1)+'][]" style="cursor: pointer">\n' +
                        '   </div>\n' +
                        '   <div class="col-sm-2 text-center answer-remove" data-count="'+(Number(count) + 1)+'">\n' +
                        '   <i class="mdi mdi-close-circle-outline" style="font-size:17px;cursor:pointer;color:red"></i>\n' +
                        '   </div>\n' +
                        '   </div>';
                    $('#form-summary').append(html);
            }
        });
    });
 </script>
 <!-- End plugin js for this page -->
 
 <!-- Custom js for this page-->

@stop