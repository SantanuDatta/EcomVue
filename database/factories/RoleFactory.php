<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\RoleEnum;
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
        collect(RoleEnum::cases())->each(function (RoleEnum $role): void {
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
            'id' => RoleEnum::CUSTOMER->value,
            'name' => mb_strtolower(RoleEnum::CUSTOMER->name),
            'label' => RoleEnum::CUSTOMER->label(),
        ];
    }
}
