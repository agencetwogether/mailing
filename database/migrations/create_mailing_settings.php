<?php

use Agencetwogether\Mailing\Enums\MailingProviders;
use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('mailing.provider', MailingProviders::MAILJET->value);
        $this->migrator->add('mailing.api_key', '');
        $this->migrator->add('mailing.api_secret', '');
        $this->migrator->encrypt('mailing.api_secret');
        $this->migrator->add('mailing.list_id', '');
        $this->migrator->add('mailing.subscription_newsletter', false);
        $this->migrator->add('mailing.extra', []);
    }

    public function down(): void
    {
        $this->migrator->delete('mailing.provider');
        $this->migrator->delete('mailing.api_key');
        $this->migrator->delete('mailing.api_secret');
        $this->migrator->delete('mailing.list_id');
        $this->migrator->delete('mailing.subscription_newsletter');
        $this->migrator->delete('mailing.extra');
    }
};
