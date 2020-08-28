<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class MoviesViewModel extends ViewModel
{
    public $nowPlayingMovies;
    public $genres;
    public $popularMovies;

    public function __construct($popularMovies, $nowPlayingMovies, $genres)
    {
        $this->popularMovies = $popularMovies;
        $this->nowPlayingMovies = $nowPlayingMovies;
        $this->genres = $genres;
    }

    public function popularMovies()
    {
        return $this->movieFormat($this->popularMovies);
    }

    public function nowPlayingMovies()
    {
        return $this->movieFormat($this->nowPlayingMovies);
    }

    public function genres()
    {
        return collect($this->genres)->mapWithKeys(function ($genre) {
            return [$genre['id'] => $genre['name']];
        });
    }

    private function movieFormat($movie)
    {
        return collect($movie)->map(function ($movie) {
            $genresFormated = collect($movie['genre_ids'])->mapWithKeys(function ($value) {
                return [$value => $this->genres()->get($value)];
            })->implode(', ');
            return collect($movie)->merge([
                'poster_path' => 'https://image.tmdb.org/t/p/w500' . $movie['poster_path'],
                'vote_average' => $movie['vote_average'] * 10 . ' %',
                'release_date' => Carbon::parse($movie['release_date'])->format('M d, Y'),
                'genres' => $genresFormated
            ])->only([
                'poster_path',
                'vote_average',
                'release_date',
                'genres',
                'id',
                'title',
                'genre_ids',
                'overview'
            ]);
        });
    }
}
