<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\UserSeller;
use App\Models\Job;
use App\Models\theme;
use App\Models\Bookmark;
use Jenssegers\Agent\Agent;

class FavouriteController extends Controller
{
    public function __construct()
    {
    }

    public function favourite(Request $request)
    {
        $userIds = [232, 247, 248, 249, 200];
        $jobs = \App\Models\Job::whereIn('id', $userIds)
            ->get();

        $categories = Category::withDepth()->get()->toFlatTree();

        $user_id = $user_id = 5;
        if ($request->exists('user_id', 5)) {
            $user_id = $request->user_id;
        }

        $bookmark = \App\Models\Bookmark::whereIn('job_id', $userIds)
            ->where('user_id', $user_id)
            ->get();

        $bookmark_add = Bookmark::whereIn('job_id', $userIds)
            ->where('user_id', $user_id);
        if ($bookmark_add->count() == 0) {
            $bookmark_add = new bookmark();
            $bookmark_add->user_id = $user_id;
            $bookmark_add->job_id = $request->get('job_id', $userIds);
            $bookmark_add->save();
        }

        $bookmark_remove = Bookmark::where('job_id', $request->job_id)
            ->where('user_id', $user_id)
            ->delete();        


        return view('web.favourite', compact('jobs', 'categories', 'user_id','bookmark', 'bookmark_add', 'bookmark_remove'));
    }
}
