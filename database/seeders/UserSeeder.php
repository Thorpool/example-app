<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Results;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->make([
            'email' => 'test@test.com',
        ])->save();
    }
}
