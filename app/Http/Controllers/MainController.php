<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MainController extends Controller
{
    public function home(): View
    {
        return view('home');
    }

    public function viewExercises(): View
    {
        return view('operations');
    }

    /**
     * Generate exercises
     */
    public function generate(Request $request)
    {

    }

    /**
     * Print exercises in browser
     */
    public function print()
    {

    }

    /**
     * Export exercises to a .txt file
     */
    public function export()
    {

    }
}
