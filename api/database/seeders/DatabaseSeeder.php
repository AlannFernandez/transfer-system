<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            CurrencySeeder::class,
            DocumentTypeSeeder::class,
            GenderSeeder::class,
            CountrySeeder::class,
            WalletStatusSeeder::class,
            UserSeeder::class,
        ]);
    }
}
