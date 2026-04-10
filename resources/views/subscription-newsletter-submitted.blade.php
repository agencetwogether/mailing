@php
    use Agencetwogether\Mailing\Filament\Forms\Components\RichEditor\RichContentCustomBlocks\ButtonBlock;
    use Agencetwogether\Mailing\Settings\MailingSettings;
    use Filament\Forms\Components\RichEditor\RichContentRenderer;
@endphp

<x-filament::section>
    <div class="prose max-w-none text-center">
        {{
            RichContentRenderer::make(
                app(MailingSettings::class)->text_newsletter_form['submitted'],
            )->customBlocks([ButtonBlock::class])
        }}
    </div>
</x-filament::section>
