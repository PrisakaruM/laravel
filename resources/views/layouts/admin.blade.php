<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | DataTables</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{$app->make('url')->to('/admin')}}/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{$app->make('url')->to('/admin')}}/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{$app->make('url')->to('/admin')}}/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{$app->make('url')->to('/admin')}}/index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Posts</a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{$app->make('url')->to('/admin')}}/index3.html" class="brand-link">
      <img src="{{$app->make('url')->to('/admin')}}/dist/img/AdminLTELogo.png"
           alt="AdminLTE Logo"
           class="brand-image img-circle elevation-3"
           style="opacity: .0">
      <span class="brand-text font-weight-light">Test</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
              <li class="nav-item">
                <a href="../UI/buttons.html" class="nav-link">
                  <i class="fas fa-file-alt nav-icon"></i>
                  <p>Posts</p>
                </a>
              </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
    @yield('content')
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.0.2
    </div>
    <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{$app->make('url')->to('/admin')}}/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{$app->make('url')->to('/admin')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="{{$app->make('url')->to('/admin')}}/plugins/datatables/jquery.dataTables.js"></script>
<script src="{{$app->make('url')->to('/admin')}}/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<!-- AdminLTE App -->
<script src="{{$app->make('url')->to('/admin')}}/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{$app->make('url')->to('/admin')}}/dist/js/demo.js"></script>
<!-- page script -->
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
                // "order": [ 4, 'desc' ],

                "columnDefs": [
                    {orderable: true, searchable: true, "targets": 0},
                    {orderable: false, searchable: true, "targets": 1},
                    {orderable: false, searchable: true, "targets": 2},
                    {orderable: false, className: "w-150", searchable: false, "targets": 3},
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
</body>
</html>