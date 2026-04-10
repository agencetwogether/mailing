<x-app-layout {{--:logo="false"--}} title="{{ $title }}">
    <div class="mx-auto w-5/6">
        <x-filament::section>
            <div class="prose max-w-none">{{ $content }}</div>
        </x-filament::section>
    </div>
</x-app-layout>
