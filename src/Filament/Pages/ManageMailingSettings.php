<?php

namespace Agencetwogether\Mailing\Filament\Pages;

use Agencetwogether\Mailing\Enums\MailingProviders;
use Agencetwogether\Mailing\Filament\Forms\Components\RichEditor\RichContentCustomBlocks\ButtonBlock;
use Agencetwogether\Mailing\Services\ColorManager;
use Agencetwogether\Mailing\Settings\MailingSettings;
use App\Enums\NavigationGroup;
use BackedEnum;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Pages\SettingsPage;
use Filament\Schemas\Components\Fieldset;
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
                                Select::make('provider')
                                    ->label(__('mailing::mailing.mailing-settings.form.label.provider'))
                                    ->native(false)
                                    ->options(MailingProviders::class)
                                    ->required(),
                                TextInput::make('list_id_main')
                                    ->label(__('mailing::mailing.mailing-settings.form.label.list_id_main'))
                                    ->required(),
                                TextInput::make('api_key')
                                    ->label(__('mailing::mailing.mailing-settings.form.label.api_key'))
                                    ->required(),
                                TextInput::make('api_secret')
                                    ->label(__('mailing::mailing.mailing-settings.form.label.api_secret'))
                                    ->required(),
                            ]),
                        Tab::make(__('mailing::mailing.mailing-settings.form.tabs.newsletter'))
                            ->icon('phosphor-newspaper')
                            ->schema([
                                Toggle::make('subscription_newsletter')
                                    ->label(__('mailing::mailing.mailing-settings.form.label.subscription_newsletter'))
                                    ->columnSpanFull(),
                                TextInput::make('token_expiration_days')
                                    ->label(__('mailing::mailing.mailing-settings.form.label.token_expiration_days'))
                                    ->helperText(__('mailing::mailing.mailing-settings.form.helper.token_expiration_days'))
                                    ->numeric(),
                                TextInput::make('list_id_newsletter')
                                    ->label(__('mailing::mailing.mailing-settings.form.label.list_id_newsletter'))
                                    ->helperText(__('mailing::mailing.mailing-settings.form.helper.list_id_newsletter')),
                                TextInput::make('mail_from_address')
                                    ->label(__('mailing::mailing.mailing-settings.form.label.mail_from_address')),
                                TextInput::make('mail_from_name')
                                    ->label(__('mailing::mailing.mailing-settings.form.label.mail_from_name')),
                                TextInput::make('template_id_confirm_mail')
                                    ->label(__('mailing::mailing.mailing-settings.form.label.template_id_confirm_mail'))
                                    ->helperText(__('mailing::mailing.mailing-settings.form.helper.template_id_confirm_mail')),
                                RichEditor::make('text_confirmed.content')
                                    ->label(__('mailing::mailing.mailing-settings.form.label.text_confirmed.content'))
                                    ->toolbarButtons([
                                        'bold', 'italic', 'underline', 'strike',
                                        'h2', 'h3',
                                        'bulletList', 'orderedList',
                                        'link', 'blockquote',
                                        'codeBlock', 'customBlocks',
                                        'redo', 'undo',
                                    ])
                                    ->customBlocks([
                                        ButtonBlock::class,
                                    ])
                                    ->columnSpanFull(),
                            ]),
                        Tab::make(__('mailing::mailing.mailing-settings.form.tabs.subscription_page'))
                            ->icon('phosphor-read-cv-logo')
                            ->schema([
                                TextInput::make('text_newsletter_form.title')
                                    ->label(__('mailing::mailing.mailing-settings.form.label.text_newsletter_form.title'))
                                    ->required()
                                    ->columnSpanFull(),
                                RichEditor::make('text_newsletter_form.content')
                                    ->label(__('mailing::mailing.mailing-settings.form.label.text_newsletter_form.content'))
                                    ->helperText(__('mailing::mailing.mailing-settings.form.helper.text_newsletter_form.content'))
                                    ->toolbarButtons([
                                        'bold', 'italic', 'underline', 'strike',
                                        'h2', 'h3',
                                        'bulletList', 'orderedList',
                                        'link', 'blockquote',
                                        'codeBlock',
                                        'redo', 'undo',
                                    ])
                                    ->columnSpanFull(),
                                RichEditor::make('text_newsletter_form.submitted')
                                    ->label(__('mailing::mailing.mailing-settings.form.label.text_newsletter_form.submitted'))
                                    ->helperText(__('mailing::mailing.mailing-settings.form.helper.text_newsletter_form.submitted'))
                                    ->toolbarButtons([
                                        'bold', 'italic', 'underline', 'strike',
                                        'h2', 'h3',
                                        'bulletList', 'orderedList',
                                        'link', 'blockquote',
                                        'codeBlock', 'customBlocks',
                                        'redo', 'undo',
                                    ])
                                    ->customBlocks([
                                        ButtonBlock::class,
                                    ])
                                    ->columnSpanFull()
                                    ->required(),
                                RichEditor::make('text_newsletter_form.consent')
                                    ->label(__('mailing::mailing.mailing-settings.form.label.text_newsletter_form.consent'))
                                    ->helperText(__('mailing::mailing.mailing-settings.form.helper.text_newsletter_form.consent'))
                                    ->toolbarButtons([
                                        'bold', 'italic', 'underline', 'strike',
                                        'h2', 'h3',
                                        'bulletList', 'orderedList',
                                        'link', 'blockquote',
                                        'codeBlock',
                                        'redo', 'undo',
                                    ])
                                    ->columnSpanFull(),
                                Fieldset::make(__('mailing::mailing.mailing-settings.form.label.fieldsets.buttons.label'))
                                    ->columns()
                                    ->schema([
                                        Fieldset::make(__('mailing::mailing.mailing-settings.form.label.fieldsets.buttons.submit'))
                                            ->schema([
                                                TextInput::make('buttons_newsletter_form.submit.label')
                                                    ->label(__('mailing::mailing.mailing-settings.form.label.btn_label'))
                                                    ->required(),
                                                Select::make('buttons_newsletter_form.submit.color')
                                                    ->label(__('mailing::mailing.mailing-settings.form.label.btn_color'))
                                                    ->options(fn (ColorManager $manager) => $manager->getAllOptionsColors())
                                                    ->native(false)
                                                    ->allowHtml()
                                                    ->required(),
                                            ])
                                            ->columnSpan(1),
                                        Fieldset::make(__('mailing::mailing.mailing-settings.form.label.fieldsets.buttons.secondary'))
                                            ->schema([
                                                Toggle::make('buttons_newsletter_form.secondary.active')
                                                    ->label(__('mailing::mailing.mailing-settings.form.label.btn_active')),
                                                Toggle::make('buttons_newsletter_form.secondary.outlined')
                                                    ->label(__('mailing::mailing.mailing-settings.form.label.btn_outlined')),
                                                TextInput::make('buttons_newsletter_form.secondary.label')
                                                    ->label(__('mailing::mailing.mailing-settings.form.label.btn_label'))
                                                    ->required(),
                                                TextInput::make('buttons_newsletter_form.secondary.url')
                                                    ->label(__('mailing::mailing.mailing-settings.form.label.btn_url'))
                                                    ->helperText(__('mailing::mailing.mailing-settings.form.helper.btn_url'))
                                                    ->required(),
                                                Select::make('buttons_newsletter_form.secondary.color')
                                                    ->label(__('mailing::mailing.mailing-settings.form.label.btn_color'))
                                                    ->options(fn (ColorManager $manager) => $manager->getAllOptionsColors())
                                                    ->native(false)
                                                    ->allowHtml()
                                                    ->required(),
                                            ])
                                            ->columnSpan(1),
                                    ]),
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
