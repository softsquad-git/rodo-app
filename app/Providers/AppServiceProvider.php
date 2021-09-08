<?php

namespace App\Providers;

use App\Http\View\Composers\SettingComposer;
use App\Interfaces\MailInterface;
use App\Models\Clients\Client;
use App\Observers\Clients\ClientObserver;
use App\Services\Mail\MailService;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function register()
    {
        $this->app->bind(MailInterface::class, MailService::class);
    }

    /**
     * @return void
     */
    public function boot()
    {
        Client::observe(ClientObserver::class);

        View::composer('*', SettingComposer::class);
        Schema::defaultStringLength(191);
    }
}
