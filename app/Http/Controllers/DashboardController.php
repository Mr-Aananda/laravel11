<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Show the application dashboard.
     */
    public function index()
    {
        $totalUsers = User::count();
        $totalBlogs = Blog::count();

        // Calculate the number of blogs created this month
        $blogsThisMonth = Blog::whereMonth('created_at', Carbon::now()->month)->count();

        // Calculate the number of blogs created today
        $blogsToday = Blog::whereDate('created_at', Carbon::today())->count();

        return view('dashboard', compact('totalUsers', 'totalBlogs', 'blogsThisMonth', 'blogsToday'));
    }
}
