<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'text' => $this -> faker-> sentence(),
            'created_at' => $this -> faker -> date(),
            'updated_at' => $this -> faker -> date(),
            'user_id' => User::factory(),
            'task_id' => Task::factory(),
        ];
    }
}
