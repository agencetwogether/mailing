<?php

namespace Agencetwogether\Mailing\Filament\Resources\PendingSubscribers\Tables\Components;

use Agencetwogether\Mailing\Settings\MailingSettings;
use Carbon\Carbon;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;

class PendingSubscriberColumns
{
    public static function getEmail(): TextColumn
    {
        return TextColumn::make('email')
            ->label(__('mailing::mailing.pending-subscriber.table.label.email'))
            ->searchable()
            ->sortable();
    }

    public static function getFirstname(): TextColumn
    {
        return TextColumn::make('data.prénom')
            ->label(__('mailing::mailing.pending-subscriber.table.label.firstname'));
    }

    public static function getName(): TextColumn
    {
        return TextColumn::make('data.nom')
            ->label(__('mailing::mailing.pending-subscriber.table.label.name'));
    }

    public static function getConfirmedAt(): TextColumn
    {
        return TextColumn::make('confirmed_at')
            ->label(__('mailing::mailing.pending-subscriber.table.label.confirmed_at'))
            ->state(fn (Model $record): string => filled($record->confirmed_at) ? __('mailing::mailing.pending-subscriber.table.states.confirmed') : __('mailing::mailing.pending-subscriber.table.states.pending'))
            ->badge()
            ->colors([
                'success' => fn (Model $record): bool => filled($record->confirmed_at),
                'warning' => fn (Model $record): bool => blank($record->confirmed_at),
            ]);
    }

    public static function getCreatedAt(): TextColumn
    {
        return TextColumn::make('created_at')
            ->label(__('mailing::mailing.pending-subscriber.table.label.created_at'))
            ->formatStateUsing(fn (Carbon $state, MailingSettings $settings): string => $state->diffInDays(now()) > $settings->token_expiration_days ? __('mailing::mailing.pending-subscriber.table.states.expired') : __('mailing::mailing.pending-subscriber.table.states.valid'))
            ->badge()
            ->colors([
                'danger' => fn (Carbon $state, MailingSettings $settings): bool => $state->diffInDays(now()) > $settings->token_expiration_days,
                'success' => fn (Carbon $state, MailingSettings $settings): bool => $state->diffInDays(now()) < $settings->token_expiration_days,
            ]);

    }
}
