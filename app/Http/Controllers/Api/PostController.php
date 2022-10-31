<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequestStore;
use Illuminate\Http\Request;

use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allPost = Post::latest()->get();
        return  $allPost;

        return response()->json([
            'status'=> true,
            'posts' => [],

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequestStore $request)
    {
        //

        $post = new Post();

        $post->title            = $request->title;
        $post->description      = $request->description;
        $post->save();

        return response()->JSON([
            'status' => true,
            'message' => 'Data inserted',
            'posts' => [],
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $showDetails = Post::find($id);
        if($showDetails)
        {
            return $showDetails;
        }
        else{
            return  response()->json([
                'status' => true,
                'msg'=>'Data not Exist'
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $post = Post::find($id);

        if($post)
        {
            $post->title            = $request->title;
            $post->description      = $request->description;
            $post->save();

            return response()->json([
                'status'=>true,
                'msg'=>'Data Updated Successfully'
            ]);

        }else{
            return  response()->json([
                'status'=>true,
                'message'=>'Nothing to Update'
            ]);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Post::find($id);

        if($delete)
        {
            $delete->delete();

            return  response()->JSON([
                'status' => 200,
                'message' => 'Data Removed From Database',
                'post' =>[]
            ]);
        }
        else{
            return  response()->JSON([
                'status' => 200,
                'message' => 'Data Not exist in database',
                'post' =>[]
            ]);
        }


    }
}
