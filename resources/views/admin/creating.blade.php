@extends('admin.layouts.template')

@section('css')
  
   <!-- Plugin css for this page -->
   <link rel="stylesheet"  href="{{ asset('admin') }}/vendors/select2/select2.min.css">
   <link rel="stylesheet"  href="{{ asset('admin') }}/vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
   <!-- End plugin css for this page -->
 
@stop

@section('title')
    <h4 class="card-title">{{ $title }}</h4>
    <p class="card-description">
        ---------- <code>{{ $descript }}</code>
      </p>
@stop

@section('main')
@if (Session::has('success'))           
    <div class="alert alert-success" style="margin:0 20%  0 ">
      <strong>{{ Session::get('success') }}</strong>
    </div>
@elseif (Session::has('danger'))           
  <div class="alert alert-danger" style="margin:0 20%  0 ">
      <strong>{{ Session::get('danger') }}</strong>
  </div>
@endif    
@if (empty($data))
<form action="{{ route('create.store',['model' => $modelName]) }}" method="POST" enctype="multipart/form-data" />
    @csrf
@else
<form action="{{ route('editing.update',['model' => $modelName, 'id' => $data->id ]) }}" method="POST" enctype="multipart/form-data" />
    @csrf @method('PUT')
@endif
    @if (!empty($configs))
        @foreach ($configs as $config)
            @switch($config['type'])
                @case("show_table")
                    <input type="hidden" name="{{ $config['field'] }}" value="<?= (!empty($dataOrther)) ? $dataOrther['value'] : ''; ?>">
                    @break
                @case("relationship") 
                    @break   
                @case("count") 
                    @break                                   
                @case("textarea")
                    <div class="form-group">
                        <label for="{{ $config['field'] }}">{{ $config['name'] }}</label>
                        <textarea class="form-control" style="height:auto" name="{{ $config['field'] }}"  placeholder="Nhập {{ strtolower($config['name']) }}"  required rows="4"><?= empty($data)? old($config['field']) : $data->{$config['field']}?></textarea>
                        @error($config['field'])
                            <small class="help-block">{{ $message }}</small>
                        @enderror
                    </div>
                    @break
                @case("file")
                    <div class="form-group">
                        <label for="file_{{ $config['field'] }}">Ảnh câu hỏi (không bắt buộc)</label>
                        <br>
                        <input type="{{ $config['type'] }}"  name="file_{{ $config['field'] }}" accept="<?=strcmp($config['field'],'image') ? 'video/mp4' :'image/x-png,image/gif,image/jpeg,image/jpg'?>" />
                    </div>
                    @break
                @case("select")
                    <div class="form-group">
                        <label for="{{ $config['field'] }}">{{ $config['name'] }}</label>
                        <select class="form-control" id="exampleFormControlSelect2" name="{{ $config['field'] }}" required>
                            <option>Vui lòng chọn {{ strtolower($config['name']) }}</option>
                            @foreach ($config['values'] as $value)
                                <option value="{{ $value['value'] }}" <?= (isset($data) && $data->{$config['field']} == $value['value']) ? 'selected' : ''; ?>>{{ $value['name'] }}</option>
                            @endforeach
                        </select>
                        @error($config['field'])
                            <small class="help-block">{{ $message }}</small>
                        @enderror
                    </div>
                    @break
                @case("select_rela")
                    <div class="form-group">
                        <label for="{{ $config['field'] }}">{{ $config['name'] }}</label>
                        <select class="form-control" id="exampleFormControlSelect2" name="{{ $config['field'] }}" required>
                            <option>Vui lòng chọn {{ strtolower($config['name']) }}</option>
                            @foreach ($config['records'] as $record)
                                <option value="{{ $record['id'] }}" <?= (isset($data) && $data->{$config['field']} == $record['id']) ? 'selected' : ''; ?> >{{ $record['name'] }}</option>
                            @endforeach
                        </select>
                        @error($config['field'])
                            <small class="help-block">{{ $message }}</small>
                        @enderror
                    </div>
                    @break
                @case("is_multiple")
                <div class="form-group">
                    <label class="col-sm-3 col-form-label">{{ $config['name'] }}</label>
                    <div class="row">
                        @foreach ($config['values'] as $value)
                            <div class="col-sm-1">
                                <div class="form-check" >
                                    <label class="form-check-label">
                                    <input type="radio"  class="form-check-input" name="{{ $config['field'] }}" id="membershipRadios1" value={{ $value['value'] }} <?= (isset($data) && $data->{$config['field']} == $value['value']) ? 'checked' : ''; ?>>
                                    {{ $value['name'] }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div id="form-sum" <?= !empty($data) ? '' : 'style="display: none"' ?> class="form-group">
                    <hr>
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
                    @if (!empty($data))
                        @for ($i = 0; $i <= count($dataOrther)-1; $i++)
                            <div class="row" id="form-summary">
                                <div class="row form-answer" data-count={{ $i }}>
                                    <div class="col-sm-8">
                                        <textarea class="form-control"
                                                rows="2"
                                                style="height: auto; margin-bottom:2%"
                                                placeholder="Nhập đáp án"
                                                name="answer[{{ $dataOrther[$i]['id'] }}][]"
                                                required
                                                maxlength="255"><?= $dataOrther[$i]['description']; ?></textarea>
                                    </div>
                                    <div class="col-sm-2 text-center form-check" style="margin-left: 100px;max-width:90px">
                                        <label class="text-center form-check-label">
                                        <input type="checkbox" class="form-check-input" <?= ($dataOrther[$i]['is_correct']=='1') ? 'checked' : '' ?> name="is_correct[{{ $dataOrther[$i]['id'] }}]"  style="cursor: pointer">
                                        </label>
                                    </div>
                                    <div class="col-sm-2 text-center answer-remove" data-count="{{ $i }}" style="margin-top: 8px;">
                                        <i class="mdi mdi-close-box-outline" style="margin-left: 55px;font-size:23px;cursor:pointer;color='red'"></i>
                                    </div>
                                </div>
                            </div>
                        @endfor
                    @else
                        <div class="row" id="form-summary">
                            <div class="row form-answer" data-count="1">
                                <div class="col-sm-8">
                                    <textarea class="form-control"
                                            rows="2"
                                            style="height: auto; margin-bottom:2%"
                                            placeholder="Nhập đáp án"
                                            name="answer[1][]"
                                            required
                                            maxlength="255"></textarea>
                                </div>
                                <div class="col-sm-2  form-check" style="margin-left: 100px;max-width:90px">
                                    <label class="text-center form-check-label">
                                    <input type="checkbox" class="form-check-input"  name="is_correct[1]" value="1" style="cursor: pointer">
                                    </label>
                                </div>
                                <div class="col-sm-2 text-center answer-remove" data-count="1" style="margin-top: 8px;">
                                    <i class="mdi mdi-close-box-outline" style="margin-left: 55px;font-size:17px;cursor:pointer;color:red"></i>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div style="margin-top: 20px;">
                        <a href="javascript: void(0)"
                           style="border-radius: 5px; border: 1px solid #288ad6; padding: 5px 10px; text-decoration: none;"
                           id="add-answer">Thêm đáp án</a>
                    </div>
                    <hr>
                </div>
                    @break
                @case("hidden")
                    <div class="form-group">
                        <input type={{ $config['type'] }} name={{ $config['field'] }} value="<?= empty($data)? $user->id : $data->{$config['field']}?>" >
                        @error($config['field'])
                            <small class="help-block">{{ $message }}</small>
                        @enderror
                    </div>
                    @break
                @case("password")
                    <div class="form-group">
                        <label for="{{ $config['field'] }}">{{ $config['name'] }}</label>
                        <input type={{ $config['type'] }} class="form-control" name={{ $config['field'] }}   placeholder="Nhập .{{ strtolower($config['name']) }}">
                        @error($config['field'])
                        <small class="help-block">{{ $message }}</small>
                        @enderror
                    </div>
                    @break
                @default
                    <div class="form-group">
                        <label for="{{ $config['field'] }}">{{ $config['name'] }}</label>
                        <input type={{ $config['type'] }} class="form-control" name={{ $config['field'] }} value="<?= empty($data)? old($config['field']) : $data->{$config['field']}?>" required placeholder="Nhập {{ strtolower($config['name']) }}">
                        @error($config['field'])
                            <small class="help-block">{{ $message }}</small>
                        @enderror
                    </div>
            @endswitch
           
        @endforeach
        <button type="submit" class="btn btn-primary me-2">Submit</button>
    @endif 
  </form>
  
@stop
@section('support')
@if ($modelName =='subject')
    @php
        foreach ($configs as $config ) {
            if($config['type'] == 'show_table') {
                $key = $config['data'];
                $configsOrt = [];
                $recordsOrt = [];
                $configsOrt = $key['configs'];
                $recordsOrt = $key['records'];
                break;
            }
        }
    @endphp
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
        <div class="card-body">
            <h4 class="card-title">Basic Table</h4>
            <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    @foreach ($configsOrt as $configOrt)
                    <th>{{ ($configOrt['name']) }}</th>
                    @endforeach
                </tr>
                </thead>
                <tbody> 
                    @foreach ($recordsOrt as $recordOrt)
                    <tr>
                      @foreach ($configsOrt as $config)
                        @switch($config['type']) 
                          @case("checkbox")
                            <td>
                                <div class="form-check">
                                    <label class="form-check-label">
                                    <input type="{{ $config['type'] }}" name="{{ $config['field'] }}"  class="form-check-input {{ $config['field'] }}" 
                                    <?= (!empty($dataOrther[$recordOrt['id']]) && $dataOrther[$recordOrt['id']] == $recordOrt['id']) ? 'checked data-checked="1"' : 'data-checked="0"'; ?>
                                     value="{{ $recordOrt['id'] }}" >
                                    </label>
                                </div>
                            </td>
                            @break
                          @case("number")
                            <td>{{ $recordOrt[$config['field']] }}</td>
                            @break
                          @case("is_multiple")
                            @foreach ($config['values'] as $value)
                              @if ($value['value']==$recordOrt[$config['field']])
                                <td>{{ $value['name']}}</td>
                              @endif
                            @endforeach
                            @break
                          @case("select")
                            @foreach ($config['values'] as $value)
                              @if ($value['value']==$recordOrt[$config['field']])
                              <td>{{ $value['name']}}</td>
                              @endif
                            @endforeach
                            @break
                          @case("action")
                            <td>
                              <a href="{{ route('editing.index',['model' => $modelName, 'id' => $recordOrt['id']]) }}" ><i class="mdi mdi mdi-rename-box"></i></a>
                              <button href=""  >
                                <i class="mdi mdi-close-box"></i>
                                </button> </td>
                            @break
                          @default
                            @if (!empty($config['relation']))
                              <td>{{ $recordOrt->{$config['relation']}->name }}</td>
                            @else
                              <td>{{ $recordOrt[$config['field']] }}</td>
                            @endif
                        @endswitch
                      @endforeach
                    </tr> 
                  @endforeach            
                </tbody>
            </table>
            </div>
        </div>
        </div>
    </div>
    </div>
@endif
@stop
@section('js')

<script src="{{asset('admin')}}/vendors/typeahead.js/typeahead.bundle.min.js"></script>
<script src="{{asset('admin')}}/vendors/select2/select2.min.js"></script>
<script src="{{asset('admin')}}/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<script>
   $(document).ready(function() {
        $('body').on('change', '#membershipRadios1', function () {
          $('#form-sum').show();
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
                        '   <div class="col-sm-2 text-center form-check" style="margin-left: 100px;max-width:90px">\n' +
                        '   <label class="form-check-label">\n' +
                        '   <input class="form-check-input" type="checkbox" name="is_correct['+(Number(count) + 1)+']" value="0" style="cursor: pointer">\n' +
                        '   <i class="input-helper"></i>\n' +
                        '   </label>\n' +
                        '   </div>\n' +
                        '   <div class="col-sm-2 text-center answer-remove" data-count="'+(Number(count) + 1)+'" style="margin-top: 8px;">\n' +
                        '   <i class="mdi mdi-close-box-outline" style="margin-left: 55px;font-size:17px;cursor:pointer;color:red"></i>\n' +
                        '   </div>\n' +
                        '   </div>';
                    $('#form-summary').append(html);
           }
       });

        var data = $('input[name="question_ids"]').val();
            $('body').on('change', '.exam_quest', function () {
                var value = $(this).val() + ',';
                var checked = $(this).attr('data-checked');

                if (checked == 0) {
                    data += value;
                    $(this).attr('data-checked', 1);
                } else {
                    $(this).attr('data-checked', 0);
                    data = data.replace(value, '');
                }
                $('input[name="question_ids"]').val(data);
            });
        });
</script>

@stop