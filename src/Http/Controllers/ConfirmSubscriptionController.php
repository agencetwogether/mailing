<?php

namespace Agencetwogether\Mailing\Http\Controllers;

use Agencetwogether\Mailing\Actions\ConfirmSubscriberAction;
use Agencetwogether\Mailing\Exceptions\MailingException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Throwable;

class ConfirmSubscriptionController
{
    public function __invoke(Request $request)
    {
        if (! $request->hasValidSignature()) {
            abort(403);
        }

        try {
            $token = $request->string('token')->toString();

            $result = app(ConfirmSubscriberAction::class)->execute($token);

            if ($result === false) {
                return view(
                    'mailing::subscription-error',
                    [
                        'title' => __('mailing::mailing.confirm_subscription_page.already_confirmed.title'),
                        'content' => __('mailing::mailing.confirm_subscription_page.already_confirmed.content'),
                    ]
                );
            }

            return view('mailing::subscription-confirmed', ['title' => __('mailing::mailing.confirm_subscription_page.confirmed.title')]);

        } catch (ModelNotFoundException $e) {

            return response()->view(
                'mailing::subscription-error',
                [
                    'title' => __('mailing::mailing.confirm_subscription_page.token_expired.title'),
                    'content' => __('mailing::mailing.confirm_subscription_page.token_expired.content'),
                ],
                404
            );

        } catch (MailingException $e) {
            report($e);

            return response()->view(
                'mailing::subscription-error',
                [
                    'title' => __('mailing::mailing.confirm_subscription_page.api_error.title'),
                    'content' => __('mailing::mailing.confirm_subscription_page.api_error.content'),
                ],
                500
            );
        } catch (Throwable $e) {

            report($e);

            return response()->view(
                'mailing::subscription-error',
                [
                    'title' => __('mailing::mailing.confirm_subscription_page.any_error.title'),
                    'content' => __('mailing::mailing.confirm_subscription_page.any_error.content'),
                ],
                500
            );
        }
    }
}
