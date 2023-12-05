<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use function Laravel\Prompts\select;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cart>
 */
class CartFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'item_id' => '1',
        ];
    }
}
