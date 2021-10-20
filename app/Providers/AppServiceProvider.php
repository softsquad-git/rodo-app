<?php

namespace App\Providers;

use App\Http\View\Composers\SettingComposer;
use App\Interfaces\MailInterface;
use App\Models\Assets\Resource;
use App\Models\Assets\SystemIt;
use App\Models\Certificates\CertificatePattern;
use App\Models\Clients\Client;
use App\Models\Tasks\Task;
use App\Models\Tests\Test;
use App\Models\Trainings\Training;
use App\Models\Trainings\TrainingGroup;
use App\Observers\Assets\ResourceObserver;
use App\Observers\Assets\SystemItObserver;
use App\Observers\Certificates\CertificatePatternObserver;
use App\Observers\Clients\ClientObserver;
use App\Observers\Tasks\TaskObserver;
use App\Observers\Tests\TestObserver;
use App\Observers\Trainings\TrainingGroupObserver;
use App\Observers\Trainings\TrainingObserver;
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
        Client::            observe(ClientObserver::class);
        Training::          observe(TrainingObserver::class);
        TrainingGroup::     observe(TrainingGroupObserver::class);
        Task::              observe(TaskObserver::class);
        Test::              observe(TestObserver::class);
        CertificatePattern::observe(CertificatePatternObserver::class);
        SystemIt::          observe(SystemItObserver::class);
        Resource::          observe(ResourceObserver::class);

        View::composer('*', SettingComposer::class);
        Schema::defaultStringLength(191);
    }
}
