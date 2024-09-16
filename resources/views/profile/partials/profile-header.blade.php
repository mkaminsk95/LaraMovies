<div x-data="{ chosenAvatarId: '', avatarHovered: false }">
    <x-modal maxWidth="xl" name="test" focusable>
        <div class="p-10 bg-light-element-secondary dark:bg-gray-800 shadow-lg">
            <p class="text-center text-xl">{{ __('Choose a picture') }}</p>
            <div class="pt-8 grid grid-cols-3 sm:grid-cols-6 gap-2">
                @foreach($avatars as $avatar)
                    <div class="rounded-full">
                        <img x-avatar-id="{{ $avatar->id }}" @click="chosenAvatarId = $el.getAttribute('x-avatar-id')"
                             :class="chosenAvatarId == $el.getAttribute('x-avatar-id') ? 'outline outline-4 outline-accent-primary/50' : ''"
                             class="h-[80px] w-[80px] rounded-full"
                             src="{{ Vite::asset('resources/assets/avatars/'.$avatar->path) }}"
                             alt="Avatar">
                    </div>
                @endforeach
            </div>

            <x-message id="message" class="mt-5 hidden" type="error" messages="test"></x-message>

            <div class="mt-10 flex justify-end">
                <x-buttons.secondary x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-buttons.secondary>

                <x-buttons.primary x-on:click="$dispatch('changeAvatar', { id: chosenAvatarId })" class="ms-3">
                    {{ __('Change') }}
                </x-buttons.primary>
            </div>
        </div>
    </x-modal>

    <div class="relative">
        @if(!is_null($topRated) && !is_null($topRated['backdrop_path']))
            <img class="object-cover w-full h-[300px] lg:h-[400px] rounded"
                 src="https://image.tmdb.org/t/p/w1280/{{ $topRated['backdrop_path'] }}" alt="poster">
        @else
            <img class="object-cover w-full h-[300px] lg:h-[400px] rounded"
                 src="https://dummyimage.com/1280x720/d2d5db/fff&text=+" alt="poster">
        @endif
        <div
            class="h-full w-full absolute -translate-y-full text-white bg-gradient-to-t from-gray-900 to-transparent ">
        </div>
        <div class="absolute bottom-10 left-12 flex flex-row items-center">
            @if ($user['avatar_id'])
                @if($isMe)
                    <div class="w-24 h-24"
                         x-on:mouseover="avatarHovered = true" x-on:mouseleave="avatarHovered = false">
                        <img
                            class="rounded-full border-4 border-white dark:border-gray-800"
                            src="{{ Vite::asset('resources/assets/avatars/'.$user->avatar->path) }}"
                            alt="profile">
                        <div x-on:click="$dispatch('open-modal', 'test')" x-show="avatarHovered"
                             x-transition.duration.400ms
                             class="flex justify-center items-center w-24 h-24 absolute top-0">
                            <div class="absolute w-24 h-24 bg-black opacity-50 rounded-full">
                            </div>
                            <svg class="h-10 w-10 z-10" data-name="Layer 1" viewBox="0 0 24 24"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path fill="#bdbdbd"
                                      d="M12.29,5.21l1.5,1.5a1,1,0,0,0,1.42,0,1,1,0,0,0,.13-1.21H19a1,1,0,0,0,0-2H15.34a1,1,0,0,0-.13-1.21,1,1,0,0,0-1.42,0l-1.5,1.5a1,1,0,0,0-.21.33,1,1,0,0,0,0,.76A1,1,0,0,0,12.29,5.21ZM22.92,9.12a1,1,0,0,0-.21-.33l-1.5-1.5a1,1,0,0,0-1.42,0,1,1,0,0,0-.13,1.21H16a1,1,0,0,0,0,2h3.66a1,1,0,0,0,.13,1.21,1,1,0,0,0,1.42,0l1.5-1.5a1,1,0,0,0,.21-.33A1,1,0,0,0,22.92,9.12ZM11,10a4,4,0,1,0,4,4A4,4,0,0,0,11,10Zm0,6a2,2,0,1,1,2-2A2,2,0,0,1,11,16Zm9-3a1,1,0,0,0-1,1v5a1,1,0,0,1-1,1H4a1,1,0,0,1-1-1V11a1,1,0,0,1,1-1H6a1,1,0,0,0,1-.69l.54-1.62A1,1,0,0,1,8.44,7H10a1,1,0,0,0,0-2H8.44A3,3,0,0,0,5.59,7.06L5.28,8H4a3,3,0,0,0-3,3v8a3,3,0,0,0,3,3H18a3,3,0,0,0,3-3V14A1,1,0,0,0,20,13Z"/>
                            </svg>
                        </div>
                    </div>
                @else
                    <div class="w-24 h-24">
                        <img
                            class="rounded-full border-4 border-white dark:border-gray-800"
                            src="{{ Vite::asset('resources/assets/avatars/'.$user->avatar->path) }}"
                            alt="profile">
                    </div>
                @endif
            @else
                @if($isMe)
                    <img x-on:click="$dispatch('open-modal', 'test')"
                         class="w-24 h-24 rounded-full border-4 border-white dark:border-gray-800"
                         src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png"
                         alt="profile">
                @else
                    <img class="w-24 h-24 rounded-full border-4 border-white dark:border-gray-800"
                         src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png"
                         alt="profile">
                @endif
            @endif
            <span class="pl-5 text-white text-3xl tracking-wider">{{ $user->name }}</span>
        </div>

        @if($isMe)
            <a href="{{ route('profile.edit', $user->id) }}">
                <svg class="absolute top-[30px] right-[50px] w-10 h-10" viewBox="0 0 48 48"
                     xmlns="http://www.w3.org/2000/svg" x-data="{ placeholder: 'rgba(255, 255, 255, 0.7)' }"
                     x-on:mouseenter="placeholder= 'rgba(255, 255, 255, 1)'"
                     x-on:mouseleave="placeholder= 'rgba(255, 255, 255, 0.7)'">
                    <path x-bind:fill="placeholder"
                          d="M38.86 25.95c.08-.64.14-1.29.14-1.95s-.06-1.31-.14-1.95l4.23-3.31c.38-.3.49-.84.24-1.28l-4-6.93c-.25-.43-.77-.61-1.22-.43l-4.98 2.01c-1.03-.79-2.16-1.46-3.38-1.97l-.75-5.3c-.09-.47-.5-.84-1-.84h-8c-.5 0-.91.37-.99.84l-.75 5.3c-1.22.51-2.35 1.17-3.38 1.97l-4.98-2.01c-.45-.17-.97 0-1.22.43l-4 6.93c-.25.43-.14.97.24 1.28l4.22 3.31c-.08.64-.14 1.29-.14 1.95s.06 1.31.14 1.95l-4.22 3.31c-.38.3-.49.84-.24 1.28l4 6.93c.25.43.77.61 1.22.43l4.98-2.01c1.03.79 2.16 1.46 3.38 1.97l.75 5.3c.08.47.49.84.99.84h8c.5 0 .91-.37.99-.84l.75-5.3c1.22-.51 2.35-1.17 3.38-1.97l4.98 2.01c.45.17.97 0 1.22-.43l4-6.93c.25-.43.14-.97-.24-1.28l-4.22-3.31zm-14.86 5.05c-3.87 0-7-3.13-7-7s3.13-7 7-7 7 3.13 7 7-3.13 7-7 7z"/>
                </svg>
            </a>
        @endif
    </div>
</div>
@vite('resources/js/message.js')
<script>
    document.addEventListener('changeAvatar', (data) => {
        const id = data.detail.id;
        fetch(
            '/profile/update-avatar?avatarId=' + id,
            {
                method: 'PATCH',
                redirect: 'follow',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            }
        ).then(
            response => response.json()
        ).then(data => {
            if (data.status === 'success') {
                window.location.reload();
            } else if (data.status === 'error') {
                window.messagePanel.error(data.message);
            }
        }).catch(error => {
            console.error('{{ __('There has been a problem with your fetch operation:') }}', error);
        });
    });
</script>
