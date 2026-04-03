<?php

namespace Agencetwogether\Mailing;

use Agencetwogether\Mailing\Events\NewsletterSubscribedEvent;
use Agencetwogether\Mailing\Listeners\NewsletterSubscribedListener;
use Agencetwogether\Mailing\Services\MailingManager;
use Illuminate\Support\Facades\Event;
use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class MailingServiceProvider extends PackageServiceProvider
{
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
        Event::listen(
            NewsletterSubscribedEvent::class,
            NewsletterSubscribedListener::class
        );
    }

    /**
     * @return array<string>
     */
    protected function getMigrations(): array
    {
        return [
            'create_mailing_settings',
        ];
    }
}
