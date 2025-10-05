<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

// ✅ Import semua middleware yang digunakan
use App\Http\Middleware\TrustHosts;
use App\Http\Middleware\TrustProxies;
use Illuminate\Http\Middleware\HandleCors;
use Illuminate\Foundation\Http\Middleware\PreventRequestsDuringMaintenance;
use Illuminate\Foundation\Http\Middleware\ValidatePostSize;
use App\Http\Middleware\TrimStrings;
use Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull;
use App\Http\Middleware\EncryptCookies;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use App\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;

// ✅ Import middleware custom kamu
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\KomunitasMiddleware;
use App\Http\Middleware\BankSampahCheckMiddleware;
use App\Http\Middleware\RedirectIfAuthenticated;
use Illuminate\Auth\Middleware\Authenticate;

class Kernel extends HttpKernel
{
    /**
     * Global HTTP middleware (dijalankan di setiap request)
     */
    protected $middleware = [
        TrustHosts::class,
        TrustProxies::class,
        HandleCors::class,
        PreventRequestsDuringMaintenance::class,
        ValidatePostSize::class,
        TrimStrings::class,
        ConvertEmptyStringsToNull::class,
    ];

    /**
     * Grup middleware (web dan api)
     */
    protected $middlewareGroups = [
        'web' => [
            EncryptCookies::class,
            AddQueuedCookiesToResponse::class,
            StartSession::class,
            ShareErrorsFromSession::class,
            VerifyCsrfToken::class, // aktif di web routes
            SubstituteBindings::class,
        ],

        'api' => [
            EnsureFrontendRequestsAreStateful::class, // Sanctum token
            'throttle:api',
            SubstituteBindings::class,
        ],
    ];

    /**
     * Middleware untuk route tertentu
     */
    protected $routeMiddleware = [
        'auth' => Authenticate::class,
        'guest' => RedirectIfAuthenticated::class,

        // Custom middleware kamu
        'admin' => AdminMiddleware::class,
        'komunitas' => KomunitasMiddleware::class,
        'banksampah' => BankSampahCheckMiddleware::class,
    ];
}
