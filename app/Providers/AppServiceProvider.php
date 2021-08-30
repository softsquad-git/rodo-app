<?php

namespace App\Providers;

use App\Http\View\Composers\SettingComposer;
use App\Interfaces\LogInterface;
use App\Interfaces\MailInterface;
use App\Services\Log\LogService;
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
        $this->app->bind(LogInterface::class, LogService::class);
    }

    /**
     * @return void
     */
    public function boot()
    {
        View::composer('*', SettingComposer::class);
        Schema::defaultStringLength(191);
    }
}
