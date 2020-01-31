<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Posts;
use App\Category;
use \Validator;
use App\Helpers\Output\Response;
use App\Helpers\Image\Processing;

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

    /**
     * Display Json for Data Table.
     *
     * @return Json
     */
    public function selectPosts()
    {
        $query = Posts::select('id_post', 'title', 'description', 'content', 'image', 'id_cat')->with('category');

        return datatables($query)
            ->order(function ($query) {
                $columns = [
                    0 => 'id_post',
                    1 => 'title',
                    2 => 'description',
                    3 => 'content',
                ];

                $dir = request()->order[0]['dir'];
                $col =  $columns[intval(request()->order[0]['column'])];

                $query->orderBy($col, $dir);
            })
            ->rawColumns(['action', 'id_post', 'title', 'description', 'content', 'image', 'category'])
            ->addColumn('action', 'admin/posts/actions')
            ->addColumn('image', 'admin/posts/image')
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
            'image'       => 'required|image|mimes:jpeg,png,jpg,gif|max:4000',
            'id_cat'      => 'required|max:255',
        ]);
        
        if ($validator->fails()) {
            Response::json_output('', 'error', ['errors' => $validator->errors()]);
        }

        $input = $request->all();
        $post = new Posts();
        $post->fill($input);
        $post->save();

        $image_name = Processing::upload($request->file('image'), 'img/blogs/' . $post->id_post);
        $post->image = $image_name;
        $post->save();

        Response::json_output('success', 'success');
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
            'post'       => Posts::find($id), 
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
            'image'       => 'required|image|mimes:jpeg,png,jpg,gif|max:4000',
            'id_cat'      => 'required|max:255',
        ]);
        
        if ($validator->fails()) {
            Response::json_output('', 'error', ['errors' => $validator->errors()]);
        }

        $post = Posts::find($id);
        
        $image_name = Processing::upload($request->file('image'), 'img/blogs/' . $id, $post->image);
        
        $post->title = $request->title;
        $post->description = $request->description;
        $post->content = $request->content;
        $post->image = $image_name;
        $post->id_cat = $request->id_cat;

        $post->save();

        Response::json_output('success', 'success');
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
       
       Response::json_output('success', 'success');
    }
}
