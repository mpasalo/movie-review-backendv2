<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function show(Movie $movie)
    {
        $movie = $movie->load('review');
        
        if ($movie->hasReview()) {
            return Review::whereMovieId($movie->id)->whereUserId(Auth::user()->id)->first();
        } else {
            return '';
        }
    }
    
    public function storeDescription(Movie $movie, Request $request)
    {
        return Review::updateOrcreate([
            'user_id'  => Auth::user()->id,
            'movie_id' => $movie->id,
        ], [
            'description' => $request['description']
        ]);
    }

    public function storeRating(Movie $movie, Request $request)
    {
        return Review::updateOrcreate([
            'user_id'  => Auth::user()->id,
            'movie_id' => $movie->id,
        ], [
            'rating' => $request['rating']
        ]);
    }

    public function destroy(Movie $movie)
    {
        $review = Review::find($movie->review->id);
        $review->delete();
    }
}
