<?php

namespace Agencetwogether\Mailing\Services;

use Agencetwogether\Mailing\Providers\BrevoProvider;
use Agencetwogether\Mailing\Providers\MailchimpProvider;
use Agencetwogether\Mailing\Providers\MailjetProvider;
use Agencetwogether\Mailing\Settings\MailingSettings;
use Exception;

class MailingManager
{
    public function __construct(
        protected MailingSettings $settings
    ) {}

    public function driver()
    {
        return match ($this->settings->provider) {
            'mailchimp' => new MailchimpProvider($this->settings->toArray()),
            'brevo' => new BrevoProvider($this->settings->toArray()),
            'mailjet' => new MailjetProvider($this->settings->toArray()),
            default => throw new Exception('Not supported Driver mailing'),
        };
    }
}
