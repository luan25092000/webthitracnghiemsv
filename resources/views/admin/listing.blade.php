@extends('admin.layouts.template')

@section('css')
  
    <!-- DataTables -->
  <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/dataTable.min.css') }}">  
  
  <link rel="stylesheet" type="text/css" href=" https://cdn.datatables.net/1.11.2/css/dataTables.bootstrap4.min.css">  
  <link rel="stylesheet" href="{{ asset('admin/css/style-listing.css') }}">
@stop

@section('title')
    <h4 class="card-title">{{ $title }}</h4>
    <div class="d-sm-flex home-tab align-items-center justify-content-between ">
      <p class="card-description">
        ---------- <code>Danh sách</code>
      </p>
      @if ($modelName == 'user')
      <form action="{{ route('file.import') }}" method="post" enctype="multipart/form-data">
        @csrf
        <label for="file-upload" class="custom-file-upload btn btn-primary text-white">
          <i class="icon-download"></i> Import
        </label>
        <input type="file" onchange="this.form.submit()" name="file" id="file-upload" />
        </form>
      @endif
    </div>
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
    <div class="row">   
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-striped" id="example">
            <thead>
              <tr>
                @foreach ($configs as $config)
                <th>{{ $config['name'] }}</th>
                @endforeach
              </tr>
            </thead>
            <tbody>
              @foreach ($records as $record)
                <tr>
                  @foreach ($configs as $config)
                    @switch($config['type']) 
                      @case("number")
                        <td>{{ $record[$config['field']] }}</td>
                        @break
                      @case("textarea")
                        <?php
                            $arr = explode(' ', $record[$config['field']]);
                            $description = '';
                            if (count($arr) > 10) {
                                foreach(array_slice($arr,0,10) as $word){
                                    $description .= ' ' . $word;
                                }
                                $description .= '...';
                            } else {
                                $description = $record[$config['field']];
                            }
                          ?>
                        <td>{{ $description }}</td>
                        @break
                      @case("date")
                        <td>{{ date_format(new DateTime ($record[$config['field']]), 'd/m/Y') }}</td>
                        @break
                      @case("progress")
                        <?php 
                            $result = explode("/", $record[$config['field']]); 
                            $score = number_format($result[0]*(10/$result[1])*10, 1, '.', '');
                        ?>
                          <td>
                            <div>
                              <div class="d-flex justify-content-between align-items-center mb-1 max-width-progress-wrap">
                                <p class="text-primary">{{ $score }}%</p>
                                <p>{{ $record[$config['field']] }}</p>
                              </div>
                              <div class="progress progress-lg">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: {{ $score }}%" aria-valuenow="{{ $record[$config['field']] }}" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </div>
                          </td>
                        @break
                      @case("score")
                        <?php 
                            $result = explode("/", $record[$config['field']]); 
                            $score = $result[0]*(10/$result[1]);
                        ?>
                        <td>{{ number_format($score, 2, '.', '') }}/ 10</td>
                        @break
                      @case("relaOfRela")
                        <td>{{ $record->{$config['relation']}->{$config['get']}->{$config['value']} }}</td>
                       @break
                      @case("count")
                        <td>{{ $record->{$config['field']} }}</td>
                        @break
                      @case("is_multiple")
                        @foreach ($config['values'] as $value)
                          @if ($value['value']==$record[$config['field']])
                          <td>{{ $value['name']}}</td>
                          @endif
                        @endforeach
                        @break
                      @case("select")
                        @foreach ($config['values'] as $value)
                          @if ($value['value']==$record[$config['field']])
                          <td>{{ $value['name']}}</td>
                          @endif
                        @endforeach
                        @break
                      @case("action")
                        <td>
                          <a href="{{ route('editing.index',['model' => $modelName, 'id' => $record['id']]) }}" ><i class="mdi mdi-pencil-box-outline" style="color: #1F3BB3"></i></a>
                          <a href="{{ route('listing.destroy',['model' => $modelName, 'id' => $record['id']]) }}" onclick="return confirm('Bạn có chắc chắn xoá không?')"><i class="mdi mdi-close-box-outline" style="color:#F44181"></i></a>
                           </td>
                        @break
                      @default
                        @if (!empty($config['relation']))
                          <td>{{ $record->{$config['relation']}->{$config['get']} }}</td>
                        @else
                          <td>{{ $record[$config['field']] }}</td>
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
@stop
@section('support')
@stop
@section('js')
<script  src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>        
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- DataTables -->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
<script >
  $(document).ready( function () {
    $('#example').DataTable( {
      responsive: true
    } );
} );
</script>
    
@stop