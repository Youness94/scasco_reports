<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserRolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Admin Permissions
        Permission::create(['name' => 'voir les roles']);
        Permission::create(['name' => 'créer role']);
        Permission::create(['name' => 'mettre à jour le role']);
        Permission::create(['name' => 'supprimer role']);

        Permission::create(['name' => 'voir les permissions']);
        Permission::create(['name' => 'créer permission']);
        Permission::create(['name' => 'mettre à jour le permission']);
        Permission::create(['name' => 'supprimer permission']);

        Permission::create(['name' => 'voir les utilisateurs']);
        Permission::create(['name' => 'créer utilisateur']);
        Permission::create(['name' => 'mettre à jour le utilisateur']);
        Permission::create(['name' => 'supprimer utilisateur']);

        Permission::create(['name' => 'voir les admins']);
        Permission::create(['name' => 'créer admin']);
        Permission::create(['name' => 'mettre à jour le admin']);
        Permission::create(['name' => 'supprimer admin']);

        Permission::create(['name' => 'voir les positions']);
        Permission::create(['name' => 'créer position']);
        Permission::create(['name' => 'mettre à jour le position']);
        Permission::create(['name' => 'supprimer position']);
        Permission::create(['name' => 'détails position']);


        



        // Create Roles
        $superAdminRole = Role::create(['name' => 'Super Admin']); //as super-admin
        $adminRole = Role::create(['name' => 'Admin']);
        $commercialRole = Role::create(['name' => 'Commercial']);
        $responsableRole = Role::create(['name' => 'Responsable']);
     

        // Lets give all permission to super-admin role.
        $allPermissionNames = Permission::pluck('name')->toArray();

        $superAdminRole->givePermissionTo($allPermissionNames);

        // Let's give few permissions to admin role.
        $adminRole->givePermissionTo([
            'voir les positions', 'créer position', 'mettre à jour le position','supprimer position',
    ]);
       

        
}
}