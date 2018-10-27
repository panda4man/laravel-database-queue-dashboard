<?php


namespace BVAccel\DatabaseQueueDashboard\Models;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class FailedJob extends Model
{
    /**
     * @param $failed_at
     * @return Carbon|null
     */
    public function getFailedAtAttribute($failed_at)
    {
        return $failed_at ? Carbon::createFromFormat('Y-m-d H:i:s', $failed_at, 'UTC') : null;
    }

    /**
     * @return \Illuminate\Config\Repository|mixed|string
     */
    public function getTable()
    {
        return config('queue.failed.table');
    }

    /**
     * @param Builder $query
     * @param string $queue
     * @return Builder
     */
    public function scopeQueue(Builder $query, string $queue)
    {
        return $query->where('queue', $queue);
    }
}