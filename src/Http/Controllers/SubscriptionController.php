<?php

namespace Agencetwogether\Mailing\Http\Controllers;

use Agencetwogether\Mailing\Settings\MailingSettings;
use Illuminate\Http\Request;

class SubscriptionController
{
    public function __invoke(Request $request, MailingSettings $settings)
    {
        return view(
            'mailing::subscription-newsletter',
            [
                'title' => $settings->text_newsletter_form['title'],
            ]
        );
    }
}
