<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class FilmController extends Controller
{
    public function index(Request $request)
    {
        $limit = $request->input('limit', 10);

        $films = Cache::remember('films', now()->addMinutes(10), function () {
            return DB::table('films')
                ->select('id', 'title', 'image', 'description', 'rating', 'release_date')
                ->get();
        });

        foreach ($films as $film) {
            Cache::remember("films.{$film->id}.rating", now()->addMinutes(10), function () use ($film) {
                return $film->rating;
            });
            Cache::remember("films.{$film->id}.release_date", now()->addMinutes(10), function () use ($film) {
                return $film->release_date;
            });
        }

        if ($request->is('api/*')) {
            return response()->json([
                'data' => $films->take($limit)
            ]);
        }

        return Inertia::render('Films', [
            'films' => $films->take($limit)
        ]);
    }
}


