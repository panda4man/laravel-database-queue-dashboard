<?php


namespace BVAccel\DatabaseQueueDashboard\Http\Controllers\Api;


use BVAccel\DatabaseQueueDashboard\Http\Resources\FailedJobResource;
use BVAccel\DatabaseQueueDashboard\Models\FailedJob;
use Illuminate\Routing\Controller;
use Spatie\QueryBuilder\QueryBuilder;

class FailedJobsController extends Controller
{
    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $query = QueryBuilder::for(FailedJob::class)
            ->allowedFilters(['queue'])
            ->get();

        return FailedJobResource::collection($query);
    }
}