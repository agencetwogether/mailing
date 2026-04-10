<?php

namespace Agencetwogether\Mailing;

use Agencetwogether\Mailing\Filament\Pages\ManageMailingSettings;
use Agencetwogether\Mailing\Filament\Resources\PendingSubscribers\PendingSubscriberResource;
use Filament\Contracts\Plugin;
use Filament\Panel;

class MailingPlugin implements Plugin
{
    public static function make(): static
    {
        return app(static::class);
    }

    public function getId(): string
    {
        return 'mailing';
    }

    public function register(Panel $panel): void
    {
        $panel
            ->resources([
                PendingSubscriberResource::class,
            ])
            ->pages([
                ManageMailingSettings::class,
            ]);
    }

    public function boot(Panel $panel): void
    {
        //
    }

    public static function get(): static
    {
        /** @var static $plugin */
        $plugin = filament(app(static::class)->getId());

        return $plugin;
    }
}
