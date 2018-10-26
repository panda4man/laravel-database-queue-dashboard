<?php

namespace App\Console\Commands;

use App\Jobs\TestJob;
use Illuminate\Console\Command;

class SendTestFailedJob extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'failed-job:create
    {--queue= : Specify the job queue}
    {--count=1 : Number of jobs to create}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $queue = $this->option('queue') ?? 'default';
        $count = intval($this->option('count'));

        while($count-- > 0) {
            TestJob::dispatch(true)->onQueue($queue);
        }
    }
}
