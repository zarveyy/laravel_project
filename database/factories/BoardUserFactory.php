<?php

namespace Database\Factories;

use App\Models\BoardUser;
use App\Models\Board;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class BoardUserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BoardUser::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'created_at' => $this -> faker -> date(),
            'updated_at' => $this -> faker -> date(),
            'board_id' => Board::factory(),
            'user_id' => User::factory(),
        ];
    }
}
