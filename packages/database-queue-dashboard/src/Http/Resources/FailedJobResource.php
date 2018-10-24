<?php


namespace BVAccel\DatabaseQueueDashboard\Http\Resources;


use Illuminate\Http\Resources\Json\JsonResource;

class FailedJobResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'         => $this->id,
            'connection' => $this->connection,
            'queue'      => $this->queue,
            'failed_at'  => $this->failed_at,
        ];
    }
}