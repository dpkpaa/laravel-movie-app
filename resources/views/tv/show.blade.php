@extends('layouts.main')

@section('content')
    <div class="tv-info border-b border-gray-800">
        <div class="container mx-auto px-4 py-16 flex flex-col md:flex-row">
            <div class="flex-none">
                <img src="{{$tvshow['poster_path']}}" alt="poster"
                     class="w-96 rounded shadow-2xl">
            </div>
            <div class="md:ml-24">
                <h2 class="text-4xl font-semibold">{{$tvshow['name']}}</h2>
                <div class="flex flex-wrap items-center text-gray-400 text-sm">
                    <i class="fas fa-star text-orange-500"></i>
                    <span class="ml-1">{{$tvshow['vote_average'] }}</span>
                    <span class="mx-2">|</span>
                    <span>{{$tvshow['first_air_date']}}</span>
                    <span class="mx-2">|</span>
                    <span>
                         {{$tvshow['genres']}}
                    </span>
                </div>

                <h4 class="text-white font-semibold mt-6">Overview</h4>
                <p class="text-gray-300 mt-4">{{$tvshow['overview']}}</p>

                <div class="mt-12">
                    <h4 class="text-white font-semibold">Creators</h4>
                    <div class="flex mt-4">
                        @foreach ($tvshow['created_by'] as $crew)
                            <div class="mr-8">
                                <div>{{$crew['name']}}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div x-data="{isOpen: false, video: ''}">
                    @if (count($tvshow['videos']) > 0)
                        @php
                            $count = 1 ;
                        @endphp
                        <div class="mt-12 flex justify-start">
                            @foreach ($tvshow['videos'] as $video)
                                <button
                                        @click="
                    isOpen=true
                    video='{{ 'https://www.youtube.com/embed/'.$video['key']}}'
                    "
                                        class="flex inline-flex items-center bg-orange-500 text-gray-900 rounded font-semibold px-5 py-4 hover:bg-orange-600 transition ease-in-out duration-150 {{$count > 1 ? 'ml-6':'' }}">
                                    <svg class="w-6 fill-current" viewBox="0 0 24 24">
                                        <path d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M10 16.5l6-4.5-6-4.5v9zM12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/>
                                    </svg>
                                    <span class="ml-2">Play Trailer {{ $count  ++}}</span>
                                </button>

                            @endforeach
                        </div>
                    @endif
                    {{--Model Window--}}
                    <div class="fixed left-0 top-0 w-full h-full transform scale-x-110 scale-y-110"
                         style="background-color: rgba(0, 0, 0, 0.5); transition: visibility 0s linear 0.25s, opacity 0.25s 0s, transform 0.25s;"
                         x-show.transition.opacity="isOpen"

                    >
                        <div class="absolute top-50 left-50 bg-gray-900 rounded w-3/5 shadow-lg"
                             style="transform: translate(-50%,-50%)"
                             @click.away="isOpen=false"
                        >
                            <div class="flex items-center justify-between border-b border-gray-700 px-4 py-4">
                                <h2>Heading</h2>
                                <span
                                        class="w-6 h-6 text-center leading-6 cursor-pointer bg-transparent rounded-full hover:text-gray-300"
                                        @click="isOpen=false"
                                >&times;</span>
                            </div>
                            <div class="content px-4 py-6">
                                <div class="video-responsive">
                                    <iframe :src="video" frameborder="0"
                                            allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                            allowfullscreen></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div><!-- End of container-->
    </div><!-- End tv info-->

    <div class="tv-casts border-b border-gray-800">
        <div class="container mx-auto px-4 py-16">
            <h2 class="text-4xl font-semibold">Cast</h2>
            <div class="grid grid-cols-1 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-8">
                @foreach ($tvshow['cast'] as $cast)
                    <div class="mt-8"><!-- items -->
                        <a href="{{route('actors.show',$cast['id'])}}">
                            <img src="{{$cast['profile_path'] ?'https://image.tmdb.org/t/p/w500'.$cast['profile_path'] : 'https://via.placeholder.com/500x750'}}"
                                 alt="cast-{{$cast['name']}}"
                                 class="hover:opacity-75 transition ease-in-out duration-150 rounded">
                        </a>
                        <div class="mt-2">
                            <a href="{{route('actors.show',$cast['id'])}}"
                               class="text-lg mt-2 hover:text-gray-300">{{$cast['name']}}</a>
                            <p class="text-sm">{{$cast['character']}}</p>
                        </div>
                    </div><!--Item End -->
                @endforeach
            </div><!--Grid End -->
        </div><!-- End of container-->
    </div><!-- End of tv casts-->

    @if (count($tvshow['images'])> 0)
        <div class="cast-images border-b border-gray-800">
            <div class="container mx-auto px-4 py-16">
                <h2 class="text-4xl font-semibold">Images</h2>
                <div class="mt-8">
                    <div class="grid grid-cols-1 sm:grid-cols-3 md:grid-cols-3 lg:grid-cols-3 gap-8">
                        @foreach ($tvshow['images'] as $image)
                            <img src="https://image.tmdb.org/t/p/w500{{$image['file_path']}}" alt="parasite"
                                 class="rounded">
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection()