<?php

namespace Database\Factories;

use App\Enums\AttendanceStatusEnum;
use App\Models\Attendance;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Attendance>
 */
class AttendanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'company_id' => fn (array $attrs) => User::find($attrs['user_id'])->company_id,

            'check_in' => $this->faker->dateTimeBetween('-30 days', 'now'),
            'check_out' => fn (array $attrs) => $this->faker->boolean(80)
                    ? (clone $attrs['check_in'])->modify('+8 hours')
                    : null,

            'status' => fake()->randomElement(AttendanceStatusEnum::cases()),

            'location' => $this->faker->city(),
        ];
    }
}
