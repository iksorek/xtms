<?php

namespace Database\Factories;

use App\Models\vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

class VehicleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Vehicle::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $randMileage = rand(5200, 520000);
        return [
            'reg'=>$this->faker->randomLetter.$this->faker->randomLetter.rand(10,20).' '.$this->faker->randomLetter.$this->faker->randomLetter.$this->faker->randomLetter,
            'mileage'=>$randMileage,
            'mot'=>$this->faker->dateTimeBetween('-200 days', '+200 days'),
            'tax'=>$this->faker->dateTimeBetween('-200 days', '+200 days'),
            'insurance'=>$this->faker->dateTimeBetween('-50 days', '+200 days'),
            'service'=>$this->faker->numberBetween($randMileage - 100, $randMileage + 100)

        ];
    }
}
