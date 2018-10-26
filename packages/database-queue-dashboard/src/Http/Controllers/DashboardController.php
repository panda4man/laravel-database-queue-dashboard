<?php


namespace BVAccel\DatabaseQueueDashboard\Http\Controllers;


use Illuminate\Routing\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        \Artisan::call('vendor:publish', [
            '--provider' => 'BVAccel\DatabaseQueueDashboard\DatabaseQueueDashboardServiceProvider',
            '--tag'      => 'public',
            '--force'    => 1
        ]);

        \Artisan::call('vendor:publish', [
            '--provider' => 'BVAccel\DatabaseQueueDashboard\DatabaseQueueDashboardServiceProvider',
            '--tag'      => 'view',
            '--force'    => 1
        ]);

        return view('db_queue::dashboard');
    }
}