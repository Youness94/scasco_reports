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

        Permission::create(['name' => 'voir les devis']);
        Permission::create(['name' => 'créer devis']);
        Permission::create(['name' => 'mettre à jour le devis']);
        Permission::create(['name' => 'supprimer devis']);
        Permission::create(['name' => 'détails devis']);
        Permission::create(['name' => 'admin devis']);


        



        // Create Roles
        $superAdminRole = Role::create(['name' => 'Super Admin']); //as super-admin
        $adminRole = Role::create(['name' => 'Admin']);
     

        // Lets give all permission to super-admin role.
        $allPermissionNames = Permission::pluck('name')->toArray();

        $superAdminRole->givePermissionTo($allPermissionNames);

        // Let's give few permissions to admin role.
        $adminRole->givePermissionTo([
            'voir les devis', 'créer devis', 'mettre à jour le devis','supprimer devis', 'admin devis',
    ]);
        // $adminRole->givePermissionTo(['créer role', 'voir les role', 'mettre à jour le role']);
        // $adminRole->givePermissionTo(['créer permission', 'voir les permission']);
        // $adminRole->givePermissionTo(['créer user', 'voir les user', 'mettre à jour le user']);

        
}
}