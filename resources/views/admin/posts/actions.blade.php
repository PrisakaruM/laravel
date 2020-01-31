<div class="btn-group" style="width: 100%;">
    <a href="{{route('post.show', $id_post)}}" class="btn btn-default"><i class="fa fa-bars"></i></a>
    <a data-fancybox data-type="ajax" data-src="{{route('post.edit', $id_post)}}" href="javascript:;" class="btn btn-default"><i class="fa fa-edit"></i></a>
    <a class="btn btn-default js-destroy" data-url="{{route('post.destroy', $id_post)}}" data-token="{{ csrf_token() }}"><i class="fa fa-trash"></i></a>
</div>