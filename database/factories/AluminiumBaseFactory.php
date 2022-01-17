<?php

namespace Database\Factories;

use App\Models\AluminiumBase;
use Illuminate\Database\Eloquent\Factories\Factory;

class AluminiumBaseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AluminiumBase::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nama' => $this->faker->name(),
            'berat_avg' => 0.2,
            'berat_maksimal' => 0,
            'stok_awal' => 0,
            'stok_minimum' => 0,
            'stok_sekarang' => 0,
            'foto' => null,
            'keterangan' => null,
        ];
    }
}
