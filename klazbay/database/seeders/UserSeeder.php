<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'  => 'klazbay',
            'email' => 'klaz@klazbay.com',
            'password'  => Hash::make('klazbay17'),
            'remember_token'    => Str::random(16)
        ]);
    }
}
