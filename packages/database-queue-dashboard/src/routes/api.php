<?php

Route::group(['prefix' => 'api', 'namespace' => 'BVAccel\DatabaseQueueDashboard\Http\Controllers\Api'], function () {
    Route::resource('jobs', 'JobsController')->only('index');
});
