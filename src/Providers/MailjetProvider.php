<?php

namespace Agencetwogether\Mailing\Providers;

use Agencetwogether\Mailing\Contracts\MailingProviderInterface;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\URL;

class MailjetProvider implements MailingProviderInterface
{
    public function __construct(
        protected array $config
    ) {}

    public function subscribe(string $email, array $data = [], array $options = []): void
    {
        $listId = data_get($options, 'list_id')
            ?? $this->config['list_id_newsletter']
            ?? $this->config['list_id_main'];

        Http::withBasicAuth($this->config['api_key'], $this->config['api_secret'])
            ->post("https://api.mailjet.com/v3/REST/contactslist/{$listId}/managecontact", [
                'Email' => $email,
                'Action' => 'addnoforce',
                'Properties' => $data,
            ])
            ->throw();
    }

    public function sendConfirmationEmail(string $email, string $token, array $data = [], array $options = []): void
    {
        $templateId = $options['template_id']
            ?? $this->config['template_id_confirm_mail'];

        $url = URL::temporarySignedRoute(
            'mailing.confirm',
            now()->addDays($this->config['token_expiration_days'] ?? 2),
            ['token' => $token]
        );

        $full_name = ($data['prénom'] ?? '').' '.($data['nom'] ?? '');

        $body = [
            'Messages' => [[
                'From' => [
                    'Email' => $this->config['mail_from_address'],
                    'Name' => $this->config['mail_from_name'],
                ],
                'To' => [[
                    'Email' => $email,
                    'Name' => trim($full_name),
                ]],
                'TemplateID' => (int) $templateId,
                'TemplateLanguage' => true,
                'Variables' => [
                    'confirmation_link' => $url,
                    'full_name' => trim($full_name),
                ],
            ]],
        ];

        Http::withBasicAuth($this->config['api_key'], $this->config['api_secret'])
            ->post('https://api.mailjet.com/v3.1/send', $body)
            ->throw();
    }
}
