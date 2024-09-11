<div class="flex flex-row gap-3 sm:gap-6 w-fit min-w-[150px] sm:min-w-[300px] mt-3 lg:mt-6 pr-4 text-xs lg:text-sm">

    <div class="flex flex-col gap-1">
        <div>
            <span class="text-light-text-secondary dark:text-dark-text-secondary">{{ __('Runtime') }}</span><br/>
            {{ $runtimeFormatted }}
        </div>
        <div>
            <span class="text-light-text-secondary dark:text-dark-text-secondary">{{ __('Director') }}</span><br/>
            {{ $directors ?: __('-') }}
        </div>
        <div>
            <span class="text-light-text-secondary dark:text-dark-text-secondary">{{ __('Budget') }}</span><br/>
            {{ $movieBudget }}
        </div>
    </div>

    <div class="flex flex-col gap-1 justify-end">
        <div>
            <span class="text-light-text-secondary dark:text-dark-text-secondary">{{ __('Screenplay') }}</span><br/>
            {{ $screenwriters ?: __('-') }}
        </div>
        <div>
            <span class="text-light-text-secondary dark:text-dark-text-secondary">{{ __('Revenue') }}</span><br/>
            {{ $movieRevenue }}
        </div>

    </div>
</div>
