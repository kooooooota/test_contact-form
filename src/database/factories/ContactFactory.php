<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // 1:男性, 2:女性, 3:その他
        $genderId = $this->faker->randomElement([1, 1, 1, 1, 2, 2, 2, 2, 3, 3]);

        $genderKey = match($genderId) {
        1 => 'male',
        2 => 'female',
        default => null, // 3:その他の場合はランダムな名前
    };

        $date = $this->faker->dateTimeBetween('-1 month', 'now')->format('Y-m-d H:i:s');

        

        return [
            'last_name' => $this->faker->lastName(),
            'first_name' => $this->faker->firstName($genderKey),
            'gender' => $genderId,
            'email' => $this->faker->safeEmail(),
            'tel' => $this->faker->phoneNumber(),
            'address' => $this->faker->prefecture . $this->faker->city . $this->faker->streetAddress,
            'building' => $this->faker->secondaryAddress,
            'category_id' => $this->faker->numberBetween(1, 5),
            'detail' => $this->faker->realText(120),
            'created_at' => $date,
            'updated_at' => $date,
        ];
    }
}
