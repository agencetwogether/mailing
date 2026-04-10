<?php

namespace Agencetwogether\Mailing\Actions;

use Agencetwogether\Mailing\Models\PendingSubscriber;
use Agencetwogether\Mailing\Services\MailingManager;
use Illuminate\Support\Str;

class RequestDoubleOptInAction
{
    public function __construct(
        protected MailingManager $manager
    ) {}

    public function execute(string $email, array $data = [], array $options = []): void
    {
        $token = hash('sha256', Str::uuid()->toString());

        PendingSubscriber::create([
            'email' => $email,
            'data' => $data,
            'options' => $options,
            'token' => $token,
        ]);

        // Send email to confirm
        $this->manager->sendConfirmationEmail(
            $email,
            $token,
            $data,
            $options
        );

    }
}
