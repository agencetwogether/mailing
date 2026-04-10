<?php

use Agencetwogether\Mailing\Enums\MailingProviders;
use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        // General
        $this->migrator->add('mailing.provider', MailingProviders::MAILJET->value);
        $this->migrator->add('mailing.api_key', '');
        $this->migrator->add('mailing.api_secret', '');
        $this->migrator->encrypt('mailing.api_secret');
        $this->migrator->add('mailing.list_id_main', '');
        $this->migrator->add('mailing.extra', []);
        // Newsletter
        $this->migrator->add('mailing.subscription_newsletter', false);
        $this->migrator->add('mailing.token_expiration_days', 2);
        $this->migrator->add('mailing.list_id_newsletter', '');
        $this->migrator->add('mailing.mail_from_address', '');
        $this->migrator->add('mailing.mail_from_name', '');
        $this->migrator->add('mailing.template_id_confirm_mail', '');
        $this->migrator->add('mailing.text_confirmed', []);
        // Newsletter Form
        $this->migrator->add('mailing.text_newsletter_form', []);
        $this->migrator->add('mailing.buttons_newsletter_form', []);
    }

    public function down(): void
    {
        $this->migrator->delete('mailing.provider');
        $this->migrator->delete('mailing.api_key');
        $this->migrator->delete('mailing.api_secret');
        $this->migrator->delete('mailing.list_id_main');
        $this->migrator->delete('mailing.extra');
        //
        $this->migrator->delete('mailing.subscription_newsletter');
        $this->migrator->delete('mailing.token_expiration_days');
        $this->migrator->delete('mailing.list_id_newsletter');
        $this->migrator->delete('mailing.mail_from_address');
        $this->migrator->delete('mailing.mail_from_name');
        $this->migrator->delete('mailing.template_id_confirm_mail');
        $this->migrator->delete('mailing.text_confirmed');
        //
        $this->migrator->delete('mailing.text_newsletter_form');
        $this->migrator->delete('mailing.buttons_newsletter_form');

    }
};
