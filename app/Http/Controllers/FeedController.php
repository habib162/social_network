<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FeedController extends Controller
{
    public function feed()
    {
        # code...
        $feed= DB::table('posts')
        ->where('personId',Auth::id())
        ->select('posts.post_content', 'posts.pageId')
        ->paginate(5);

        return response([
            'message' => " Success",
             $feed,
            
        ],200);
    }
}
