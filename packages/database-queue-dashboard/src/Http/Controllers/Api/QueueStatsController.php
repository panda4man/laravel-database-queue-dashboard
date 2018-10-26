<?php


namespace BVAccel\DatabaseQueueDashboard\Http\Controllers\Api;


use BVAccel\DatabaseQueueDashboard\Services\QueueService;
use Illuminate\Routing\Controller;

class QueueStatsController extends Controller
{
    public function index(QueueService $service)
    {
        $data    = $service->perQueueStats();

        return response()->json(['data' => $data]);
    }
}