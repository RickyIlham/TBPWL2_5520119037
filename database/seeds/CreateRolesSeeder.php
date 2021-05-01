<?php

use Illuminate\Database\Seeder;
use App\role;

class CreateRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = [
            [
                'name' => 'Admin'
            ],
            [
                'name' => 'User'
            ]
        ];

        foreach ($role as $key => $value){
            role::create($value);
        }
    }
}
