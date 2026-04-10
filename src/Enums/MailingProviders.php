<?php

namespace Agencetwogether\Mailing\Enums;

use Filament\Support\Contracts\HasLabel;

enum MailingProviders: string implements HasLabel
{
    case BREVO = 'brevo';
    case MAILCHIMP = 'mailchimp';
    case MAILJET = 'mailjet';

    public function getLabel(): string
    {
        return match ($this) {
            self::BREVO => 'Brevo',
            self::MAILCHIMP => 'MailChimp',
            self::MAILJET => 'Mailjet',
        };
    }
}
