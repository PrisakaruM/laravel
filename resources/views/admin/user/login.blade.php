<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Learning | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{$app->make('url')->to('/admin')}}/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{$app->make('url')->to('/admin')}}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{$app->make('url')->to('/admin')}}/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="{{$app->make('url')->to('/admin')}}/index2.html"><b>Learning</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form id="login-form" action="{{route('login.processing')}}" method="post">
        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
        <div class="input-group mb-3">
          <input name="login" type="text" class="form-control" placeholder="Login">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input name="password" type="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{$app->make('url')->to('/admin')}}/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{$app->make('url')->to('/admin')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="{{$app->make('url')->to('/admin')}}/dist/js/adminlte.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script>
$('#login-form').on('submit', function(e) {
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
  
  $.ajax({
      type  : "POST",
      url   : $(this).attr('action'),
      data  : $(this).serializeArray(),
      cache : false,
      dataType: "json",
      success: function (res){
          if(res.status === 'success'){
              Toast.fire({
                  icon: 'success',
                  title: res.message
              });

              window.location.href = "{{route('post.index')}}";
          }else{

              Toast.fire({
                  icon: 'warning',
                  title: res.message
              });
          }
      }
  });
});
</script>

</body>
</html>
