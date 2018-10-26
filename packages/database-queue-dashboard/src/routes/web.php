<?php

Route::group(
    [
        'namespace' => 'BVAccel\DatabaseQueueDashboard\Http\Controllers',
        'middleware' => ['web']
    ],
    function () {
        Route::resource('queues-dashboard', 'DashboardController')->only('index')->names([
            'index' => 'db-queues-dashboard'
        ]);
    }
);
