<?php


namespace BVAccel\LaravelDatabaseQueueDashboard\Http\Controllers\Api;


use BVAccel\LaravelDatabaseQueueDashboard\Http\Resources\FailedJobCollection;
use BVAccel\LaravelDatabaseQueueDashboard\Http\Resources\FailedJob as FailedJobResource;
use BVAccel\LaravelDatabaseQueueDashboard\Models\FailedJob;
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