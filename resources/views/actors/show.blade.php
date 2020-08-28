@extends('layouts.main')

@section('content')
    <div class="actor-info border-b border-gray-800">
        <div class="container mx-auto px-4 py-16 flex flex-col md:flex-row">
            <div class="flex-none">
                <img src="{{$actor['profile_path']}}" alt="profile"
                     class="w-96 rounded shadow-2xl">

                <ul class="flex items-center mt-8">
                    @if ($social['facebook'])
                        <li><a href="{{$social['facebook']}}"><i class="fab fa-facebook text-4xl"></i></a></li>
                    @endif
                    @if ($social['instagram'])
                        <li class="ml-4"><a href="{{$social['instagram']}}"><i
                                        class="fab fa-instagram text-4xl"></i></a></li>
                    @endif
                    @if ($social['twitter'])
                        <li class="ml-4"><a href="{{$social['twitter']}}"><i class="fab fa-twitter text-4xl"></i></a>
                        </li>
                    @endif
                    @if ($actor['homepage'])
                        <li class="ml-4"><a href="{{$actor['homepage']}}"><i class="fas fa-globe text-4xl"></i></a></li>
                    @endif
                </ul>
            </div>
            <div class="md:ml-24">
                <h2 class="text-4xl font-semibold">{{$actor['name']}}</h2>
                <div class="flex flex-wrap items-center text-gray-400 text-sm">
                    <i class="fas fa-birthday-cake"></i>
                    <span class="ml-4">{{$actor['birthday']}} ({{$actor['age']}}
                        years old) in {{$actor['place_of_birth']}}</span>
                </div>

                <h4 class="text-white font-semibold mt-8">Biography</h4>
                <p class="text-gray-300 mt-4">{{$actor['biography']}}</p>

                <h4 class="text-white font-semibold mt-8">Known For</h4>
                <div class="grid grid-cols-1 sm:grid-cols-3 md:grid-cols-5 lg:grid-cols-5 gap-8 mt-8">
                    @foreach ($knownForMovies as $movie)
                        <div class="mt-4">
                            <a href="{{$movie['page_link']}}">
                                <img src="{{$movie['poster_path']}}"
                                     alt="poster"
                                     class="hover:opacity-75 transition ease-in-out duration-150 rounded shadow-lg">
                            </a>
                            <a href="{{$movie['page_link']}}"
                               class="text-sm leading-normal block text-gray-400 hover:text-white mt-1">{{$movie['title']}}</a>
                        </div>
                    @endforeach
                </div>

            </div>

        </div><!-- End of container-->
    </div><!-- End movie info-->

    <div class="credits border-b border-gray-800">
        <div class="container mx-auto px-4 py-16">
            <h2 class="text-4xl font-semibold">Credits</h2>
            <ul class="list-disc leading-loose pl-5 mt-8">
                @foreach ($credits as $credit)
                    <li>{{$credit['release_year']}} &middot; <strong>{{$credit['title']}}</strong>
                        as {{$credit['character']}}</li>
                @endforeach
            </ul>
        </div><!-- End of container-->
    </div><!-- End of credits-->
@endsection()