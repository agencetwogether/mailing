<?php

namespace Agencetwogether\Mailing\Listeners;

use Agencetwogether\Mailing\Events\NewsletterSubscribedEvent;
use Agencetwogether\Mailing\Services\NewsletterService;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewsletterSubscribedListener implements ShouldQueue
{
    public function handle(NewsletterSubscribedEvent $event): void
    {
        app(NewsletterService::class)->subscribe(
            $event->email,
            $event->data
        );
    }
}
