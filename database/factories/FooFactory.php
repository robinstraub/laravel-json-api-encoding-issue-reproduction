<?php

namespace Database\Factories;

use App\Models\Foo;
use Illuminate\Database\Eloquent\Factories\Factory;

class FooFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Foo::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'number' => rand(0, 4294967295),
        ];
    }
}
