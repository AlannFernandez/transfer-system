<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Src\Shared\Domain\Enums\DocumentTypeEnum;

class DocumentTypeSeeder extends Seeder
{
    public function run(): void
    {
        $data = array_map(fn($enum) => [
            'code'       => $enum->value,
            'name'       => $enum->label(),
            'created_at' => now(),
            'updated_at' => now(),
        ], DocumentTypeEnum::cases());

        DB::table('document_types')->insertOrIgnore($data);
    }
}