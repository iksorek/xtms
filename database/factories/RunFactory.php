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
        return [
            'postcode_from'=>'NP16RA',
            'postcode_to'=>'BS354GG',
            'start_time'=>now(),
            'finish_est'=>Carbon::now()->add(rand(1,5), 'hour'),
        ];
    }
}
