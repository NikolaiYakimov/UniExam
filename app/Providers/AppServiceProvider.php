<?php

namespace App\Providers;

use App\Repositories\ExamRepository;
use App\Repositories\ExamRepositoryInterface;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ExamRepositoryInterface::class,  ExamRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
//        if (app()->environment('production')) {
//            URL::forceScheme('https');
//        }
    }
}

