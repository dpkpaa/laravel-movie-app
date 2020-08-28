<div class="relative mt-3 md:mt-0"
     x-data="{isOpen: true}"
     @click.away="isOpen=false"
>
    <input type="text" wire:model.debounce.500ms="search"
           class="bg-gray-800 text-sm rounded-full w-64 px-4 pl-8 py-2 focus:outline-none focus:shadow-outline"
           placeholder="Search"
           x-ref="search"
           @keydown.window="
                if(event.keyCode === 191){
                    event.preventDefault();
                    $refs.search.focus();
                }
            "
           @focus="isOpen = true"
           @keydown="isOpen = true"
           @keydown.escape.window="isOpen = false"
           @keydown.shift.tab="isOpen = false"
    >
    <div class="absolute top-0">
        <svg class="fill-current w-5 text-gray-500 mt-2 ml-2" viewBox="0 0 24 24">
            <path class="heroicon-ui"
                  d="M16.32 14.9l5.39 5.4a1 1 0 01-1.42 1.4l-5.38-5.38a8 8 0 111.41-1.41zM10 16a6 6 0 100-12 6 6 0 000 12z"/>
        </svg>
    </div>
    <div wire:loading class="spinner top-0 right-0 mr-5 mt-5"></div>
    @if (strlen($search) > 2)
        <div
                class="absolute bg-gray-800 rounded w-64 mt-4 text-sm z-50"
                x-show.transition="isOpen"
        >
            @if ($searchResults->count() > 0)
                <ul>
                    @foreach ($searchResults as $result)
                        <li class="border-b border-gray-700">
                            <a
                                    href="{{route('movies.show',$result['id'])}}"
                                    class="block hover:bg-gray-700 px-3 py-3 flex items-center"
                                    @if ($loop->last)
                                    @keydown.tab="isOpen = false"
                                    @endif
                            >
                                @if ($result['poster_path'])
                                    <img src="https://image.tmdb.org/t/p/w92{{$result['poster_path']}}" alt="poster"
                                         class="w-8">
                                @else
                                    <img src="https://via.placeholder.com/50x75" alt="poster" class="w-8">
                                @endif
                                <span class="ml-4">{{$result['title']}}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            @else
                <div class="px-4 py-4">No result found for " {{$search}} "</div>
            @endif
        </div>
    @endif
</div>
