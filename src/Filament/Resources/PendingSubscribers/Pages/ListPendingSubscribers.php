<?php

namespace Agencetwogether\Mailing\Filament\Resources\PendingSubscribers\Pages;

use Agencetwogether\Mailing\Filament\Resources\PendingSubscribers\PendingSubscriberResource;
use Filament\Resources\Pages\ListRecords;

class ListPendingSubscribers extends ListRecords
{
    protected static string $resource = PendingSubscriberResource::class;

    public function getTitle(): string
    {
        return __('mailing::mailing.pending-subscriber.pages.list.title');
    }
}
