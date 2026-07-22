<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Src\Shared\Domain\Enums\CountryEnum;

class CountrySeeder extends Seeder
{
    public function run(): void
    {
        $data = array_map(fn($enum) => [
            'code'       => $enum->value,
            'iso2'       => $enum->iso2(),
            'name'       => $enum->label(),
            'created_at' => now(),
            'updated_at' => now(),
        ], CountryEnum::cases());

        DB::table('countries')->insertOrIgnore($data);
    }
}