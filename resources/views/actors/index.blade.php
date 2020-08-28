@extends('layouts.main')
@section('styles')
    <style>
        .actor img{
            -webkit-clip-path: polygon(100% 0%, 100% 100%, 0% 100%, 0% 0%);
            clip-path: polygon(100% 0%, 100% 100%, 0% 100%, 0% 0%);
            transition: all .5s ease-in-out;
            border-radius: .25rem;
        }
        .actor img:hover{
            -webkit-clip-path: polygon(50% 0%, 100% 50%, 50% 100%, 0% 50%);
            clip-path: polygon(50% 0%, 100% 50%, 50% 100%, 0% 50%);
            background: #ed8936;
            border-radius: .25rem;
        }
    </style>
@endsection
@section('content')
    <div class="container mx-auto px-4 py-16">
        <div class="popular-movies">
            <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">Popular Actors</h2>
            <div class="grid grid-cols-1 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-8">
                @foreach($popularActors as $actor)
                    <div class="actor mt-8">
                        <a href="{{route('actors.show',$actor['id'])}}">
                            <img class="rounded shadow-lg"
                                 src="{{$actor['profile_path']}}"
                                 alt="actor">
                        </a>
                        <div class="mt-2">
                            <a href="{{route('actors.show',$actor['id'])}}"
                               class="text-lg hover:text-gray-300">{{$actor['name']}}</a>
                            <div class="text-sm truncate text-gray-400">{{$actor['known_for']}}</div>
                        </div>
                    </div>
                @endforeach
            </div><!--Grid End -->
        </div><!--Popular Actors End -->

        {{--Loader--}}
        <div class="page-load-status mt-8">
            <div class="flex justify-center">
                <div class="infinite-scroll-request spinner my-8 text-4xl">&nbsp;</div>
            </div>
            <p class="infinite-scroll-last">End of content</p>
            <p class="infinite-scroll-error">Error</p>
        </div>
        {{--<div class="mt-16 flex items-center justify-between">--}}
        {{--@if ($previous)--}}
        {{--<a href="/actors?page={{$previous}}" class="hover:text-gray-300">Previous</a>--}}
        {{--@else--}}
        {{--<div></div>--}}
        {{--@endif--}}
        {{--@if ($next)--}}
        {{--<a href="/actors?page={{$next}}" class="hover:text-gray-300">Next</a>--}}
        {{--@else--}}
        {{--<div></div>--}}
        {{--@endif--}}
        {{--</div>--}}
        {{--pagination end--}}
    </div>
    {{--Contailer End--}}
@endsection()

@section('scripts')
    <script src="https://unpkg.com/infinite-scroll@3/dist/infinite-scroll.pkgd.min.js"></script>
    <script>
        var elem = document.querySelector('.grid');
        var infScroll = new InfiniteScroll(elem, {
            path: '/actors?page=@{{#}}',
            append: '.actor',
            status: '.page-load-status'
            // history: false,
        });
    </script>
@stop
