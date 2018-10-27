<?php


namespace BVAccel\LaravelDatabaseQueueDashboard\Http\Controllers;


use Illuminate\Routing\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        \Artisan::call('vendor:publish', [
            '--provider' => 'BVAccel\DatabaseQueueDashboard\LaravelDatabaseQueueDashboardServiceProvider',
            '--tag'      => 'public',
            '--force'    => 1
        ]);

        \Artisan::call('vendor:publish', [
            '--provider' => 'BVAccel\DatabaseQueueDashboard\LaravelDatabaseQueueDashboardServiceProvider',
            '--tag'      => 'view',
            '--force'    => 1
        ]);

        return view('db_queue::dashboard');
    }
}