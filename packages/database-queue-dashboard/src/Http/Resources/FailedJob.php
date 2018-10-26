<?php


namespace BVAccel\DatabaseQueueDashboard\Http\Resources;


use Illuminate\Http\Resources\Json\JsonResource;

class FailedJob extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'         => $this->id,
            'connection' => $this->connection,
            'payload'    => $this->_handlePayload($this->payload),
            'exception'  => $this->exception,
            'queue'      => $this->queue,
            'failed_at'  => $this->failed_at ? $this->failed_at->format('Y-m-d H:m') : null,
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