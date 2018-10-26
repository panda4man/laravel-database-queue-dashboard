<?php

Route::group(
    [
        'prefix' => 'api',
        'namespace' => 'BVAccel\DatabaseQueueDashboard\Http\Controllers\Api',
        'middleware' => ['api']
    ],
    function () {
        Route::apiResource('jobs', 'JobsController')->only('index');
        Route::apiResource('failed-jobs', 'FailedJobsController')->only(['index', 'show']);
        Route::apiResource('failed-job-stats', 'FailedJobStatsController')->only(['index']);
        Route::apiResource('queues', 'QueuesController')->only('index');
});
