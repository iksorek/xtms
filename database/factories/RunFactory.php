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
            ' YO31 0RQ',
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


        return [
            'postcode_from' => 'NP165RA',
            'postcode_to' => $this->faker->randomElement($postCodes),
            'price'=>rand(20, 1000),
            'start_time' => Carbon::now()->add(rand(0, 5), $this->faker->randomElement(['hour', 'day'])),
            'finish_est' => Carbon::now()->add(rand(6, 10), 'hour'),
        ];
    }
}
