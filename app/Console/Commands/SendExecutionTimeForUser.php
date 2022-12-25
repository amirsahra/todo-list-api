<?php

namespace App\Console\Commands;

use App\Models\Task;
use Illuminate\Console\Command;

class SendExecutionTimeForUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'task:execution';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send task execution time for user';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //$usersTaskExecutionTime = Task::
    }
}
