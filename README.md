# Mailing Provider implementation for Filament

[![Filament 5.x](https://img.shields.io/badge/FILAMENT-5.x-EBB304?style=for-the-badge)](https://filamentphp.com/docs/5.x/introduction/installation)
[![Latest Version on Packagist](https://img.shields.io/packagist/v/agencetwogether/mailing.svg?style=for-the-badge)](https://packagist.org/packages/agencetwogether/mailing)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/agencetwogether/mailing/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=for-the-badge)](https://github.com/agencetwogether/mailing/actions?query=workflow%3A"Fix+PHP+code+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/agencetwogether/mailing.svg?style=for-the-badge)](https://packagist.org/packages/agencetwogether/mailing)

Implement subscribing to mailing directly in Filament App

## Installation

You can install the package via composer:

```bash
composer require agencetwogether/mailing
```

You can launch install command

```bash
php artisan mailing:install
```

Or you can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="mailing-migrations"
php artisan migrate
```

Add this plugin in your ```AdminPanelProvider```

```php
use Agencetwogether\Mailing\MailingPlugin;

...
public function panel(Panel $panel): Panel
{
    return $panel
        ...
        ->plugins([
           MailingPlugin::make()
        ])
        ...
}
...
```

## Usage

1. Fill fields in Mailing Settings Page

2. Add in your form

```php
use Agencetwogether\Mailing\Filament\Components\SubscriptionNewsletterToggle;
use Filament\Forms\Components\TextInput;

public function form(Schema $schema): Schema
{
    return $schema
        ->components([
            TextInput::make('name'),

            SubscriptionNewsletterToggle::make(),
            
        ]);
}
```

3. Add in your submit/create/save method

```php
use Agencetwogether\Mailing\Actions\RequestDoubleOptInAction;

public function create(): void
{
    $data = $this->form->getState();

    if ($data['subscribe_newsletter'] ?? false) {
    
        app(RequestDoubleOptInAction::class)->execute(
            $data['email'],
            //Set any data accordingly from a chosen provider
            [
                'firstname' => $data['firstname'],
                'name' => $data['name'],
            ],
            /*[
                'list_id' => '123' //to override main list id if necessary
            ]*/
        );  
    }
}
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](.github/SECURITY.md) on how to report security vulnerabilities.

## Credits

- [Agence Twogether](https://github.com/agencetwogether)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
