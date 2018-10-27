<?php


namespace BVAccel\DatabaseQueueDashboard\Services;


use BVAccel\DatabaseQueueDashboard\Models\FailedJob;
use Illuminate\Database\Eloquent\Builder;

class JobService
{
    /**
     * @param string $queue
     * @return mixed
     */
    public function failedInLastHour(?string $queue = null)
    {
        $now      = now();
        $hour_ago = now()->subHour();
        /** @var Builder $query */
        $query = FailedJob::whereBetween('failed_at', [$hour_ago, $now]);

        if (!empty($query)) {
            $query->whereQueue($queue);
        }

        $count = $query->count();

        return $count;
    }
}