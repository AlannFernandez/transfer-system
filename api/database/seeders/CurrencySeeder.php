<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Src\Shared\Domain\Enums\CurrencyEnum;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (CurrencyEnum::cases() as $currency) {
            Currency::updateOrCreate(
                ['code' => $currency->value],
                [
                    'name' => $currency->name(),
                    'symbol' => $currency->symbol(),
                    'decimal_places' => $currency->decimalPlaces(),
                    'is_active' => true,
                ]
            );
        }
    }
}
