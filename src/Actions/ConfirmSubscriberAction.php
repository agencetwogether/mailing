<?php

namespace Agencetwogether\Mailing\Actions;

use Agencetwogether\Mailing\Models\PendingSubscriber;
use Agencetwogether\Mailing\Services\MailingManager;
use Agencetwogether\Mailing\Settings\MailingSettings;

class ConfirmSubscriberAction
{
    public function __construct(
        private MailingSettings $settings,
        private MailingManager $manager
    ) {}

    public function execute(string $token): bool
    {
        $subscriber = PendingSubscriber::where('token', $token)
            // ->whereNull('confirmed_at')
            ->where('created_at', '>=', now()->subDays($this->settings->token_expiration_days ?? 2))
            ->firstOrFail();

        if ($subscriber->confirmed_at) {
            return false;
        }

        $subscriber->update([
            'confirmed_at' => now(),
        ]);

        $this->manager->subscribe(
            $subscriber->email,
            $subscriber->data ?? [],
            $subscriber->options ?? []
        );

        return true;
    }
}
