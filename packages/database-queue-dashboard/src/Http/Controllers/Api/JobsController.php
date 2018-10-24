<?php


namespace BVAccel\DatabaseQueueDashboard\Http\Controllers\Api;


use BVAccel\DatabaseQueueDashboard\Http\Resources\JobResource;
use BVAccel\DatabaseQueueDashboard\Models\Job;
use Illuminate\Routing\Controller;
use Spatie\QueryBuilder\QueryBuilder;

class JobsController extends Controller
{
    public function index()
    {
        $query = QueryBuilder::for(Job::class)
            ->allowedFilters(['queue'])
            ->get();

        return JobResource::collection($query);
    }
}