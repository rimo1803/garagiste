<?php
namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'username' => $this->faker->userName,
            'firstname' => $this->faker->firstName,
            'lastname' => $this->faker->lastName,
            'address' => $this->faker->address,
            'phone' => $this->faker->phoneNumber,
            'role' => $this->faker->randomElement(['Client', 'Mecanicien', 'Administrateur']),
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('password'), // Use bcrypt() to hash passwords
        ];
    }

    // Define a specific state for the admin user
    public function admin()
    {
        return $this->state(function (array $attributes) {
            return [
                'username' => 'admin',
                'firstname' => 'Rhimou',
                'lastname' => 'El harras',
                'address' => 'Martil',
                'phone' => '0642532183',
                'role' => 'Administrateur',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('admin'),
            ];
        });
    }

    // Define a specific state for the mechanic user
    public function mechanic()
    {
        return $this->state(function (array $attributes) {
            return [
                'username' => 'mech',
                'firstname' => 'Mechanic',
                'lastname' => 'Mechanic',
                'address' => 'Tetouan',
                'phone' => '05-598-259-5',
                'role' => 'Mecanicien',
                'email' => 'mechanic@gmail.com',
                'password' => bcrypt('mechanic'),
            ];
        });
    }

    // Define a specific state for the client user
    public function client()
    {
        return $this->state(function (array $attributes) {
            return [
                'username' => 'cli',
                'firstname' => 'Client',
                'lastname' => 'Client',
                'address' => 'mdiq',
                'phone' => '06874951',
                'role' => 'Client',
                'email' => 'client@gmail.com',
                'password' => bcrypt('client'),
            ];
        });
    }
}
