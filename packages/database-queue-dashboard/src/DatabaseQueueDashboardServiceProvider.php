<?php


namespace BVAccel\DatabaseQueueDashboard;


use BVAccel\DatabaseQueueDashboard\Events\QueueCacheUpdated;
use Illuminate\Contracts\Cache\Repository;
use Illuminate\Queue\Events\JobProcessed;
use Illuminate\Support\Facades\Queue;
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
        $this->_handleQueues();
        $this->_loadViews();
        $this->_publishAssets();
    }

    /**
     * Register package
     */
    public function register()
    {
        $configPath = __DIR__ . '/config/db-queue-dashboard.php';
        $this->mergeConfigFrom($configPath, 'db-queue-dashboard');
    }

    private function _handleQueues(): void
    {
        Queue::after(function (JobProcessed $job) {
            $queue = $job->job->getQueue();
            /** @var Repository $cache */
            $cache = \Cache::driver('redis');
            $hits = 0;

            if($cache->has($queue)) {
                $hits = $cache->get($queue);
            }

            if($hits < 5) {
                $hits++;
            } else {
                $hits = 0;
                event((new QueueCacheUpdated($queue))->onConnection('redis')->onQueue('db-queue-cache'));
            }

            $cache->put($queue, $hits, 10);
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