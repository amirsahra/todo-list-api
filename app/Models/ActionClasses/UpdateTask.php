<?php

namespace App\Models\ActionClasses;

use App\Models\Task;
use Carbon\Carbon;

class UpdateTask
{
    public function __invoke(array $data, Task $task): bool
    {
        $taskData = $data;
        if (!array_key_exists('execution_time',$taskData))
            return $task->update($taskData);

        if ($data['execution_time'] > Carbon::now())
            $taskData['status'] = 'new';

        return $task->update($taskData);
    }
}
