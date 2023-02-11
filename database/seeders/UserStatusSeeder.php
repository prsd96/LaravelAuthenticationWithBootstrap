<?php

namespace Database\Seeders;

use App\Models\UserStatus;
use Illuminate\Database\Seeder;

class UserStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_statuses = [ 
            [ 'name' => 'Active' ],
            [ 'name' => 'Inactive' ],
        ];

        foreach($user_statuses as $user_status)
        {
            UserStatus::create($user_status);
        }
    }
}
