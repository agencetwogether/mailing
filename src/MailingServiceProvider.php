<?php

namespace Agencetwogether\Mailing;

use Agencetwogether\Mailing\Filament\Components\SubscriptionNewsletterForm;
use Agencetwogether\Mailing\Services\MailingManager;
use App\Traits\IsConditionalModuleTrait;
use Livewire\Livewire;
use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class MailingServiceProvider extends PackageServiceProvider
{
    use IsConditionalModuleTrait;

    protected function moduleName(): string
    {
        return 'mailing';
    }

    public static string $name = 'mailing';

    public static string $viewNamespace = 'mailing';

    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package->name(static::$name)
            ->hasRoutes(['web'])
            ->hasViews(static::$viewNamespace)
            ->hasMigrations($this->getMigrations())
            ->runsMigrations()
            ->hasTranslations()
            ->hasInstallCommand(function (InstallCommand $command) {
                $command
                    ->publishMigrations()
                    ->askToRunMigrations()
                    ->askToStarRepoOnGitHub('agencetwogether/mailing');
            });
    }

    public function packageRegistered(): void
    {
        $this->app->singleton(
            MailingManager::class
        );
    }

    public function packageBooted(): void
    {
        Livewire::component('agencetwogether.filament.mailing.subscription.newsletter.form', SubscriptionNewsletterForm::class);
    }

    /**
     * @return array<string>
     */
    protected function getMigrations(): array
    {
        return [
            'create_mailing_settings',
            'create_pending_subscribers_table',
        ];
    }
}
