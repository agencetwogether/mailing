<?php

namespace Agencetwogether\Mailing\Services;

use Agencetwogether\Mailing\Enums\MailingProviders;
use Agencetwogether\Mailing\Exceptions\MailingException;
use Agencetwogether\Mailing\Providers\BrevoProvider;
use Agencetwogether\Mailing\Providers\MailchimpProvider;
use Agencetwogether\Mailing\Providers\MailjetProvider;
use Agencetwogether\Mailing\Settings\MailingSettings;
use Exception;
use Throwable;

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

    public function subscribe(string $email, array $data = [], array $options = []): void
    {
        try {
            $this->driver()->subscribe($email, $data, $options);

        } catch (Throwable $e) {
            throw new MailingException(
                'Failed to subscribe user',
                previous: $e
            );
        }
    }

    public function sendConfirmationEmail(string $email, string $token, array $data = [], array $options = []): void
    {
        try {
            $this->driver()->sendConfirmationEmail($email, $token, $data, $options);

        } catch (Throwable $e) {
            throw new MailingException(
                'Failed to send confirmation email',
                previous: $e
            );
        }
    }
}
