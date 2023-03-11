<div class="font-sans text-gray-900 antialiased" dir={{ LaravelLocalization::getCurrentLocaleDirection() }}>
    <x-nav-link>

    </x-nav-link>
    @if (count(config('translatable.locales')) > 1)
        @if (LaravelLocalization::getCurrentLocale() == 'ar')
            <x-nav-link rel="alternate" hreflang="{{ 'en' }}"
                href="{{ LaravelLocalization::getLocalizedURL('en', null, [], true) }}">
                {{ 'English' }}
                <img src="{{ URL::asset('flags/US.png') }}" alt="">

            </x-nav-link>
        @else
            <x-nav-link rel="alternate" hreflang="{{ 'ar' }}"
                href="{{ LaravelLocalization::getLocalizedURL('ar', null, [], true) }}">
                <img src="{{ URL::asset('flags/EG.png') }}" alt="">
                {{ 'عربي' }}

            </x-nav-link>
        @endif
    @endif

    {{ $slot }}
</div>
