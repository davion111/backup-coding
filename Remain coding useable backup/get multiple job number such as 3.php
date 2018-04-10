<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bookmark;
use App\Models\Category;
use App\Models\UserSeller;
use App\Models\Job;


class FavouriteController extends Controller
{
    public function favourite(Request $request)
    {
        $userIds = [200, 201, 202];
        $jobs = \App\Models\Job::whereIn('id', $userIds)
            ->get();

        $categories = Category::withDepth()->get()->toFlatTree();

        $user_id = $user_id = 5;
        if ($request->exists('user_id', 5)) {
            $user_id = $request->user_id;
        }


        $bookmark = Bookmark::where('job_id', 248)
            ->where('user_id', $user_id);
        if ($bookmark->count() == 0) {
            $bookmark = new bookmark();
            $bookmark->user_id = $user_id;
            $bookmark->job_id = $request->get('job_id', 248);
            $bookmark->save();
        }

        $bookmark = Bookmark::where('job_id', 193)
            ->where('user_id', $user_id)
            ->delete();        


        return view('web.favourite', compact('jobs', 'categories', 'user_id', 'bookmark'));
    }
}
