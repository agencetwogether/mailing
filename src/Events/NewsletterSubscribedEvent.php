<?php

namespace Agencetwogether\Mailing\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewsletterSubscribedEvent
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    public function __construct(
        public string $email,
        public array $data = [],
        public array $options = []
    ) {}
}
