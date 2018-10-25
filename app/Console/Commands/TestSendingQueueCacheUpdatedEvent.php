<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TestSendingQueueCacheUpdatedEvent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:event
    {--event= : Specify event class}
    {--params= : Pass in event params}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test event';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $event  = $this->option('event');
        $params = explode(',', $this->option('params'));

        if (!class_exists($event)) {
            $this->error("Class $event does not exist");
            return 0;
        }

        broadcast(new $event(...$params));
    }
}
