<?php

namespace App\Models;

use App\Models\ActionClasses\CreateCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 'parent_id', 'user_id',
    ];

    public function task()
    {
        return $this->hasOne(Task::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function children()
    {
        return $this->hasMany(Category::class,'parent_id','id')
            ->with('children');
    }
    public function createCategory(array $data)
    {
        $createCategoryAction = new CreateCategory();
        return $createCategoryAction($data);
    }

    public function updateCategory(array $data): bool
    {
       // $updateTaskAction = new UpdateTask();
      //  return $updateTaskAction($data,$this);
    }
}
