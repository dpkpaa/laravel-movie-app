<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class TvViewModel extends ViewModel
{
    public $popularTv;
    public $topRatedTv;
    public $genres;

    public function __construct( $popularTv, $topRatedTv, $genres )
    {
        $this->popularTv = $popularTv;
        $this->topRatedTv = $topRatedTv;
        $this->genres = $genres;
    }

    public function popularTv()
    {
        return $this->tvFormat($this->popularTv);
    }

    public function topRatedTv()
    {
        return $this->tvFormat($this->topRatedTv);
    }

    public function genres()
    {
        return collect($this->genres)->mapWithKeys(function ( $genre ) {
            return [$genre['id'] => $genre['name']];
        });
    }

    private function tvFormat( $tv )
    {
        return collect($tv)->map(function ( $tv ) {
            $genresFormated = collect($tv['genre_ids'])->mapWithKeys(function ( $value ) {
                return [$value => $this->genres()->get($value)];
            })->implode(', ');
            return collect($tv)->merge([
                'poster_path' => $tv['poster_path'] ? 'https://image.tmdb.org/t/p/w500' . $tv['poster_path'] : 'https://via.placeholder.com/500x750',
                'vote_average' => $tv['vote_average'] * 10 . ' %',
                'first_air_date' => Carbon::parse($tv['first_air_date'])->format('M d, Y'),
                'genres' => $genresFormated
            ])->only([
                'poster_path',
                'vote_average',
                'first_air_date',
                'genres',
                'id',
                'name',
                'genre_ids',
                'overview'
            ]);
        });
    }
}
