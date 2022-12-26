<?php

namespace App\Console\Commands;

use App\Jobs\SendMailJob;
use App\Mail\ExecutionTime;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Console\Command;
use League\Flysystem\Config;

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
        $executionTime = Carbon::now()->addMinutes(config('todosettings.time_permit.min'));
        $usersTaskExecutionTime = Task::whereDate('execution_time', '=', $executionTime)->get();

        foreach ($usersTaskExecutionTime as $task) {
            new SendMailJob($task->user()->email, new ExecutionTime($task));
        }

        $this->info('Successfully sent.');
    }
}
