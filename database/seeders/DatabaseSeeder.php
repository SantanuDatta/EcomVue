<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\RoleType;
use App\Models\Category;
use App\Models\Country;
use App\Models\CustomerAddress;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductImage;
use App\Models\ProductSku;
use App\Models\Role;
use App\Models\SubCategory;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed countries from API
     */
    public function seedCountriesFromApi(): void
    {
        $countriesData = Http::get('https://restcountries.com/v3.1/all')->json();

        foreach ($countriesData as $country) {
            Country::updateOrCreate(
                ['code' => $country['cca2']],
                ['name' => $country['name']['common']]
            );
        }
    }

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $customerRole = Role::factory()->create();

        Role::factory()->createFixedRoles();

        User::factory()->withAvatar()->create([
            'role_id' => RoleType::ADMIN->value,
            'first_name' => 'Super',
            'last_name' => 'Admin',
            'username' => 'superadmin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'),
        ]);

        $customers = User::factory(10)
            ->withAvatar()
            ->recycle($customerRole)
            ->create();

        $mainCategory = Category::factory(10)->withImage()->create();

        SubCategory::Factory(10)->withImage()->recycle($mainCategory)->create();

        $this->seedCountriesFromApi();

        CustomerAddress::factory(10)->recycle($customers)->create();

        $product = Product::factory(10)->recycle($mainCategory)->create();

        ProductImage::factory(10)->recycle($product)->create();

        $sizeAttributes = ProductAttribute::factory(5)->size()->create();

        $colorAttributes = ProductAttribute::factory(5)->color()->create();

        ProductSku::factory(10)
            ->recycle($product)
            ->withAttributes($sizeAttributes, $colorAttributes)
            ->create();
    }
}
