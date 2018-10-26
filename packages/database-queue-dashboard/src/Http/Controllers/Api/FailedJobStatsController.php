<?php


namespace BVAccel\DatabaseQueueDashboard\Http\Controllers\Api;


use BVAccel\DatabaseQueueDashboard\Services\JobService;

class FailedJobStatsController
{
    public function index()
    {
        $job_service  = new JobService();
        $failed_count = $job_service->failedInLastHour();
        $data         = [
            'failed_count' => $failed_count
        ];

        return response()->json(['data' => $data]);
    }
}