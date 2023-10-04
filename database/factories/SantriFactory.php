<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Santri>
 */
class SantriFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'wali_id' => fake()->randomElement(User::where('akses', 'wali')->pluck('id')->toArray()),
            'wali_status' => 'ok',
            'nama' => fake()->name(),
            'nis' => fake()->numberBetween(1000000000, 9999999999),
            'gender' => 'Putra',
            'kelas' => 4,
            'jenis_spp' => 'SPP1',
            'user_id' => 1,
            'biaya_id' => 9
        ];
    }
}
