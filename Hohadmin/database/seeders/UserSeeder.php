<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{
    Role,
    Permission
};

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
        Permission::insert([
            ['name' => 'Add City', 'slug' => 'add-city'],
            ['name' => 'Delete City', 'slug' => 'delete-city'],
            ['name' => 'Edit City', 'slug' => 'edit-city'],
        
        ]);
    }
}
