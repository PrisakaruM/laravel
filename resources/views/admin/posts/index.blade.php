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
              <table id="posts_table" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <td>ID</td>
                  <td>Title</td>
                  <td>Description</td>
                  <td>Content</td>
                  <td>Image</td>
                  <td>Category</td>
                  <td>Action</td>
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
              dt = $('#posts_table').DataTable( {
                  "processing": true,
                  "serverSide": true,
                  "autoWidth": true,
                  responsive: true,
                  //"searching": false,
                  stateSave: true,
                  "order": [ 2, 'desc' ],
  
                  "columnDefs": [
                      {orderable: true, searchable: true, "targets": 0},
                      {orderable: true, searchable: true, "targets": 1},
                      {orderable: true, searchable: true, "targets": 2},
                      {orderable: true, className: "w-150", searchable: false, "targets": 3},
                      {orderable: false, className: "w-120", searchable: false, "targets": 4},
                      {orderable: false, className: "w-120", searchable: false, "targets": 5},
                  ],
                  "columns": [
                      {"data": "id_post"},
                      {"data": "title"},
                      {"data": "description"},
                      {"data": "content"},
                      {"data": "image"},
                      {"data": "category"},
                      {"data": "action"},
                      // {"data": "date"},
                  ],
  
                  "ajax": {
                      url: "{{route('posts.list')}}",
                      type: 'POST',
                      headers: {
                        'X-CSRF-TOKEN': '{{csrf_token()}}'
                      }
                  }
              });
          });
  </script>
  <script>
    $(function() {
      $("body").on('click', '.js-destroy', function(e) {
        e.preventDefault();

        const Toast = Swal.mixin({
          toast: true,
          position: 'top-end',
          timer: 3000,
          timerProgressBar: true,
          showConfirmButton: false,
          onOpen: (toast) => {
              toast.addEventListener('mouseenter', Swal.stopTimer)
              toast.addEventListener('mouseleave', Swal.resumeTimer)
          }
        });

        var url = $(this).data("url");
        var token = $(this).data("token");

        $.ajax(
        {
            url: url,
            method: 'POST',
            dataType: "JSON",
            data: {
                "_method": 'DELETE',
                "_token": token,
            },
            success: function()
            {
              $('#posts_table').DataTable().draw();

              Toast.fire({
                  icon: 'success',
                  title: 'success'
              });
            }
        });
      });
    });
  </script>

  @endsection