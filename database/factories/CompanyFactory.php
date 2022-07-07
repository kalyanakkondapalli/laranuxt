<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Company::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'company_name'         => $this->faker->name,
            'role'                 => 'Software',
            'start_date'           => now()->subtract('day', 100),
            'end_date'             => null,
            'job_nature'           => $this->faker->paragraphs(3),
            'is_current_working' => 1,
            'user_id'              => 1
        ];
    }
}
