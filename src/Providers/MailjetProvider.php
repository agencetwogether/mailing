<?php

namespace Agencetwogether\Mailing\Providers;

use Agencetwogether\Mailing\Contracts\MailingProviderInterface;
use Illuminate\Support\Facades\Http;
use RuntimeException;

class MailjetProvider implements MailingProviderInterface
{
    public function __construct(protected array $config) {}

    public function subscribe(string $email, array $data = [], array $options = []): void
    {
        $listId = $options['list_id'] ?? $this->config['list_id'];

        // Exemple simplifié
        // Http::withToken($this->config['api_key'])->post(...);
        $response = Http::withBasicAuth($this->config['api_key'], $this->config['api_secret'])
            ->post('https://api.mailjet.com/v3/REST/contactslist/'.$listId.'/managecontact', [
                'Email' => $email,
                'Action' => 'addnoforce',
                'Properties' => $data,
            ]);

        if ($response->failed()) {
            throw new RuntimeException('Mailjet subscription failed: '.$response->body());
        }
    }
}
