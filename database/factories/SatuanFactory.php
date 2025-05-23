<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Satuan>
 */
class SatuanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected static $index = 0;
    public function definition(): array
    {
    
        $data = [
            'Pcs',
            'Box',
            'Bungkus',
            'Kardus',
            'Buah',
            'Lusin',
            'Rim',
            'Pack',
            'Renteng',
            'Lembar',
        ];
    
        $currentValue = $data[static::$index % count($data)];
        static::$index++;

        return [
            'nama_satuan' => $currentValue,
        ];;
    }
}
