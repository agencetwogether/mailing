<?php

namespace Agencetwogether\Mailing\Services;

use Filament\Support\Colors\Color;
use Filament\Support\Facades\FilamentColor;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class ColorManager
{
    public function getAppOptionsColors(): array
    {
        return $this->getOptionsColors($this->getAppColors());
    }

    public function getTailwindOptionsColors(): array
    {
        return $this->getOptionsColors($this->getTailwindDefaults());
    }

    public function getAllOptionsColors(): array
    {
        $allColors = array_merge(
            $this->getAppColors(),
            $this->getTailwindDefaults(),
        );

        return $this->getOptionsColors($allColors);
    }

    protected function getAppColors(): array
    {
        return Arr::mapWithKeys(
            FilamentColor::getColors(),
            fn (array $color, string $name): array => [$name => ['label' => Str::headline($name), 'color' => $color['600'], 'darkColor' => $color['400']]],
        );
    }

    protected function getTailwindDefaults(): array
    {
        return Arr::mapWithKeys(
            Color::all(),
            fn (array $color, string $name): array => [$name => ['label' => Str::headline($name), 'color' => $color['600'], 'darkColor' => $color['400']]],
        );
    }

    protected function getOptionsColors(array $colors): array
    {
        return Arr::mapWithKeys(
            $colors,
            function (array $color, string $name) {
                return [$name => <<<HTML
                        <div class="fi-fo-rich-editor-text-color-select-option">
                            <div class="fi-fo-rich-editor-text-color-select-option-preview" style="--color: {$color['color']}; --dark-color: {$color['darkColor']}"></div>

                            <div>{$color['label']}</div>
                        </div>
                        HTML];
            }
        );
    }
}
