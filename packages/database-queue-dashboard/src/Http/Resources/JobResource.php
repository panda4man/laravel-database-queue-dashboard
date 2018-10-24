<?php


namespace BVAccel\DatabaseQueueDashboard\Http\Resources;


use Illuminate\Http\Resources\Json\JsonResource;

class JobResource extends JsonResource
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'           => $this->id,
            'queue'        => $this->queue,
            'attempts'     => $this->attempts,
            'reserved_at'  => $this->reserved_at ? $this->reserved_at->format('Y-m-d H:m') : null,
            'available_at' => $this->available_at ? $this->available_at->format('Y-m-d H:m') : null,
            'created_at'   => $this->created_at ? $this->created_at->format('Y-m-d H:m') : null,
        ];
    }
}