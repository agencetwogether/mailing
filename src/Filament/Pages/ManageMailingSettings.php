<?php

namespace Agencetwogether\Mailing\Filament\Pages;

use Agencetwogether\Mailing\Settings\MailingSettings;
use App\Enums\NavigationGroup;
use BackedEnum;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Filament\Forms\Components\TextInput;
use Filament\Pages\SettingsPage;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Illuminate\Contracts\Support\Htmlable;

class ManageMailingSettings extends SettingsPage
{
    use HasPageShield;

    protected static string $settings = MailingSettings::class;

    protected static string|BackedEnum|null $navigationIcon = 'phosphor-mailbox';

    public static function getNavigationGroup(): ?string
    {
        return NavigationGroup::SETTINGS->getLabel();
    }

    public function getTitle(): string|Htmlable
    {
        return __('mailing::mailing.mailing-settings.title');
    }

    public static function getNavigationLabel(): string
    {
        return __('mailing::mailing.mailing-settings.navigation_title');
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('funeral-settings-tabs')
                    ->tabs([
                        Tab::make(__('mailing::mailing.mailing-settings.form.tabs.general'))
                            ->icon('phosphor-seal-warning')
                            ->schema([
                                TextInput::make('provider')
                                    ->label(__('mailing::mailing.mailing-settings.form.label.provider'))
                                    ->required(),
                                TextInput::make('api_key')
                                    ->label(__('mailing::mailing.mailing-settings.form.label.api_key')),
                                TextInput::make('api_secret')
                                    ->label(__('mailing::mailing.mailing-settings.form.label.api_secret')),
                                TextInput::make('list_id')
                                    ->label(__('mailing::mailing.mailing-settings.form.label.list_id')),
                                // TODO Field extra

                            ]),
                    ])
                    ->columns()
                    ->columnSpanFull(),
            ]);
    }

    protected function afterSave(): void
    {
        $this->fillForm();
    }
}
