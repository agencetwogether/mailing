<?php

namespace Agencetwogether\Mailing\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Agencetwogether\Mailing\Mailing
 */
class Mailing extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Agencetwogether\Mailing\Mailing::class;
    }
}
