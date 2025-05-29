<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\RoleType;
use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Role>
 */
class RoleFactory extends Factory
{
    /**
     * Create all fixed roles from enum
     */
    public static function createFixedRoles(): void
    {
        collect(RoleType::cases())->each(function (RoleType $role): void {
            Role::updateOrCreate(
                ['id' => $role->value],
                [
                    'name' => mb_strtolower($role->name),
                    'label' => $role->label(),
                ]
            );
        });
    }

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => RoleType::CUSTOMER->value,
            'name' => mb_strtolower(RoleType::CUSTOMER->name),
            'label' => RoleType::CUSTOMER->label(),
        ];
    }
}
