<?php

namespace App\Models\ActionClasses;

use App\Models\Category;

class UpdateCategory
{
    public function __invoke(array $data, Category $category): bool
    {
        return $category->update($data);
    }
}
