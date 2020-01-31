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
        <form method="POST" action="{{!empty($post['id_post']) ? route('post.update', $post['id_post']) : route('posts.store')}}" enctype="multipart/form-data" id="post-form">
            {!! csrf_field() !!}
            {{!empty($post['id_post']) ? method_field('put') : ''}}

            <div class="card-body">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input name="title" type="text" class="form-control" id="exampleInputEmail1" placeholder="Title..." value="{{!empty($post['id_post']) ? $post['title'] : ''}}">
                </div>
                <div class="form-group">
                    <label for="image">Image</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input name="image" type="file" class="custom-file-input" id="post-image">
                            <label class="custom-file-label" for="post-image">Choose file</label>
                        </div>
                        <div class="input-group-append">
                            <span class="input-group-text" id="">Upload</span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" class="form-control" rows="3" placeholder="Enter ...">{{!empty($post['id_post']) ? $post['description'] : ''}}</textarea>
                </div>
                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea name="content" class="form-control" rows="3" placeholder="Enter ...">{{!empty($post['id_post']) ? $post['content'] : ''}}</textarea>
                </div>
                <div class="form-group">
                    <label>Select</label>
                    <select name="id_cat" class="form-control">
                        @foreach ($categories as $category)
                            <option value="{{$category['id_cat']}}" 
                                {{!empty($post['id_cat']) && $category['id_cat'] == $post['id_cat'] ? 'selected' : ''}}>
                                {{$category['title']}}
                            </option> 
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
<script src="{{$app->make('url')->to('/admin')}}/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script>
    $(function() {
        bsCustomFileInput.init();

        $('#post-form').on('submit', function(e) {
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
                success: function (res){
                    if(res.status === 'success'){
                        $.fancybox.close();
                        $('#posts_table').DataTable().draw();

                        Toast.fire({
                            icon: 'success',
                            title: 'success'
                        });
                    }else{
                        response = '';
                        $.each(res.errors, function(i) {
                            response += res.errors[i][0] + '\n';
                        });

                        Toast.fire({
                            icon: 'warning',
                            title: response
                        });
                    }
                }
            });
        });
    });
</script>