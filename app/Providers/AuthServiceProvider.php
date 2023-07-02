<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Credito;
use App\Models\PlazoFijo;
use App\Models\TipoCredito;
use App\Models\TipoCuenta;
use App\Models\TipoTransaccion;
use App\Policies\CreditoPolicy;
use App\Policies\PlazoFijoPolicy;
use App\Policies\TipoCreditoPolicy;
use App\Policies\TipoCuentaPolicy;
use App\Policies\TipoTransaccionPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        TipoCuenta::class=>TipoCuentaPolicy::class,
        TipoCredito::class=>TipoCreditoPolicy::class,
        TipoTransaccion::class=>TipoTransaccionPolicy::class,
        User::class=>UserPolicy::class,
        Credito::class=>CreditoPolicy::class,
        PlazoFijo::class=>PlazoFijoPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
