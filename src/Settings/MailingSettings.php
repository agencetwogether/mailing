<?php

namespace Agencetwogether\Mailing\Settings;

use Agencetwogether\Mailing\Enums\MailingProviders;
use Spatie\LaravelSettings\Settings;

class MailingSettings extends Settings
{
    // General
    public MailingProviders $provider;

    public ?string $api_key;

    public ?string $api_secret;

    public ?string $list_id_main;

    public ?array $extra;

    // Newsletter
    public bool $subscription_newsletter;

    public int $token_expiration_days;

    public ?string $list_id_newsletter;

    public ?string $mail_from_address;

    public ?string $mail_from_name;

    public ?string $template_id_confirm_mail;

    public array $text_confirmed;

    public array $buttons_newsletter_form;

    // Newsletter form
    public array $text_newsletter_form;

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
