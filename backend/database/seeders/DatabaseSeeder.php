<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Domain\Cliente\Entities\TipoEndereco;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $tipoEndereco = [
            [
                'nome' => 'Residencial',
            ],
            [
                'nome' => 'Comercial',
            ],
        ];

        foreach ($tipoEndereco as $item) {
            TipoEndereco::create($item);
        }
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
