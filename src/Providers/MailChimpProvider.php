<?php

namespace Agencetwogether\Mailing\Providers;

use Agencetwogether\Mailing\Contracts\MailingProviderInterface;

class MailchimpProvider implements MailingProviderInterface
{
    public function __construct(protected array $config) {}

    public function subscribe(string $email, array $data = [], array $options = []): void
    {
        // Exemple simplifié
        // Http::withToken($this->config['api_key'])->post(...);
    }
}
