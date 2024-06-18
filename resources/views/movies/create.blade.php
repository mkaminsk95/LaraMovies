@php
    $inputStyling = "block p-4 px-6 w-full rounded-md border-0 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 font-medium focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:leading-6";
    $labelStyling = "block text-sm font-semibold leading-6";
    $textareaStyling = "block h-40 p-4 w-full rounded-md border-0 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-m sm:leading-6";
@endphp

<x-content>
    <div class="mx-20 mt-12 my-6 text-gray-500 sm:text-xl">
        <h1 class="text-center text-2xl">New movie</h1>
        <div class="text-base text-gray-400 pt-10">Fill in the form below to create a new movie</div>
        <form method="POST" action="/movies">
            @csrf

            <div class="border-b dark:border-white/10 pb-12">
                @if($errors->any())
                    <div class="row-start-1 col-span-full">
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                            <strong class="font-bold">Validation error</strong>
                            <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
                <div class="mt-10 grid grid-cols-1 gap-x-12 gap-y-8 sm:grid-cols-6">

                    <div class="row-start-1 sm:col-span-full">
                        <label for="title" class="{{ $labelStyling }}">
                            Title
                        </label>
                        <div class="mt-2">
                            <input type="text" name="title" id="title"
                                   class="{{ $inputStyling }}" required>
                        </div>
                    </div>

                    <div class="row-start-2 col-span-full">
                        <label for="original-title" class="{{ $labelStyling }}">
                            Original title
                        </label>
                        <div class="mt-2">
                            <input type="text" name="original-title" id="original-title"
                                   class="{{ $inputStyling }}" required>
                        </div>
                    </div>

                    <div class="row-start-3 col-span-3">
                        <label for="release-date" class="{{ $labelStyling }}">
                            Release date
                        </label>
                        <div class="mt-2">
                            <input id="release-date" name="release-date" type="date"
                                   class="{{ $inputStyling }}" required>
                        </div>
                    </div>

                    <div class="row-start-3 col-span-3">
                        <x-country-select label="Original language" name="original-language"
                                          id="original-language" required/>
                    </div>

                    <div class="row-start-4 col-span-full">
                        <label for="poster-path" class="{{ $labelStyling }}">
                            Poster path
                        </label>
                        <div class="mt-2">
                            <input type="text" name="poster-path" id="poster-path"
                                   class="{{ $inputStyling }}">
                        </div>
                    </div>

                    <div class="row-start-5 col-span-full">
                        <label for="backdrop-path" class="{{ $labelStyling }}">
                            Backdrop path
                        </label>
                        <div class="mt-2">
                            <input type="text" name="backdrop-path" id="backdrop-path"
                                   class="{{ $inputStyling }}">
                        </div>
                    </div>

                    <div class="row-start-6 col-span-full">
                        <label for="overview" class="{{ $labelStyling }}">
                            Overview
                        </label>
                        <div class="mt-2">
                                <textarea name="overview" id="overview"
                                          class="{{ $textareaStyling }}" required></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-6 flex items-center justify-end gap-x-6">
                <button type="submit"
                        class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    Save
                </button>
            </div>
        </form>
    </div>
</x-content>
