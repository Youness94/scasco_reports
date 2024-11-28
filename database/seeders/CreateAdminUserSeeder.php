<?php

namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
{
    
         $user = User::create([
            'first_name' => 'Support',
            'email' => 'support@gmail.com',
            'phonenumber' => '0645068364',
            'status' => 'Active',
            'user_type' => 'Super Responsable',
            'photo' => null,
            'email_verified_at' => now(),
            'password' => bcrypt('12345678'),
            // 'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
  
        $superResponsableRole = Role::where('name', 'Super Responsable')->first();

        if (!$superResponsableRole) {
            // If the role doesn't exist, create it
            $superResponsableRole = Role::create(['name' => 'Super Responsable']);
        }

        $permissions = Permission::pluck('id', 'id')->all();

        $superResponsableRole->syncPermissions($permissions);

        $user->assignRole([$superResponsableRole->id]);

}
}
