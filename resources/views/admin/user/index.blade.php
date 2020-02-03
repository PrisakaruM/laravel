@extends('layouts/admin')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Posts</h3>
            <a data-fancybox data-type="ajax" data-src="{{route('post.create')}}" href="javascript:;" class="btn btn-default" style="right: 10px; position: absolute; bottom: 3px;">
                <i class="fa fa-plus-square"></i>
              </a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="users_table" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <td>ID</td>
                  <td>name</td>
                  <td>email</td>
                  <td>image</td>
                  <td>actions</td>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
  <script>
    var dt;
          $(document).ready(function() {
              dt = $('#users_table').DataTable( {
                  "processing": true,
                  "serverSide": true,
                  "autoWidth": true,
                  responsive: true,
                  //"searching": false,
                  stateSave: true,
                  "order": [ 2, 'desc' ],
  
                  "columnDefs": [
                      {orderable: true, searchable: true, "targets": 0},
                      {orderable: true, className: "w-100", searchable: true, "targets": 1},
                      {orderable: true, searchable: true, "targets": 2},
                      {orderable: false, className: "w-150", searchable: true, "targets": 3},
                      {orderable: false, searchable: true, "targets": 4},
                  ],
                  "columns": [
                      {"data": "id"},
                      {"data": "name"},
                      {"data": "email"},
                      {"data": "image"},
                      {"data": "action"},
                  ],
  
                  "ajax": {
                      url: "{{route('users.list')}}",
                      type: 'POST',
                      headers: {
                        'X-CSRF-TOKEN': '{{csrf_token()}}'
                      }
                  }
              });
          });
  </script>
  @endsection