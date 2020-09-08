@extends('layouts.main')

@section('content')
    <div class="container mx-auto px-4 pt-16">
        <div class="popular-tv ok">
            <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">Popular Shows</h2>
            <div class="grid grid-cols-1 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-8">
                @foreach($popularTv as $tvshow)
                    <x-tv-card :tvshow="$tvshow"/>
                @endforeach
            </div><!--Grid End -->
        </div><!--Popular tv End -->

        <div class="top-rated-tv py-24">
            <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">Top Rated Shows</h2>
            <div class="grid grid-cols-1 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-8">
                @foreach($topRatedTv as $tvshow)
                    <x-tv-card :tvshow="$tvshow"/>
                @endforeach
            </div><!--Grid End -->
        </div><!--now playing tv End -->
    </div>
    {{--Contailer End--}}
@endsection()