<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        Carbon::setLocale('zh');

        $this->registerModelObservers();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerModelObservers();

        $this->registeApiErrorCode();
    }

    /**
     * 注册模型观察器
     *
     * @return void
     */
    protected function registerModelObservers()
    {
        \App\Models\Article::observe(\App\Observers\ArticleObserver::class);
        \App\Models\Replay::observe(\App\Observers\ReplayObservers::class);
    }

    protected function registeApiErrorCode()
    {
        \API::error(function (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
            abort(404);
        });
        \API::error(function (\Illuminate\Auth\Access\AuthorizationException $exception) {
            abort(403, $exception->getMessage());
        });
    }

}
