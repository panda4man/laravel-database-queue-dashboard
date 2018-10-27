<?php


namespace BVAccel\LaravelDatabaseQueueDashboard\Http\Resources;


use Illuminate\Http\Resources\Json\ResourceCollection;

class JobCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}