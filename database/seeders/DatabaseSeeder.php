<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $programmers = [
            [
                "name" => "Lucas Pires",
                "email" => "lucas@pires.dev.br",
                "password" => "lucas",
                "is_admin" => 1
            ],
            [
                "name" => "Kingo",
                "email" => "kingo@pires.dev.br",
                "password" => "kingophp",
                "is_admin" => 0
            ]
        ];

        for($i=0; $i<count($programmers); $i++)
        {
            \App\Models\User::factory()->create(
                [
                    "name" => $programmers[$i]['name'],
                    "email" => $programmers[$i]['email'],
                    "password" => $programmers[$i]['password'],
                    "is_admin" => $programmers[$i]['is_admin']
                ]
            );
        }




        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
