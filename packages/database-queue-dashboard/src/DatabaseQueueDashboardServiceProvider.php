<?php


namespace BVAccel\DatabaseQueueDashboard;


use BVAccel\DatabaseQueueDashboard\Models\FailedJob;
use BVAccel\DatabaseQueueDashboard\Services\JobService;
use BVAccel\DatabaseQueueDashboard\Services\QueueService;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class DatabaseQueueDashboardServiceProvider extends ServiceProvider
{
    /**
     * Boot package
     */
    public function boot()
    {
        $this->_loadConfig();
        $this->_loadRoutes();
        $this->_loadViews();
        $this->_publishAssets();

        Route::model('failed_job', FailedJob::class);
    }

    /**
     * Register package
     */
    public function register()
    {
        $configPath = __DIR__ . '/config/db-queue-dashboard.php';
        $this->mergeConfigFrom($configPath, 'db-queue-dashboard');

        $this->app->singleton(JobService::class, function () {
            return new JobService();
        });

        $this->app->singleton(QueueService::class, function () {
            return new QueueService();
        });
    }

    /**
     * Load package config
     */
    private function _loadConfig(): void
    {
        $config_path  = __DIR__ . '/config/db-queue-dashboard.php';
        $publish_path = config_path('db-queue-dashboard.php');

        $this->publishes([$config_path => $publish_path], 'config');
    }

    /**
     * Load package routes
     */
    private function _loadRoutes(): void
    {
        $this->loadRoutesFrom(__DIR__ . '/routes/api.php');
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
    }

    /**
     * Load package views
     */
    private function _loadViews(): void
    {
        $path = __DIR__ . '/resources/views';

        $this->loadViewsFrom($path, 'db_queue');
        $this->publishes([$path => resource_path('views/vendor/db-queue-dashboard')], 'view');
    }

    /**
     * Publish package assets
     */
    private function _publishAssets(): void
    {
        $js  = __DIR__ . '/../public/js';
        $css = __DIR__ . '/../public/css';

        $this->publishes([
            $js  => public_path('vendor/db-queue-dashboard/js'),
            $css => public_path('vendor/db-queue-dashboard/css')
        ], 'public');
    }
}