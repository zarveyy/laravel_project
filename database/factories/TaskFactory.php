<?php

namespace Database\Factories;

use App\Models\BoardUser;
use App\Models\Task;
use App\Models\User;
use App\Models\Category;
use App\Models\Board;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Task::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this -> faker-> title,
            'description' => $this -> faker-> sentence,
            'due_date' => $this -> faker -> date(),
            'state' => $this -> faker -> word(),
            'created_at' => $this -> faker -> date(),
            'updated_at' => $this -> faker -> date(),
            'category_id' => Category::factory(),
            'user_id' => User::factory(),
            'board_id' => Board::factory(),
        ];
    }
}
