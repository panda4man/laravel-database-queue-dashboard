<?php


namespace BVAccel\DatabaseQueueDashboard;


use Illuminate\Support\ServiceProvider;

class DatabaseQueueDashboardServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $configPath = __DIR__ . '/config/db-queue-dashboard.php';

        if (function_exists('config_path')) {
            $publishPath = config_path('db-queue-dashboard.php');
        } else {
            $publishPath = base_path('config/db-queue-dashboard.php');
        }

        $this->publishes([$configPath => $publishPath], 'config');

        $this->loadRoutesFrom(__DIR__ . '/routes/api.php');
    }

    public function register()
    {
        $configPath = __DIR__ . '/config/db-queue-dashboard.php';
        $this->mergeConfigFrom($configPath, 'db-queue-dashboard');
    }
}