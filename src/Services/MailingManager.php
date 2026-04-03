<?php

namespace Agencetwogether\Mailing\Services;

use Agencetwogether\Mailing\Enums\MailingProviders;
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
            MailingProviders::MAILCHIMP => new MailchimpProvider($this->settings->toArray()),
            MailingProviders::BREVO => new BrevoProvider($this->settings->toArray()),
            MailingProviders::MAILJET => new MailjetProvider($this->settings->toArray()),
            default => throw new Exception('Not supported Driver mailing'),
        };
    }
}
