<?php

namespace App\Models\ActionClasses;

use App\Models\Task;

class CreateTask
{
    public function __invoke(array $data)
    {
        $taskData = $data;
        $taskData['user_id'] = auth('api')->id();
        return Task::create($taskData);
    }
}
