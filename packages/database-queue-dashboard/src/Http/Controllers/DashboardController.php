<?php


namespace BVAccel\DatabaseQueueDashboard\Http\Controllers;


use Illuminate\Routing\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        \Artisan::call('vendor:publish', [
            '--tag' => 'public',
            '--force' => 1
        ]);

        return view('db_queue::dashboard');
    }
}