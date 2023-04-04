<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Post;
use App\Models\User;
use App\Models\Video;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $users = User::all()->count();
        $posts = Post::all()->count();
        $activities = Activity::all()->count();
        $videos = Video::all()->count();
        return view('auth.dashboard.index', compact(
            'users',
            'posts',
            'activities',
            'videos',
        ));
    }
}
