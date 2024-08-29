<x-layout>
    <x-action-status-message/>
    <div class="flex flex-col mx-auto max-w-3xl my-14 bg-light-element dark:bg-dark-element text-light-text-primary dark:text-dark-text-primary shadow-lg rounded">
        <div class="mx-20 my-16 sm:text-xl">
            <div class="mx-auto max-w-2xl text-center">
                <h2 class="text-xl font-bold tracking-tight sm:text-2xl">Edit movie</h2>
                <p class="mt-2 text-base leading-8 text-light-text-secondary dark:text-dark-text-secondary">Fill in the form below to edit a new movie.</p>
            </div>
            <form method="POST" action="{{ route('movies.update', $movie->id) }}">
                @csrf
                @method('PATCH')
                <div class="pb-12">
                    <div class="mt-10 grid grid-cols-2 gap-x-12 gap-y-8">

                        <div class="row-start-1 col-span-full">
                            <x-input-label for="title">Title</x-input-label>
                            <x-text-input id="title" name="title" value="{{$movie->title}}" required/>
                        </div>

                        <div class="row-start-2 col-span-full">
                            <x-input-label for="original-title">Original title</x-input-label>
                            <x-text-input id="original-title" name="original-title" value="{{$movie->original_title}}" required/>
                        </div>

                        <div class="row-start-3 col-span-1">
                            <x-input-label for="release-date">Release date</x-input-label>
                            <x-text-input id="release-date" name="release-date" value="{{$movie->release_date}}" type="date" required/>
                        </div>

                        <div class="row-start-3 col-span-1">
                            <x-input-label for="original-language">Original language</x-input-label>
                            <x-country-select label="Original language" name="original-language"
                                              :selected="$movie->original_language"
                                              id="original-language" required/>
                        </div>

                        <div class="row-start-4 col-span-full">
                            <x-input-label for="poster-path">Poster path</x-input-label>
                            <x-text-input id="poster-path" name="poster-path" value="{{$movie->poster_path}}}" required/>
                        </div>

                        <div class="row-start-5 col-span-full">
                            <x-input-label for="backdrop-path">Backdrop path</x-input-label>
                            <x-text-input id="backdrop-path" name="backdrop-path" value="{{$movie->backdrop_path}}}" required/>
                        </div>

                        <div class="row-start-6 col-span-full">
                            <x-input-label for="overview">Overview</x-input-label>
                            <x-textarea-input rows="5" id="overview" name="overview" value="{{$movie->overview}}" required/>
                        </div>
                    </div>
                </div>
                <x-primary-button class="box-content w-full py-2">Save</x-primary-button>
            </form>
        </div>
    </div>
</x-layout>
