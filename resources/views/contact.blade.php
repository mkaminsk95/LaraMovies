<x-layout>
    <div class="isolate px-6 py-24 sm:py-32 lg:px-8">
        <div class="mx-auto max-w-2xl text-center">
            <h2 class="text-3xl font-bold tracking-tight text-gray-400 sm:text-4xl">Contact us</h2>
            <p class="mt-2 text-lg leading-8 text-gray-600">Tell us about your ideas, concerns, or anything else you'd like to share.<br/>We're here to listen and help!</p>
        </div>
        <form action="/contact" method="POST" class="mx-auto mt-16 max-w-xl sm:mt-20">
            <x-action-status-message/>
            @csrf
            <div class="grid grid-cols-1 gap-x-8 gap-y-6 sm:grid-cols-2">
                <div>
                    <x-input-label for="first-name">First name</x-input-label>
                    <x-text-input id="first-name" name="first-name" autocomplete="given-name" required/>
                </div>
                <div>
                    <x-input-label for="first-name">Last name</x-input-label>
                    <x-text-input id="last-name" name="last-name" autocomplete="family-name" required/>
                </div>
                <div class="sm:col-span-2">
                    <x-input-label for="company">Company</x-input-label>
                    <x-text-input name="company" id="company" autocomplete="organization"/>
                </div>
                <div class="sm:col-span-2">
                    <x-input-label for="user-email">Email</x-input-label>
                    <x-text-input name="user-email" id="user-email" autocomplete="email" type="email" required/>
                </div>
                <div class="sm:col-span-2">
                    <x-input-label for="message">Message</x-input-label>
                    <x-textarea-input rows="4" name="message" id="message" required/>
                </div>

            </div>
            <div class="mt-10">
                <x-primary-button class="box-content w-full mt-6 py-2">Let's talk</x-primary-button>
            </div>
        </form>
    </div>
</x-layout>
