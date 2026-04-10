<?php

namespace Agencetwogether\Mailing\Filament\Components;

use Agencetwogether\Mailing\Actions\RequestDoubleOptInAction;
use Agencetwogether\Mailing\Exceptions\MailingException;
use Agencetwogether\Mailing\Settings\MailingSettings;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use Illuminate\Contracts\View\View;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;
use Livewire\Component;
use Ysfkaya\FilamentPhoneInput\Forms\PhoneInput;

class SubscriptionNewsletterForm extends Component implements HasActions, HasSchemas
{
    use InteractsWithActions;
    use InteractsWithSchemas;

    public bool $sent = false;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make()
                    ->schema([
                        TextInput::make('name')
                            ->label(__('mailing::mailing.subscription_newsletter.form.label.name'))
                            ->placeholder(__('mailing::mailing.subscription_newsletter.form.placeholder.name'))
                            ->columnSpanFull()
                            ->required(),
                        TextInput::make('firstname')
                            ->label(__('mailing::mailing.subscription_newsletter.form.label.firstname'))
                            ->placeholder(__('mailing::mailing.subscription_newsletter.form.placeholder.firstname'))
                            ->columnSpanFull()
                            ->required(),
                        TextInput::make('email')
                            ->label(__('mailing::mailing.subscription_newsletter.form.label.email'))
                            ->placeholder(__('mailing::mailing.subscription_newsletter.form.placeholder.email'))
                            ->email()
                            ->rules(['email:rfc,dns'])
                            ->columnSpanFull()
                            ->required(),
                        PhoneInput::make('phone')
                            ->label(__('mailing::mailing.subscription_newsletter.form.label.phone'))
                            ->placeholder(__('mailing::mailing.subscription_newsletter.form.placeholder.phone'))
                            ->columnSpanFull(),
                        TextInput::make('postal_code')
                            ->label(__('mailing::mailing.subscription_newsletter.form.label.postal_code'))
                            ->placeholder(__('mailing::mailing.subscription_newsletter.form.placeholder.postal_code'))
                            ->regex('/\b\d{5}\b/')
                            ->columnSpan(2),
                        TextInput::make('city')
                            ->label(__('mailing::mailing.subscription_newsletter.form.label.city'))
                            ->placeholder(__('mailing::mailing.subscription_newsletter.form.placeholder.city'))
                            ->columnSpan(3),
                        Toggle::make('consent')
                            ->label(fn (MailingSettings $settings): HtmlString => new HtmlString(filled($settings->text_newsletter_form['consent']) && $settings->text_newsletter_form['consent'] !== '<p></p>' ? $settings->text_newsletter_form['consent'] : __('mailing::mailing.subscription_newsletter.form.placeholder.consent')))
                            ->validationAttribute(__('mailing::mailing.subscription_newsletter.form.label.consent'))
                            ->columnSpanFull()
                            ->accepted(),
                    ])
                    ->columns(5),
            ])
            ->statePath('data');
    }

    public function submitAction(): Action
    {
        return Action::make('submit')
            ->label(fn (MailingSettings $settings): string => data_get($settings, 'buttons_newsletter_form.submit.label') ?? __('mailing::mailing.subscription_newsletter.form.actions.submit'))
            ->color(fn (MailingSettings $settings): string => data_get($settings, 'buttons_newsletter_form.submit.color') ?? 'primary')
            ->submit('form');
    }

    public function backAction(): Action
    {
        return Action::make('back')
            ->label(fn (MailingSettings $settings): string => data_get($settings, 'buttons_newsletter_form.secondary.label') ?? __('mailing::mailing.subscription_newsletter.form.actions.back'))
            ->color(fn (MailingSettings $settings): string => data_get($settings, 'buttons_newsletter_form.secondary.color') ?? 'gray')
            ->outlined(fn (MailingSettings $settings): bool => data_get($settings, 'buttons_newsletter_form.secondary.outlined') ?? false)
            ->url(fn (MailingSettings $settings): string => data_get($settings, 'buttons_newsletter_form.secondary.url') ?? getClientWebsite())
            ->visible(fn (MailingSettings $settings): bool => data_get($settings, 'buttons_newsletter_form.secondary.active') ?? false);
    }

    public function subscribe(): void
    {
        try {
            $data = $this->form->getState();

            app(RequestDoubleOptInAction::class)->execute(
                $data['email'],
                [
                    'prénom' => Str::title($data['firstname']),
                    'nom' => Str::title($data['name']),
                    'ville' => $data['city'] ? Str::title($data['city']) : '',
                    'code_postal' => $data['postal_code'] ?? '',
                    'telephone' => $data['phone'] ?? '',
                ],
            );
        } catch (MailingException $e) {

            report($e);
        }

        // Reset form
        $this->form->fill();
        $this->sent = true;

    }

    public function render(): View
    {
        return view('mailing::subscription-newsletter-form');
    }
}
