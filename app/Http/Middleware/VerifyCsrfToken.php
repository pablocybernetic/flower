<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        '/stk_push', //TODO delete after
        '/mpesa/callback',  // Exclude this route from CSRF
          '/pay-via-ajax', '/success','/cancel','/fail','/ipn'
    ];

}
