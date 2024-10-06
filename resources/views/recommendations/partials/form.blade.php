<form id="recommendationsForm" class="w-2/3 md:w-2/5 mx-auto pt-12 pb-4">
    @csrf
    <div>
        <x-inputs.label for="genre">{{ __('Genre') }}</x-inputs.label>
        <x-inputs.select id="genre" name="genre" :options="$genres" value="Any" required
                         :displayEmptyOption="false"/>
    </div>
    <div>
        <x-inputs.label title="{{ __('This note will work as additional input for AI prompt.') }}" class="flex flex-rows gap-0.5" for="note">
            <span>{{ __('Note') }}</span>
            <span>
                            <svg height="14" viewBox="0 0 48 48" width="14" xmlns="http://www.w3.org/2000/svg"><path d="M0 0h48v48h-48z" fill="none"/><path fill="currentColor" d="M24 4c-11.05 0-20 8.95-20 20s8.95 20 20 20 20-8.95 20-20-8.95-20-20-20zm2 30h-4v-12h4v12zm0-16h-4v-4h4v4z"/></svg>
                        </span>
        </x-inputs.label>
        <x-inputs.textarea id="note" placeholder="{{ __('messages.recommendations_note_placeholder') }}"
                           name="note"
                           rows="4"
                           maxlength="200"/>
    </div>
    <x-buttons.primary
        id="submit-button" class="h-[35px] w-fit float-right mt-12 box-content py-1 px-3">{{ __('Get recommendations') }}
    </x-buttons.primary>
</form>
