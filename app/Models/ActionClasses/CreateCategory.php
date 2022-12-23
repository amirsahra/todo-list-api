<?php

namespace App\Models\ActionClasses;

use App\Models\Category;

class CreateCategory
{
    public function __invoke(array $data)
    {
        $categoryData = $data;
        $categoryData['user_id'] = auth('api')->id();
        return Category::create($categoryData);
    }
}
