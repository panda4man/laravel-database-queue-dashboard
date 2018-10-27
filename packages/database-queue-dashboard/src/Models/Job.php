<?php

namespace BVAccel\LaravelDatabaseQueueDashboard\Models;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    /**
     * @param $reserved_at
     * @return Carbon|null
     */
    public function getReservedAtAttribute($reserved_at)
    {
        return $reserved_at ? Carbon::createFromTimestamp($reserved_at) : null;
    }

    /**
     * @param $available_at
     * @return Carbon|null
     */
    public function getAvailableAtAttribute($available_at)
    {
        return $available_at ? Carbon::createFromTimestamp($available_at) : null;
    }

    /**
     * @param $created_at
     * @return Carbon|null
     */
    public function getCreatedAtAttribute($created_at)
    {
        return $created_at ? Carbon::createFromTimestamp($created_at) : null;
    }

    /**
     * @return \Illuminate\Config\Repository|mixed|string
     */
    public function getTable()
    {
        return config('db-queue-dashboard.jobs_table');
    }

    /**
     * @param Builder $query
     * @param null|string $scope
     * @return Builder
     */
    public function scopeQueue(Builder $query, ?string $scope)
    {
        return $query->where('queue', $scope);
    }
}