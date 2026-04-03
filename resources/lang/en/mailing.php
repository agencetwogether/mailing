<?php

return [
    'mailing-settings' => [
        'title' => 'Mailing Settings',
        'navigation_title' => 'Mailing Settings',
        'form' => [
            'label' => [
                'provider' => 'Provider',
                'api_key' => 'API Key',
                'api_secret' => 'Secret Key',
                'list_id' => 'Main List ID',
                'subscription_newsletter' => 'Activate subscription to newsletter',
            ],
            'helper' => [
                'provider' => '',
                'api_key' => '',
                'api_secret' => '',
                'list_id' => '',
            ],
            'tabs' => [
                'general' => 'General',
            ],
        ],
    ],
];
