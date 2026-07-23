<?php

namespace Database\Seeders;

use App\Models\Currency;
use App\Models\User;
use App\Models\Wallet;
use App\Models\WalletStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Src\Shared\Domain\Enums\CurrencyEnum;
use Src\Shared\Domain\Enums\WalletStatusEnum;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        {
            // 1. Cargar dependencias de catálogo previas
            $activeStatus = WalletStatus::findByEnum(WalletStatusEnum::ACTIVE);
            $usdCurrency  = Currency::findByEnum(CurrencyEnum::USD);
            $arsCurrency  = Currency::findByEnum(CurrencyEnum::ARS);

            if (!$activeStatus || !$usdCurrency || !$arsCurrency) {
                $this->command->error('Error: Se deben ejecutar primero CurrencySeeder y WalletStatusSeeder.');
                return;
            }

            // 2. Definir usuarios de prueba con los saldos iniciales de sus billeteras
            $usersData = [
                [
                    'info' => [
                        'name' => 'Juan',
                        'last_name' => 'Pérez',
                        'email' => 'juan@example.com',
                        'password' => 'password123', // Se castea automáticamente en el modelo ('password' => 'hashed')
                        'document_type_id' => 2,
                        'document' => '38123456',
                        'birth_date' => '1994-05-15',
                        'nationality_id' => 1,
                        'gender_id' => 1,
                        'transaction_pin' => Hash::make('1234'), // El PIN transaccional
                        'email_verified_at' => now(),
                    ],
                    'wallets' => [
                        ['currency_id' => $usdCurrency->id, 'balance' => 1000.0000],
                        ['currency_id' => $arsCurrency->id, 'balance' => 500000.0000],
                    ],
                ],
                [
                    'info' => [
                        'name' => 'María',
                        'last_name' => 'Gómez',
                        'email' => 'maria@example.com',
                        'password' => 'password123',
                        'document_type_id' => 1,
                        'document' => '40987654',
                        'birth_date' => '1998-08-22',
                        'nationality_id' => 2,
                        'gender_id' => 2,
                        'transaction_pin' => Hash::make('4321'),
                        'email_verified_at' => now(),
                    ],
                    'wallets' => [
                        ['currency_id' => $usdCurrency->id, 'balance' => 500.0000],
                        ['currency_id' => $arsCurrency->id, 'balance' => 250000.0000],
                    ],
                ],
            ];

            // 3. Crear cada usuario y sus billeteras en un mismo bucle
            foreach ($usersData as $data) {
                $user = User::firstOrCreate(
                    ['email' => $data['info']['email']],
                    $data['info']
                );

                foreach ($data['wallets'] as $walletData) {
                    Wallet::firstOrCreate(
                        [
                            'user_id' => $user->id,
                            'currency_id' => $walletData['currency_id'],
                        ],
                        [
                            'wallet_status_id' => $activeStatus->id,
                            'balance' => $walletData['balance'],
                            'held_balance' => 0.0000,
                        ]
                    );
                }
            }
        }
    }
}
