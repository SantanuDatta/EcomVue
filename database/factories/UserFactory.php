<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password = null;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $firstName = fake()->firstName();
        $lastName = fake()->lastName();

        return [
            'role_id' => Role::factory(),
            'first_name' => $firstName,
            'last_name' => $lastName,
            'username' => mb_strtolower((string) preg_replace('/\W+/', '', $firstName.$lastName)),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }

    public function withAvatar(): Factory|self
    {
        return $this->afterCreating(function (User $user): void {
            $avatarUrl = "https://ui-avatars.com/api/?name={$user->first_name}+{$user->last_name}&background=687387&color=ffffff&bold=true&format=png";
            $user->update(['avatar_url' => $avatarUrl]);
        });
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes): array => [
            'email_verified_at' => null,
        ]);
    }
}
