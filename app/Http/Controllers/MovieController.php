<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MovieController extends Controller
{
    public function index()
    {
        return Movie::with('review')->get();
    }

    public function filterByReview()
    {
        $movies = Movie::all();

        $filteredMovies = $movies->filter(function ($value, $key) {
            return $value->hasReview();
        })->values();

        return $filteredMovies;
    }
}
