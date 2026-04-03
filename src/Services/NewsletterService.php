<?php

namespace Agencetwogether\Mailing\Services;

class NewsletterService
{
    public function __construct(
        protected MailingManager $manager
    ) {}

    public function subscribe(
        string $email,
        array $data = [],
        array $options = []
    ): void {
        $this->manager
            ->driver()
            ->subscribe($email, $data, $options);
    }
}
