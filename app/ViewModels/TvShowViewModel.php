<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class TvShowViewModel extends ViewModel
{
    public $tvshow;

    public function __construct( $tvshow )
    {
        $this->tvshow = $tvshow;
    }

    public function tvshow()
    {
        $videos = collect($this->tvshow['videos']['results'])->filter(function ( $video ) {
            return $video['type'] === "Trailer";
        })->take(2);

        return collect($this->tvshow)->merge([
            'poster_path' => 'https://image.tmdb.org/t/p/w500' . $this->tvshow['poster_path'],
            'vote_average' => $this->tvshow['vote_average'] * 10 . ' %',
            'first_air_date' => Carbon::parse($this->tvshow['first_air_date'])->format('M d, Y'),
            'genres' => collect($this->tvshow['genres'])->pluck('name')->flatten()->implode(', '),
            'created_by' => collect($this->tvshow['created_by'])->take(3),
            'cast' => collect($this->tvshow['credits']['cast'])->take(5),
            'images' => collect($this->tvshow['images']['backdrops'])->take(9),
            'videos' => $videos
        ])->dump();
    }
}
