<?php

namespace Agencetwogether\Mailing\Filament\Forms\Components\RichEditor\RichContentCustomBlocks;

use Agencetwogether\Mailing\Services\ColorManager;
use Filament\Actions\Action;
use Filament\Forms\Components\RichEditor\RichContentCustomBlock;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Illuminate\Support\Facades\Blade;

class ButtonBlock extends RichContentCustomBlock
{
    public static function getId(): string
    {
        return 'emailButton';
    }

    public static function getLabel(): string
    {
        return __('mailing::mailing.mailing-settings.form.blocks.button');
    }

    public static function configureEditorAction(Action $action): Action
    {
        return $action
            ->modalHeading(__('mailing::mailing.mailing-settings.form.blocks.button_heading'))
            ->schema([
                TextInput::make('label')
                    ->label(__('mailing::mailing.mailing-settings.form.blocks.button_label'))
                    ->default(__('mailing::mailing.mailing-settings.form.blocks.button_default_label'))
                    ->required()
                    ->maxLength(255),

                TextInput::make('url')
                    ->label(__('mailing::mailing.mailing-settings.form.blocks.button_url'))
                    ->placeholder('https://')
                    ->required()
                    ->maxLength(2048),

                Select::make('align')
                    ->label(__('mailing::mailing.mailing-settings.form.blocks.button_align'))
                    ->default('center')
                    ->native(false)
                    ->options([
                        'left' => __('mailing::mailing.mailing-settings.form.blocks.align_left'),
                        'center' => __('mailing::mailing.mailing-settings.form.blocks.align_center'),
                        'right' => __('mailing::mailing.mailing-settings.form.blocks.align_right'),
                    ]),

                Select::make('color')
                    ->label(__('mailing::mailing.mailing-settings.form.blocks.button_color'))
                    ->native(false)
                    ->options(fn (ColorManager $manager): array => $manager->getAllOptionsColors())
                    ->allowHtml(),

                Toggle::make('outlined')
                    ->label(__('mailing::mailing.mailing-settings.form.blocks.button_outlined')),
            ]);
    }

    public static function getPreviewLabel(array $config): string
    {
        return $config['label'] ?? __('mailing::mailing.mailing-settings.form.blocks.button');
    }

    public static function toPreviewHtml(array $config): string
    {
        $label = e($config['label'] ?? __('mailing::mailing.mailing-settings.form.blocks.button_default_label'));
        $align = $config['align'] ?? 'center';
        $color = $config['color'] ?? 'primary';
        $outlined = $config['outlined'] ? 'outlined' : '';

        return Blade::render("<div style=\"text-align: {$align}; padding: 8px 0;\"><x-filament::button {$outlined} color=\"{$color}\">{$label}</x-filament::button></div>");
    }

    public static function toHtml(array $config, array $data): ?string
    {
        $label = e($config['label'] ?? __('mailing::mailing.mailing-settings.form.blocks.button_default_label'));
        $url = e($config['url'] ?? '#');
        $align = $config['align'] ?? 'center';
        $color = $config['color'] ?? 'primary';
        $outlined = $config['outlined'] ? 'outlined' : '';

        return Blade::render("<div style=\"text-align: {$align}; padding: 16px 0;\"><x-filament::button class=\"not-prose\" {$outlined} color=\"{$color}\" tag=\"a\" href=\"{$url}\" target=\"_blank\">{$label}</x-filament::button></div>");

    }
}
