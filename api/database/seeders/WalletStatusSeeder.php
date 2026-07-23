<?php

namespace Database\Seeders;

use App\Models\WalletStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Src\Shared\Domain\Enums\WalletStatusEnum;
class WalletStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (WalletStatusEnum::cases() as $status) {
            WalletStatus::updateOrCreate(
                ['code' => $status->value],
                [
                    'name' => $status->label(),
                    'description' => $status->description(),
                ]
            );
        }
    }
}
