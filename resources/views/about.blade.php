<x-layout>
    <div class="sm:flex sm:flex-row justify-center mt-10 items-center mx-auto max-w-screen-xl">
        <div class="sm:w-fit p-10">
            <div class="image object-center text-center">
                <img src="{{ Vite::asset('resources/assets/images/about_image.png') }}" alt="Illustration">
            </div>
        </div>
        <div class="sm:w-1/2 p-5">
            <div class="text">
                <h2 class="my-4 font-bold text-3xl sm:text-4xl dark:text-gray-300">About <span class="text-indigo-600">Our Company</span>
                </h2>
                <p class="text-gray-700">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid, commodi
                    doloremque, fugiat illum magni minus nisi nulla numquam obcaecati placeat quia, repellat tempore
                    voluptatum.
                </p>
            </div>
        </div>
    </div>
</x-layout>
