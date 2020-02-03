<style>
    .swal2-container {
        z-index: 99999;
    }
</style>

<div class="content-wrapper">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
        <!-- general form elements -->
        <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Change password</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="POST" action="{{route('user.password.store', $id)}}" id="password-form">
            {!! csrf_field() !!}
            {{method_field('put')}}

            <div class="card-body">
                <div class="form-group">
                    <label for="title">Old password</label>
                    <input name="old_password" type="password" class="form-control" id="exampleInputEmail1" placeholder="Enter old password">
                </div>
                <div class="form-group">
                    <label for="title">New password</label>
                    <input name="new_password" type="password" class="form-control" id="exampleInputEmail1" placeholder="Enter new password">
                </div>
                <div class="form-group">
                    <label for="title">Confirm new password</label>
                    <input name="new_confirm_password" type="password" class="form-control" id="exampleInputEmail1" placeholder="Enter new password">
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
        </div>
        <!-- /.card -->
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script>
    $(function() {

        $('#password-form').on('submit', function(e) {
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
                data  : new FormData($(this)[0]),
                cache : false,
                dataType: "json",
                contentType: false,       
                cache: false,             
                processData:false, 
                success: function (res) {
                    if (res.status === 'success') {
                        $.fancybox.close();

                        Toast.fire({
                            icon: 'success',
                            title: 'success'
                        });

                    } else {

                        if (typeof res.errors != "undefined" && res.errors != null) {
                            response = '';
                            $.each(res.errors, function(i) {
                                response += res.errors[i][0] + '\n';
                            });

                            Toast.fire({
                                icon: 'warning',
                                title: response
                            });

                        } else {
                            Toast.fire({
                                icon: 'error',
                                title: res.message
                            });
                        }                       
                    }
                }
            });
        });
    });
</script>