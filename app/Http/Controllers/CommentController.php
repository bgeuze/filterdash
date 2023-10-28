<?php

namespace App\Http\Controllers;

use App\Models\Filter;
use App\Models\Comment;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    public function store(Request $request, Filter $filter)
    {
        $likeCount = DB::table('likes')
            ->where('user_id', auth()->user()->id)
            ->count();

        if ($likeCount >= 3) {
            $request->validate([
                'body' => 'required|string',
            ]);

//            dd('aantal: ', $likeCount);

            Comment::create([
                'body' => $request->body,
                'filter_id' => $filter->id,
                'user_id' => auth()->user()->id,
            ]);

            return redirect()->back()->with('success', 'Comment added successfully!');
        } else {
            return redirect()->back()->with('error', 'You need at least 3 likes on this filter to place a comment.');
        }
    }
}
