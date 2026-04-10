@php
    use Agencetwogether\Mailing\Settings\MailingSettings;
    use Agencetwogether\Mailing\Filament\Forms\Components\RichEditor\RichContentCustomBlocks\ButtonBlock;
    use Filament\Forms\Components\RichEditor\RichContentRenderer;
@endphp

<x-app-layout {{--:logo="false"--}} title="{{ $title }}">
    <div class="mx-auto w-5/6">
        <x-filament::section>
            <div class="prose max-w-none">
                {{
                    RichContentRenderer::make(
                        app(MailingSettings::class)->text_confirmed['content'],
                    )->customBlocks([ButtonBlock::class])
                }}
            </div>
        </x-filament::section>
    </div>
</x-app-layout>
