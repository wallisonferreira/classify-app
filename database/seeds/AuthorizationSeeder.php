<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AuthorizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        # Perfis de usuário

        $comum       = $this->createRole('comum');
        $curador     = $this->createRole('curador');

        Permission::create([
            'name' => 'comentario_especial',
            'guard_name' => 'web'
        ]);

        $curador->givePermissionTo('comentario_especial');

    }
        
    public function createRole($role)
    {
        return Role::create([
            'name' => $role,
            'guard_name' => 'web'
        ]);
    }
}
