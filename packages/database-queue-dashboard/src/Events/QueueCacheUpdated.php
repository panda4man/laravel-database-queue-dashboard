<?php

namespace BVAccel\DatabaseQueueDashboard\Events;

use BVAccel\DatabaseQueueDashboard\Services\QueueService;
use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\InteractsWithSockets;

class QueueCacheUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var string
     */
    public $queue;

    /**
     * @var string
     */
    public $broadcastQueue = 'db-queues';

    /**
     * Create a new event instance.
     *
     * @param string $queue
     */
    public function __construct(string $queue)
    {
        $this->queue = $queue;
    }

    /**
     * @return array
     */
    public function broadcastWith()
    {
        $service = new QueueService();
        $data    = $service->perQueueStats($this->queue);

        return $data;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('queues');
    }

    /**
     * @return string
     */
    public function broadcastAs()
    {
        return 'cache-updated';
    }
}
