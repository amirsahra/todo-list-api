<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Support\Facades\Config;

class CategorySeeder extends FakerSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $isCreateCategory = Config::get('todosettings.create_fake_category');
        $numberOfFAkeUsers = Config::get('todosettings.number_fake_data.user');
        $numberOfFAkeCategoriesForEachUser = Config::get('todosettings.number_fake_data.category');

        if ($isCreateCategory) {
            $this->insertFakeCategories($numberOfFAkeUsers,$numberOfFAkeCategoriesForEachUser);
        }
    }

    private function insertFakeCategories(int $numberOfFAkeUsers,int $numberOfFAkeCategoriesForEachUser)
    {
            for ($i = 1; $i <= $numberOfFAkeUsers; $i++) {
                $this->insertFakeCategoriesForUser($i,$numberOfFAkeCategoriesForEachUser);
            }
    }

    private function createFakeCategory(int $userId,$parentId)
    {
        Category::create([
            'name' => $this->faker->streetName(),
            'user_id' => $userId,
            'parent_id' => $parentId,
        ]);
    }

    private function insertFakeCategoriesForUser(int $userId, int $numberOfFAkeCategoriesForEachUser)
    {
        for ($i = 0; $i < $numberOfFAkeCategoriesForEachUser; $i++) {
            ($i > 5) ? $parentId = $this->faker->numberBetween(1, 5) : $parentId = null;
            $this->createFakeCategory($userId, $parentId);
        }
    }
}
