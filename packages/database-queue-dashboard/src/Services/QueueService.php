<?php


namespace BVAccel\DatabaseQueueDashboard\Services;


use BVAccel\DatabaseQueueDashboard\Models\FailedJob;
use BVAccel\DatabaseQueueDashboard\Models\Job;
use DB;
use Illuminate\Database\Eloquent\Builder;

class QueueService
{
    /**
     * @param string $queue
     * @return array
     */
    public function perQueueStats(?string $queue = null)
    {
        /** @var Builder $jobs */
        $jobs = Job::groupBy('queue')->select("queue", DB::raw("count(queue) as count"));

        if (!empty($queue)) {
            $jobs->queue($queue);
        }

        /** @var Builder $failed_jobs */
        $failed_jobs = FailedJob::groupBy('queue')->select('queue', DB::raw("count(queue) as count"));

        if (!empty($queue)) {
            $failed_jobs->queue($queue);
        }

        $jobs        = $jobs->get();
        $failed_jobs = $failed_jobs->get();

        $queues = [];

        foreach ($jobs as $job) {
            $queues[$job->queue] = ['queued_jobs' => $job->count];
        }

        foreach ($failed_jobs as $job) {
            $queues[$job->queue] = ['failed_jobs' => $job->count];
        }

        $data = [];

        collect($queues)->each(function ($val, $d) use (&$data) {
            $data[] = [
                'name'   => $d,
                'queued' => $val['queued_jobs'] ?? 0,
                'failed' => $val['failed_jobs'] ?? 0
            ];
        });

        return $data;
    }
}