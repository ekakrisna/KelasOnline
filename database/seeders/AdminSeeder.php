<?php

namespace Database\Seeders;

use App\Models\Admin;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Admin::truncate();
        Schema::enableForeignKeyConstraints();
        $defaultAdmin = [
            'id'                => '1',
            'name'              => 'Administrator',
            'email'             => 'admin@system.com',
            'password'          => Hash::make('12345678'),
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now(),
        ];

        Admin::insert($defaultAdmin);
        Admin::factory(99)->create();
    }
}
