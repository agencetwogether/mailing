<?php

namespace Agencetwogether\Mailing\Settings;

use Agencetwogether\Mailing\Enums\MailingProviders;
use Spatie\LaravelSettings\Settings;

class MailingSettings extends Settings
{
    public MailingProviders $provider;

    public ?string $api_key;

    public ?string $api_secret;

    public ?string $list_id;

    public bool $subscription_newsletter;

    public ?array $extra;

    public static function group(): string
    {
        return 'mailing';
    }

    public static function encrypted(): array
    {
        return [
            'api_secret',
        ];
    }
}
