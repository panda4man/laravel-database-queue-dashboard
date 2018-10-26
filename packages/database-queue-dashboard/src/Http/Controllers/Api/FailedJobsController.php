<?php


namespace BVAccel\DatabaseQueueDashboard\Http\Controllers\Api;


use BVAccel\DatabaseQueueDashboard\Http\Resources\FailedJobCollection;
use BVAccel\DatabaseQueueDashboard\Http\Resources\FailedJob as FailedJobResource;
use BVAccel\DatabaseQueueDashboard\Models\FailedJob;
use Illuminate\Routing\Controller;
use Spatie\QueryBuilder\QueryBuilder;

class FailedJobsController extends Controller
{
    /**
     * @return FailedJobCollection
     */
    public function index()
    {
        $query = QueryBuilder::for(FailedJob::class)
            ->allowedFilters(['queue'])
            ->orderBy('failed_at', 'desc')
            ->paginate(20);

        return new FailedJobCollection($query);
    }

    /**
     * @param FailedJob $job
     * @return FailedJobResource
     */
    public function show(FailedJob $job)
    {
        return FailedJobResource::make($job);
    }
}