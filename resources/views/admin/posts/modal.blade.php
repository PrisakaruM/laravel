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
            <h3 class="card-title">{{!empty($post['id_post']) ? 'Edit ' : 'Add '}}Post</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="POST" action="{{!empty($post['id_post']) ? route('post.update', $post['id_post']) : route('posts.store')}}" id="post-form">
            {!! csrf_field() !!}
            {{!empty($post['id_post']) ? method_field('put') : ''}}

            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Title</label>
                    <input name="title" type="text" class="form-control" id="exampleInputEmail1" placeholder="Title..." value="{{!empty($post['id_post']) ? $post['title'] : ''}}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Image</label>
                    <input name="image" type="text" class="form-control" id="exampleInputEmail1" placeholder="Image..." value="{{!empty($post['id_post']) ? $post['image'] : ''}}">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Description</label>
                    <textarea name="description" class="form-control" rows="3" placeholder="Enter ...">{{!empty($post['id_post']) ? $post['description'] : ''}}</textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">Content</label>
                    <textarea name="content" class="form-control" rows="3" placeholder="Enter ...">{{!empty($post['id_post']) ? $post['content'] : ''}}</textarea>
                </div>
                <div class="form-group">
                    <label>Select</label>
                    <select name="id_cat" class="form-control">
                        @foreach ($categories as $category)
                            <option value="{{$category['id_cat']}}">{{$category['title']}}</option> 
                        @endforeach                        
                    </select>
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
        $('#post-form').on('submit', function(e) {
            e.preventDefault();
            console.log('success');

            $.ajax({
                type  : "POST",
                url   : $(this).attr('action'),
                data  : $(this).serializeArray(),
                cache : false,
                dataType: "json",
                success: function (res){
                    if(res.status === 'success'){
                        window.location = "{{route('post.index')}}";
                    }else{
                        response = '';
                        $.each(res.errors, function(i) {
                            response += res.errors[i][0] + '\n';
                        });

                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            onOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        })

                        Toast.fire({
                            icon: 'warning',
                            title: response
                        })
                    }
                }
            });
        });
    });
</script>