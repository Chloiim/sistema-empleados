<?php

namespace App\Providers;

use App\Services\Reports\ReportePDF;
use App\Contracts\Reporteable;
use App\Services\Notifications\NotificacionEmail;
use App\Services\Notifications\NotificacionSMS;
use App\Contracts\Notificable;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Registrar cualquier servicio de la aplicación.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->bind(Reporteable::class, function ($app) {
            return new ReportePDF(); // Implementación por defecto
        });

        $this->app->bind(Notificable::class, function ($app) {
            return new NotificacionEmail(); // Primera implementación por defecto
        });

        // Registrar la segunda implementación con un nombre específico
        $this->app->bind('notificacion.sms', function ($app) {
            return new NotificacionSMS();
        });
    }
}
