<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Carbon\Carbon;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('employees')->delete();
        $employees = [
            [
                "id"                => 1,
                "nama"              => "Asep Sahrudin",
                "tanggal_lahir"     => "1999-03-18 13:41:11",
                "alamat"            => "Jakarta Selatan",
                "foto"              => "asepsahrudin.png",
                "status_perkawinan" => false,
                "created_at"        => Carbon::now(),
                "updated_at"        => Carbon::now(),
            ],
            [
                "id"                => 2,
                "nama"              => "User Test 3",
                "tanggal_lahir"     => "1999-03-18 13:41:11",
                "alamat"            => "Jakarta Selatan",
                "foto"              => "usertest3.png",
                "status_perkawinan" => false,
                "created_at"        => Carbon::now(),
                "updated_at"        => Carbon::now(),
            ],
            [
                "id"                => 3,
                "nama"              => "User test 2",
                "tanggal_lahir"     => "1999-03-18 13:41:11",
                "alamat"            => "Jakarta Timur",
                "foto"              => "usertest2.png",
                "status_perkawinan" => false,
                "created_at"        => Carbon::now(),
                "updated_at"        => Carbon::now(),
            ],
            [
                "id"                => 4,
                "nama"              => "User Test 1",
                "tanggal_lahir"     => "1999-03-18 13:41:11",
                "alamat"            => "Jakarta Barat",
                "foto"              => "usertest1.png",
                "status_perkawinan" => false,
                "created_at"        => Carbon::now(),
                "updated_at"        => Carbon::now(),
            ],
        ];
        DB::table('employees')->insert($employees);
    }
}
