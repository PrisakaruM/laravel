<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Posts;
use App\Category;
use \Validator;
use App\Helpers\Output\Response;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin/posts/index');
    }

    public function selectPosts()
    {
        $query = Posts::select('id_post', 'title', 'description', 'content', 'image', 'id_cat')->with('category');

        return datatables($query)
            // ->order(function ($query) {
            //     $columns = array(
            //         0 => 'title',
            //     );

            //     $dir = request()->order[0]['dir'];
            //     $col =  $columns[intval(request()->order[0]['column'])];

            //     $query->orderBy($col, $dir);
            // })
            ->rawColumns(['action', 'id_post', 'title', 'description', 'content', 'image', 'category'])
            ->addColumn('action', 'admin/posts/actions')
            // ->addColumn('image', 'admin/news/image')

            // ->addColumn('date', function($query){
            //     return date('d.m.Y', strtotime($query->created_at));
            // })

//             ->addColumn('titleLink', function($query){
// //                return "<a href = '" . route('fullNewsPage', ['news' => $query['alias']]) . "' target = '_blank'>" . $query['title'] . "</a>";
//                 return $query['title'];
//             })

//             ->addColumn('categoryLink', function($query){
// //                return "<a href = '" . route('categoryNewsPage', ['category' => $query->category['alias']]) . "' target = '_blank'>" . $query->category['name'] . "</a>";
//                 return $query->category['name'];
//             })

            ->addColumn('category', function($query){
                return $query->category['title'];
            })

            ->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/posts/modal', ['categories' => Category::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'       => 'required|max:255' ,
            'description' => 'required',
            'content'     => 'required',
            'image'       => 'required|max:255',
            'id_cat'      => 'required|max:255',
        ]);
        
        if ($validator->fails()) {
            Response::json_output('', 'error', ['errors' => $validator->errors()]);
            // echo(json_encode([
            //     'status' => 'error',
            //     'errors' => $validator->errors(),
            // ])); die;
        }

        $input = $request->all();

        $post = new Posts();

        $post->fill($input);

        $post->save();

        $output = [
            'status' => 'success',
            'message' => 'success',
        ];

        Response::json_output('success', 'success');
        // echo(json_encode($output)); die;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin/posts/show', ['post' => Posts::find($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin/posts/modal', [
            'post' => Posts::find($id), 
            'categories' => Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title'       => 'required|max:255' ,
            'description' => 'required',
            'content'     => 'required',
            'image'       => 'required|max:255',
            'id_cat'      => 'required|max:255',
        ]);
        
        if ($validator->fails()) {
            Response::json_output('', 'error', ['errors' => $validator->errors()]);
            // echo(json_encode([
            //     'status' => 'error',
            //     'errors' => $validator->errors(),
            // ])); die;
        }

        $post = Posts::find($id);

        $post->title = $request->title;
        $post->description = $request->description;
        $post->content = $request->content;
        $post->image = $request->image;
        $post->id_cat = $request->id_cat;

        $post->save();
        
        // $output = array(
        //     'status'    => 'success',
        //     'message'   => 'success',
        // );

        Response::json_output('success', 'success');
        // echo(json_encode($output)); die;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       Posts::destroy($id);
       return redirect(route('posts.list'));
    }
}
