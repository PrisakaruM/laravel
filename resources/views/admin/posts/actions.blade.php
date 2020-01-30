<div class="btn-group" style="width: 100%;">
    <a href="{{route('post.show', $id_post)}}" class="btn btn-default"><i class="fa fa-bars"></i></a>
    <a href="{{route('post.edit', $id_post)}}" class="btn btn-default"><i class="fa fa-edit"></i></a>
    <form action="{{route('post.destroy', $id_post)}}" method="post">
        <input class="btn btn-default" type="submit" value="Delete" />
        @method('delete')
        @csrf
    </form>
</div>