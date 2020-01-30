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
@endsection