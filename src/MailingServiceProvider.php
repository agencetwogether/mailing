<?php

namespace Agencetwogether\Mailing;

use Agencetwogether\Mailing\Commands\MailingCommand;
use Agencetwogether\Mailing\Events\NewsletterSubscribedEvent;
use Agencetwogether\Mailing\Listeners\NewsletterSubscribedListener;
use Agencetwogether\Mailing\Services\MailingManager;
use Agencetwogether\Mailing\Testing\TestsMailing;
use Illuminate\Support\Facades\Event;
use Livewire\Features\SupportTesting\Testable;
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
            ->hasConfigFile()
            ->hasMigrations($this->getMigrations())
            ->runsMigrations()
            ->hasTranslations()
            ->hasCommands($this->getCommands())
            ->hasInstallCommand(function (InstallCommand $command) {
                $command
                    // ->publishConfigFile()
                    // ->publishMigrations()
                    ->askToRunMigrations();
                // ->askToStarRepoOnGitHub('agencetwogether/mailing');
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

        // Testing
        Testable::mixin(new TestsMailing);
    }

    /**
     * @return array<class-string>
     */
    protected function getCommands(): array
    {
        return [
            MailingCommand::class,
        ];
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
