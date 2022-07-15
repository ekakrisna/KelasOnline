<?php

namespace Database\Seeders;

use App\Models\Teacher;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Teacher::truncate();
        Schema::enableForeignKeyConstraints();
        $defaultAdmin = [
            'id'                => '1',
            'name'              => 'Teacher',
            'email'             => 'teacher@system.com',
            'password'          => Hash::make('12345678'),
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now(),
        ];

        Teacher::insert($defaultAdmin);
        Teacher::factory(99)->create();
    }
}
