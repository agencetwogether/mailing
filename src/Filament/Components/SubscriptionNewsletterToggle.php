<?php

namespace Agencetwogether\Mailing\Filament\Components;

use Agencetwogether\Mailing\Settings\MailingSettings;
use Filament\Forms\Components\Toggle;

class SubscriptionNewsletterToggle extends Toggle
{
    public static function make(?string $name = null): static
    {
        $name ??= 'subscribe_newsletter';

        $static = app(static::class, ['name' => $name]);
        $static->configure();

        return $static;
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->label(__('mailing::mailing.subscription_newsletter_toggle.label'));

        $this->onColor('success');

        $this->visible(fn (MailingSettings $settings): bool => $settings->subscription_newsletter);
    }
}
