@extends('admin.layouts.template')

@section('css')
  
    <!-- DataTables -->
  <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/dataTable.min.css') }}">  
  
  <link rel="stylesheet" type="text/css" href=" https://cdn.datatables.net/1.11.2/css/dataTables.bootstrap4.min.css">  
  
@stop

@section('title')
    <h4 class="card-title">Kết quả thi</h4>
    <p class="card-description">
        ---------- <code>Danh sách</code>
      </p>
@stop

@section('main')
    
    <div class="row">   
        <div class="card-body">
          <div class="header">
                <div class="row">
                  <div class="form-group" style="width:20%">
                    <label for="theme">Lớp</label>
                      <select class="form-control" id="theme" name="theme">
                        <option>Vui lòng chọn lớp</option>
                        @foreach ($themes as $theme)
                          <option value="{{ $theme->id }}">{{ $theme->name }}</option>
                        @endforeach
                      </select>
                  </div>
                  <div class="form-group" style="width:40%">
                    <label for="subject">Đề thi</label>
                      <select class="form-control" id="subject" name="subject">
                        <option>Vui lòng chọn đề thi</option>
                      </select>
                  </div>
                  <button type="submit" style="width:100px;height:43px;margin: auto 0" id="btnShow" class="btn btn-primary">Hiển thị</button>
                </div>
          </div>
          <div class="table-responsive">
            <table class="table table-striped" id="example">
            </table>
          </div>            
          </div>
    </div>
@stop

@section('js')
<script  src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>        
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- DataTables -->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
<!-- JS for this page -->
<script src="{{ asset('admin/js/rank.js') }}"></script>
<script >
  $(document).ready( function () {
    $('#example').DataTable( {
      responsive: true
    } );
} );
</script>
    
@stop