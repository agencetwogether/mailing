<?php

namespace Agencetwogether\Mailing\Filament\Resources\PendingSubscribers;

use Agencetwogether\Mailing\Filament\Resources\PendingSubscribers\Pages\ListPendingSubscribers;
use Agencetwogether\Mailing\Filament\Resources\PendingSubscribers\Tables\PendingSubscriberTable;
use Agencetwogether\Mailing\Models\PendingSubscriber;
use App\Enums\NavigationGroup;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;

class PendingSubscriberResource extends Resource
{
    protected static ?string $model = PendingSubscriber::class;

    protected static ?string $slug = 'inscriptions-newsletter';

    protected static ?int $navigationSort = 11;

    // protected static ?string $recordTitleAttribute = 'email';

    public static function getNavigationGroup(): ?string
    {
        return NavigationGroup::ADMINISTRATION->getLabel();
    }

    public static function getModelLabel(): string
    {
        return __('mailing::mailing.pending-subscriber.singular');
    }

    public static function getPluralModelLabel(): string
    {
        return __('mailing::mailing.pending-subscriber.plural');
    }

    public static function getNavigationLabel(): string
    {
        return __('mailing::mailing.pending-subscriber.plural');
    }

    public static function getNavigationIcon(): string|Htmlable|null
    {
        return 'phosphor-paper-plane-tilt';
    }

    public static function table(Table $table): Table
    {
        return PendingSubscriberTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPendingSubscribers::route('/'),
        ];
    }
}
