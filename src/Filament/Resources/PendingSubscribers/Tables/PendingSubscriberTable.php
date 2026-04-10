<?php

namespace Agencetwogether\Mailing\Filament\Resources\PendingSubscribers\Tables;

use Agencetwogether\Mailing\Actions\ConfirmSubscriberAction;
use Agencetwogether\Mailing\Actions\RequestDoubleOptInAction;
use Agencetwogether\Mailing\Exceptions\MailingException;
use Agencetwogether\Mailing\Filament\Resources\PendingSubscribers\PendingSubscriberResource;
use Agencetwogether\Mailing\Filament\Resources\PendingSubscribers\Tables\Components\PendingSubscriberColumns;
use Agencetwogether\Mailing\Filament\Resources\PendingSubscribers\Tables\Components\PendingSubscriberFilters;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Notifications\Notification;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Throwable;

class PendingSubscriberTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                PendingSubscriberColumns::getEmail(),
                PendingSubscriberColumns::getFirstname(),
                PendingSubscriberColumns::getName(),
                PendingSubscriberColumns::getConfirmedAt(),
                PendingSubscriberColumns::getCreatedAt(),
            ])
            ->filters([
                PendingSubscriberFilters::getPending(),
                PendingSubscriberFilters::getConfirmed(),
            ])
            ->recordActions([
                ActionGroup::make([
                    Action::make('resend')
                        ->label(__('mailing::mailing.pending-subscriber.actions.resend.label.button'))
                        ->icon('phosphor-paper-plane-tilt')
                        ->color('info')
                        ->action(function (Model $record) {
                            try {
                                app(RequestDoubleOptInAction::class)
                                    ->execute(
                                        $record->email,
                                        $record->data ?? [],
                                        $record->options ?? []
                                    );
                                $record->delete();

                                Notification::make()
                                    ->title(__('mailing::mailing.pending-subscriber.actions.resend.notification.success'))
                                    ->success()
                                    ->send();
                            } catch (MailingException $e) {

                                report($e);
                                Notification::make()
                                    ->title(__('mailing::mailing.pending-subscriber.actions.resend.notification.fail.title'))
                                    ->body(__('mailing::mailing.pending-subscriber.actions.resend.notification.fail.body'))
                                    ->danger()
                                    ->send();
                            }
                        })
                        ->visible(fn (Model $record): bool => $record->confirmed_at === null),
                    Action::make('confirm')
                        ->label(__('mailing::mailing.pending-subscriber.actions.confirm.label.button'))
                        ->icon('phosphor-seal-check')
                        ->color('success')
                        ->action(function (Model $record) {
                            try {
                                $result = app(ConfirmSubscriberAction::class)
                                    ->execute($record->token);

                                if ($result === false) {
                                    Notification::make()
                                        ->title(__('mailing::mailing.pending-subscriber.actions.confirm.notification.warning'))
                                        ->warning()
                                        ->send();

                                    return;
                                }

                                Notification::make()
                                    ->title(__('mailing::mailing.pending-subscriber.actions.confirm.notification.success'))
                                    ->success()
                                    ->send();

                            } catch (MailingException $e) {
                                report($e);

                                Notification::make()
                                    ->title(__('mailing::mailing.pending-subscriber.actions.confirm.notification.fail.api.title'))
                                    ->body(__('mailing::mailing.pending-subscriber.actions.confirm.notification.fail.api.body'))
                                    ->danger()
                                    ->send();

                            } catch (Throwable $e) {

                                report($e);
                                Notification::make()
                                    ->title(__('mailing::mailing.pending-subscriber.actions.confirm.notification.fail.general.title'))
                                    ->body(__('mailing::mailing.pending-subscriber.actions.confirm.notification.fail.general.body'))
                                    ->danger()
                                    ->send();
                            }
                        })
                        ->visible(fn (Model $record): bool => $record->confirmed_at === null),
                    DeleteAction::make()
                        ->label(__('mailing::mailing.pending-subscriber.actions.delete.label.button'))
                        ->modalHeading(fn (Model $record): string => __('mailing::mailing.pending-subscriber.actions.delete.modal.heading', ['email' => $record->email]))
                        ->modalDescription(__('mailing::mailing.pending-subscriber.actions.delete.modal.description')),
                ]),
            ])
            ->emptyStateIcon(PendingSubscriberResource::getNavigationIcon())
            ->emptyStateHeading(__('mailing::mailing.pending-subscriber.table.empty_state.heading'))
            ->emptyStateDescription(__('mailing::mailing.pending-subscriber.table.empty_state.description'))
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
