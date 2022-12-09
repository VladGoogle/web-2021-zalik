<div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
    <div class="grid grid-cols-1 md:grid-cols-2">
{{--        @if($person)--}}
            {{ $person->first_name }}
            {{ $person->last_name }}
            {{ $person->middle_name }}
{{--        @endif--}}
    </div>
</div>
