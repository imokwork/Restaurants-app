<?php

namespace Database\Factories;

use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Factories\Factory;

class RestaurantFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Restaurant::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $this->faker->addProvider(new \Xvladqt\Faker\LoremFlickrProvider($this->faker));

        return [
            'name' => $this->faker->sentence(2),
            'photo' => $this->faker->imageUrl(320, 240, ['food']),
            'information' => $this->faker->paragraph(1),
            'rating' => $this->faker->randomFloat(1, 3, 5),
            'latitude' => $this->faker->latitude(13.776297, 13.852121),
            'longitude' => $this->faker->longitude(100.489681, 100.6205616),
        ];
    }
}
