<x-layout.base>
    <x-action-status-message/>
    <div class="flex flex-col mx-auto max-w-3xl my-14 bg-light-element dark:bg-dark-element text-light-text-primary dark:text-dark-text-primary shadow-lg rounded">
        <div class="mx-20 my-16 sm:text-xl">
            <div class="mx-auto max-w-2xl text-center">
                <h2 class="text-xl font-bold tracking-tight sm:text-2xl">{{ __('Edit movie') }}</h2>
                <p class="mt-2 text-base leading-8 text-light-text-secondary dark:text-dark-text-secondary">{{ __('Fill in the form below to edit a new movie.') }}</p>
            </div>
            <form method="POST" action="{{ route('movies.update', $movie->id) }}">
                @csrf
                @method('PATCH')
                <div class="pb-12">
                    <div class="mt-10 grid grid-cols-2 gap-x-12 gap-y-8">

                        <div class="row-start-1 col-span-full">
                            <x-inputs.label for="title">{{ __('Title') }}</x-inputs.label>
                            <x-inputs.text id="title" name="title" value="{{$movie->title}}" required/>
                        </div>

                        <div class="row-start-2 col-span-full">
                            <x-inputs.label for="original-title">{{ __('Original title') }}</x-inputs.label>
                            <x-inputs.text id="original-title" name="original-title" value="{{$movie->original_title}}" required/>
                        </div>

                        <div class="row-start-3 col-span-1">
                            <x-inputs.label for="release-date">{{ __('Release date') }}</x-inputs.label>
                            <x-inputs.text id="release-date" name="release-date" value="{{$movie->release_date}}" type="date" required/>
                        </div>

                        <div class="row-start-3 col-span-1">
                            <x-inputs.label for="original-language">{{ __('Original language') }}</x-inputs.label>
                            <x-inputs.country-select label="Original language" name="original-language"
                                              :selected="$movie->original_language"
                                              id="original-language" required/>
                        </div>

                        <div class="row-start-4 col-span-full">
                            <x-inputs.label for="poster-path">{{ __('Poster path') }}</x-inputs.label>
                            <x-inputs.text id="poster-path" name="poster-path" value="{{$movie->poster_path}}}" required/>
                        </div>

                        <div class="row-start-5 col-span-full">
                            <x-inputs.label for="backdrop-path">{{ __('Backdrop path') }}</x-inputs.label>
                            <x-inputs.text id="backdrop-path" name="backdrop-path" value="{{$movie->backdrop_path}}}" required/>
                        </div>

                        <div class="row-start-6 col-span-full">
                            <x-inputs.label for="overview">{{ __('Overview') }}</x-inputs.label>
                            <x-inputs.textarea rows="5" id="overview" name="overview" value="{{$movie->overview}}" required/>
                        </div>
                    </div>
                </div>
                <x-buttons.primary class="box-content w-full py-2">{{ __('Save') }}</x-buttons.primary>
            </form>
        </div>
    </div>
</x-layout.base>
