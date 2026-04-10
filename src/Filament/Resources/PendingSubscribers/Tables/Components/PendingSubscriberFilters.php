<?php

namespace Agencetwogether\Mailing\Filament\Resources\PendingSubscribers\Tables\Components;

use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class PendingSubscriberFilters
{
    public static function getPending(): Filter
    {
        return Filter::make('pending')
            ->label(__('mailing::mailing.pending-subscriber.table.filter.pending'))
            ->query(fn (Builder $query): Builder => $query->whereNull('confirmed_at'));
    }

    public static function getConfirmed(): Filter
    {
        return Filter::make('confirmed')
            ->label(__('mailing::mailing.pending-subscriber.table.filter.confirmed'))
            ->query(fn (Builder $query): Builder => $query->whereNotNull('confirmed_at'));
    }
}
