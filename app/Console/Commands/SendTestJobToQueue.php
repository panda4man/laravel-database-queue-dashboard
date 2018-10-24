<?php

namespace App\Console\Commands;

use App\Jobs\TestJob;
use Illuminate\Console\Command;

class SendTestJobToQueue extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'job:create
    {--queue= : Specify the job queue}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a test job to the queue';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $queue = $this->option('queue') ?? 'default';

        TestJob::dispatch()->onQueue($queue);
    }
}
