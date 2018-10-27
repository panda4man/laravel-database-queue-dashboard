<?php


namespace BVAccel\DatabaseQueueDashboard\Http\Controllers\Api;


use BVAccel\DatabaseQueueDashboard\Http\Resources\Job as JobResource;
use BVAccel\DatabaseQueueDashboard\Http\Resources\JobCollection;
use BVAccel\DatabaseQueueDashboard\Models\Job;
use Illuminate\Routing\Controller;
use Spatie\QueryBuilder\QueryBuilder;

class JobsController extends Controller
{
    /**
     * @return JobCollection
     */
    public function index()
    {
        $query = QueryBuilder::for(Job::class)
            ->allowedFilters(['queue'])
            ->orderBy('created_at', 'desc')
            ->limit(10);

        return new JobCollection($query->get());
    }

    /**
     * @param Job $job
     * @return JobResource
     */
    public function show(Job $job)
    {
        return new JobResource($job);
    }
}