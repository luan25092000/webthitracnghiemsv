@extends('layouts.admin')

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
            <div class="table-responsive">
              <table class="table table-striped" id="example">
                <thead>
                  <tr>
                    <th>Profile</th>
                    <th>VatNo</th>
                    <th>Created</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Jacob</td>
                    <td>53275531</td>
                    <td>12 May 2017</td>
                    <td><label class="badge badge-danger">Pending</label></td>
                  </tr>
                  <tr>
                    <td>Messsy</td>
                    <td>53275532</td>
                    <td>15 May 2017</td>
                    <td><label class="badge badge-warning">In progress</label></td>
                  </tr>
                  <tr>
                    <td>John</td>
                    <td>53275533</td>
                    <td>14 May 2017</td>
                    <td><label class="badge badge-info">Fixed</label></td>
                  </tr>
                  <tr>
                    <td>Peter</td>
                    <td>53275534</td>
                    <td>16 May 2017</td>
                    <td><label class="badge badge-success">Completed</label></td>
                  </tr>
                  <tr>
                    <td>Dave</td>
                    <td>53275535</td>
                    <td>20 May 2017</td>
                    <td><label class="badge badge-warning">In progress</label></td>
                  </tr>
                </tbody>
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
<script >
  $(document).ready( function () {
    $('#example').DataTable( {
      responsive: true
    } );
} );
</script>
    
@stop