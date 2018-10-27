<?php


namespace BVAccel\DatabaseQueueDashboard\Http\Resources;


use Illuminate\Http\Resources\Json\JsonResource;

class Job extends JsonResource
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
            'payload'      => $this->_handlePayload($this->payload),
            'attempts'     => $this->attempts,
            'reserved_at'  => $this->reserved_at ? $this->reserved_at->format('Y-m-d H:m') : null,
            'available_at' => $this->available_at ? $this->available_at->format('Y-m-d H:m') : null,
            'created_at'   => $this->created_at ? $this->created_at->format('Y-m-d H:m') : null,
        ];
    }

    /**
     * @param string $payload
     * @return array
     */
    private function _handlePayload(string $payload): array
    {
        $payload                    = json_decode($payload, true);
        $payload['data']['command'] = unserialize($payload['data']['command']);

        return $payload;
    }
}