<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        User::truncate();
        Schema::enableForeignKeyConstraints();
        $defaultAdmin = [
            'id'                => '1',
            'name'              => 'User',
            'email'             => 'user@system.com',
            'password'          => Hash::make('12345678'),
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now(),
        ];

        User::insert($defaultAdmin);
        User::factory(99)->create();
    }
}
