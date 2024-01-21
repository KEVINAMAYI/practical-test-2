<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $statuses =
            [
                [
                    'code' => 0,
                    'status' => 'active',
                    'updated_at' => Carbon::now(),
                    'created_at' => Carbon::now()
                ],
                [
                    'code' => 1,
                    'status' => 'pending',
                    'updated_at' => Carbon::now(),
                    'created_at' => Carbon::now()
                ],
                [
                    'code' => 2,
                    'status' => 'terminated',
                    'updated_at' => Carbon::now(),
                    'created_at' => Carbon::now()
                ],
                [
                    'code' => 3,
                    'status' => 'rejected',
                    'updated_at' => Carbon::now(),
                    'created_at' => Carbon::now()
                ],
                [
                    'code' => 4,
                    'status' => 'verified',
                    'updated_at' => Carbon::now(),
                    'created_at' => Carbon::now()
                ],
                [
                    'code' => 5,
                    'status' => 'approved',
                    'updated_at' => Carbon::now(),
                    'created_at' => Carbon::now()
                ],
            ];
        foreach ($statuses as $status) {
            DB::table('statuses')->insert($status);
        }
    }
}
