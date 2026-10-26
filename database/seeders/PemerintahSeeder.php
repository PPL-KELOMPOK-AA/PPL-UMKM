<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PemerintahSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('pemerintah')->updateOrInsert(
            ['username' => 'pemerintah'],
            [
                'password' => Hash::make('Pemerintah123!'),
            ]
        );
    }
}