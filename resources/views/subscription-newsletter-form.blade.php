@php
    use Agencetwogether\Mailing\Settings\MailingSettings;
    use Filament\Forms\Components\RichEditor\RichContentRenderer;
@endphp
<div class="mt-16">
    @if ($sent)
        @include ('mailing::subscription-newsletter-submitted')
    @else
        <x-filament::section>
            <div class="prose mt-8 mb-16 max-w-none text-center">
                {{
                    RichContentRenderer::make(
                        app(MailingSettings::class)->text_newsletter_form['content'],
                    )
                }}
            </div>
            <form class="not-prose grid gap-y-8" wire:submit="subscribe">
                {{ $this->form }}
                <div class="flex @if ($this->backAction->isVisible()) justify-between @else justify-end @endif">
                    @if ($this->backAction->isVisible())
                        {{ $this->backAction }}
                    @endif
                    {{ $this->submitAction }}
                </div>
            </form>
        </x-filament::section>
    @endif
    <x-filament-actions::modals />
</div>
