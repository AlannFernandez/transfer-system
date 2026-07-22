<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Src\Shared\Domain\Enums\GenderEnum;

class GenderSeeder extends Seeder
{
    public function run(): void
    {
        $data = array_map(fn($enum) => [
            'code'       => $enum->value,
            'name'       => method_exists($enum, 'label') ? $enum->label() : ucfirst(strtolower($enum->name)),
            'created_at' => now(),
            'updated_at' => now(),
        ], GenderEnum::cases());

        DB::table('genders')->insertOrIgnore($data);
    }
}