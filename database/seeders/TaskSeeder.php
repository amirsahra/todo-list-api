<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Support\Facades\Config;

class TaskSeeder extends FakerSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $isCreateTask = Config::get('todosettings.create_fake_task');
        $numberOfFAkeUsers = Config::get('todosettings.number_fake_data.user');
        $numberOfFAkeTasks = Config::get('todosettings.number_fake_data.tasks');

        if ($isCreateTask) {
            $this->insertFakeTasks($numberOfFAkeTasks, $numberOfFAkeUsers);
        }
    }

    private function insertFakeTasks(int $numberOfFAkeTasks, int $numberOfFAkeUsers)
    {
        for ($i = 1; $i <= $numberOfFAkeTasks; $i++) {
            $this->createFakeTask($numberOfFAkeUsers);
        }
    }

    private function createFakeTask(int $numberOfFAkeUsers)
    {
        $userId = $this->faker->numberBetween(1, $numberOfFAkeUsers);
        $categoryId = Category::select('id')->where('user_id', $userId)->inRandomOrder()->first();
        $minTime = config('todosettings.time_permit.min');

        Task::create([
            'name' => $this->faker->safeColorName(),
            'description' => $this->faker->realTextBetween(10, 80),
            'user_id' => $userId,
            'category_id' => $categoryId->id,
            'status' => 'new',
            'execution_time' => Carbon::now()->addMinutes(
                $this->faker->numberBetween($minTime, $minTime + 3)
            ),
        ]);
    }
}
