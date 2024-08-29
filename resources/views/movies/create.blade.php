@php
    $labelStyling = "block text-sm font-semibold leading-6";
    $textareaStyling = "block h-40 p-4 w-full rounded-md border-0 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-m sm:leading-6";
@endphp
<x-layout>
    <div
        class="flex flex-col w-5/12 mx-auto mt-10 mb-20 bg-white dark:bg-dark-element">
        <x-action-status-message/>
        <div class="mx-20 mt-12 my-6 sm:text-xl">
            <h1 class="text-center text-2xl">New movie</h1>
            <div class="text-base text-light-text-secondary dark:text-dark-text-secondary pt-10">Fill in the form below
                to create a new movie
            </div>
            <form method="POST" action="/movies">
                @csrf

                <div class="border-b dark:border-white/10 pb-12">
                    <div class="mt-10 grid grid-cols-1 gap-x-12 gap-y-8 sm:grid-cols-6">

                        <div class="row-start-1 sm:col-span-full">
                            <x-input label="Title" id="title" name="title" required/>
                        </div>

                        <div class="row-start-2 col-span-full">
                            <x-input label="Original title" id="original-title" required/>
                        </div>

                        <div class="row-start-3 col-span-3">
                            <x-input label="Release date" id="release-date" type="date" required/>
                        </div>

                        <div class="row-start-3 col-span-3">
                            <x-country-select label="Original language" name="original-language"
                                              id="original-language" required/>
                        </div>

                        <div class="row-start-4 col-span-full">
                            <x-input label="Poster path" id="poster-path"/>
                        </div>

                        <div class="row-start-5 col-span-full">
                            <x-input label="Backdrop path" id="backdrop-path"/>
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
    </div>
</x-layout>
