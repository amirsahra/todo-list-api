<?php

namespace App\Models;

use App\Models\ActionClasses\CreateTask;
use App\Models\ActionClasses\UpdateTask;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 'status', 'description', 'category_id', 'user_id', 'execution_time',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function createTask(array $data)
    {
        $createTaskAction = new CreateTask();
        return $createTaskAction($data);
    }

    public function updateTask(array $data): bool
    {
        $updateTaskAction = new UpdateTask();
        return $updateTaskAction($data,$this);
    }
}
