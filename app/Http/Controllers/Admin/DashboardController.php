<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;

class DashboardController extends Controller
{
    // i need the method main to be able to use the route
    public function index()
    {
        // Example debug messages
        \Debugbar::info('This is an info message'); 
        \Debugbar::warning('This is a warning message');
        \Debugbar::error('This is an error message');
        \Debugbar::startMeasure('myMethod', 'Time for My Method');
        $articles = Article::all();
        \Debugbar::info($articles);
        \Debugbar::stopMeasure('myMethod');
        return view('dashboard', ['articles' => $articles ]);
    }

}
