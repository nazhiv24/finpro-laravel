<?php

namespace App\Http\Controllers\Site;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;

class SiteController extends Controller
{
    public function home()
    {
        // fetch all posts
        $posts = $this->getPosts();
        return view('frontend.home', compact('posts'));
    }

    public function about()
    {
        return view('frontend.about');
    }

    public function postDetails(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::where('status', 1)->get();
        return view('frontend.post-detail', compact('post', 'categories'));

    }

    private function getPosts(){
        return \DB::table('posts')
                ->where('posts.status', true)
                ->join('categories', 'categories.id', 'posts.category_id')
                ->select('posts.*', 'categories.category_name as category_name')
                ->orderByDesc('id')
                ->simplePaginate(5);
    }
}
