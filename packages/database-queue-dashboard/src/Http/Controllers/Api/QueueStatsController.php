<?php


namespace BVAccel\LaravelDatabaseQueueDashboard\Http\Controllers\Api;


use BVAccel\LaravelDatabaseQueueDashboard\Services\QueueService;
use Illuminate\Routing\Controller;

class QueueStatsController extends Controller
{
    public function index(QueueService $service)
    {
        $data    = $service->perQueueStats();

        return response()->json(['data' => $data]);
    }
}