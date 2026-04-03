<?php

namespace Agencetwogether\Mailing\Contracts;

interface MailingProviderInterface
{
    public function subscribe(
        string $email,
        array $data = [],
        array $options = []
    ): void;
}
