<?php


namespace BVAccel\DatabaseQueueDashboard\Http\Controllers\Api;


use BVAccel\DatabaseQueueDashboard\Services\QueueService;
use Illuminate\Routing\Controller;

class QueuesController extends Controller
{
    public function index()
    {
        $service = new QueueService();
        $data    = $service->perQueueStats();

        return response()->json(['data' => $data]);
    }
}