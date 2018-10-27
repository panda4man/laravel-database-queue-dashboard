<?php

Route::group(
    [
        'prefix' => 'api',
        'namespace' => 'BVAccel\DatabaseQueueDashboard\Http\Controllers\Api',
        'middleware' => ['api']
    ],
    function () {
        Route::apiResource('failed-jobs', 'FailedJobsController')->only(['index', 'show']);
        Route::apiResource('jobs', 'JobsController')->only(['index', 'show']);
        Route::apiResource('failed-job-stats', 'FailedJobStatsController')->only(['index']);
        Route::apiResource('queue-stats', 'QueueStatsController')->only('index');
});
