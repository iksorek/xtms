<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Run;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class RunFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Run::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $postCodes = [
            'IP18 6DB',
            'TW9 1AF',
            'ML6 8TW',
            'CM9 6JH',
            'KY12 9RB',
            'LA2 8HL',
            'S8 8JG',
            'SG15 6RY',
            'AB43 6NU',
        ];
        $types = [
            'new',
            'confirmed'
        ];


        return [
            'postcode_from' => 'NP16 5RA',
            'postcode_to' => $this->faker->randomElement($postCodes),
            'address_from' => $this->faker->address,
            'address_to' => $this->faker->address,
            'long_from' => $this->faker->longitude,
            'long_to' => $this->faker->longitude,
            'lat_from' => $this->faker->latitude,
            'lat_to' => $this->faker->latitude,
            'price' => rand(20, 1000),
            'status' => $this->faker->randomElement($types),
            'start_time' => Carbon::now()->add(rand(0, 5), $this->faker->randomElement(['hour', 'day'])),
            'finish_est' => Carbon::now()->add(rand(6, 10), 'hour'),
        ];
    }
}
