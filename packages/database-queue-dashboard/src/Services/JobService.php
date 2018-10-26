<?php


namespace BVAccel\DatabaseQueueDashboard\Services;


use BVAccel\DatabaseQueueDashboard\Models\FailedJob;

class JobService
{
    /**
     * @param string $queue
     * @return mixed
     */
    public function failedInLastHour(?string $queue = null)
    {
        $now = now();
        $hour_ago = now()->subHour();

        return FailedJob::whereBetween('failed_at', [$hour_ago, $now])->count();
    }
}