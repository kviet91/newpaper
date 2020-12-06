<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Tag;
use DB;
use Auth;
use App\Repositories\RepositoryInterface;

class StorageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $res;
    // private $
    public function __construct(RepositoryInterface $res) {
        $this->res = $res;
    }
    
    public function index()
    {
        return view('storages.index');
        //
    }

    public function savePost(Request $request) {

        if(is_null(Auth::user())) {
            return response()->json([
                'authenticated' => 'Bạn cần đăng nhập mới lưu được bài post này',
                'class_name' => 'alert-danger',
            ]);
        }
        else {
            $post = Post::find($request->id);

            if(DB::table('storages')->where([
                'post_id' => $post->id,
                'user_id' => Auth::user()->id,
            ])->exists()) {
                DB::table('storages')->where([
                    ['user_id', '=', Auth::user()->id],
                    ['post_id', '=', $post->id],
                    ])->update([
                        'save' => true, 
                ]);
            }

            else {
                DB::table('storages')->insert([
                    'post_id' => $post->id,
                    'user_id' => Auth::user()->id,
                    'save' => true,
                ]);
            }

            return response()->json([
                'message' => 'Save post successfully',
                'class_name' => 'alert-success',
            ]); 
        }

    }

     public function removePost(Request $request) {
            $post = Post::find($request->id);

            DB::table('storages')->where([
                ['user_id', '=', Auth::user()->id],
                ['post_id', '=', $post->id],
            ])->update([
                'save' => false, 
            ]);
            
            return response()->json([
                'message' => 'Delete post successfully',
                'class_name' => 'alert-success',
            ]); 
    }

    public function getPost() {
        $storagesPost = DB::table('storages')
        ->join('users', 'storages.user_id', '=', 'users.id')
        ->join('posts', 'storages.post_id', '=', 'posts.id')
        ->join('category_post', 'storages.post_id', '=', 'category_post.post_id')
        ->join('categories', 'categories.id', '=', 'category_post.category_id')
        ->where('storages.user_id', Auth::user()->id)
        ->where('storages.save', '=', true)
        ->orWhere('storages.like', '!=', 1)
        ->whereNotNull('categories.parent_id')
        ->groupBy('posts.id')
        ->selectRaw('posts.*, categories.name as category_name')->get();
        $tags = Tag::all();
        $catsHome = $this->res->getCategoryForHome();
        return view('storages.index')->withStoragesPost($storagesPost)->withTags($tags)->withCatsHome($catsHome);
    }


    // public function getPost() {
    //     $storagesPost = DB::table('storages')
    //     ->join('users', 'storages.user_id', '=', 'users.id')
    //     ->join('posts', 'storages.post_id', '=', 'posts.id')
    //     ->join('category_post', 'storages.post_id', '=', 'category_post.post_id')
    //     ->join('categories', 'categories.id', '=', 'category_post.category_id')
    //     ->where('storages.user_id', Auth::user()->id)
    //     ->whereNotNull('categories.parent_id')
    //     ->groupBy('posts.id')
    //     ->selectRaw('posts.*, categories.name as category_name')->get();
    //     $tags = Tag::all();

    //     return view('storages.index')->withStoragesPost($storagesPost)->withTags($tags);
    // }

    public function getSingle(Request $request) {

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
