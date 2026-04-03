<?php

namespace Agencetwogether\Mailing\Settings;

use Spatie\LaravelSettings\Settings;

class MailingSettings extends Settings
{
    public string $provider;

    public ?string $api_key;

    public ?string $api_secret;

    public ?string $list_id;

    public ?array $extra;

    public static function group(): string
    {
        return 'mailing';
    }
}
