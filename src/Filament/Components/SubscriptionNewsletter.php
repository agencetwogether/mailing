<?php

namespace Agencetwogether\Mailing\Filament\Components;

use Agencetwogether\Mailing\Settings\MailingSettings;
use Filament\Forms\Components\Toggle;

class SubscriptionNewsletter extends Toggle
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

        $this->label('Recevoir les actualités de la paroisse');

        $this->onColor('success');

        $this->visible(fn () => app(MailingSettings::class)->subscription_newsletter);
    }
}
