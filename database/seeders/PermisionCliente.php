<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermisionCliente extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $admin = Role::findByName('admin');
        Permission::create(['name' => 'api.clientes.index',    'description' => 'Listar todas las clientes'])->assignRole($admin);
        Permission::create(['name' => 'api.clientes.show',     'description' => 'Mostrar cliente'])->assignRole($admin);
        Permission::create(['name' => 'api.clientes.store',    'description' => 'Crear cliente'])->assignRole($admin);
        Permission::create(['name' => 'api.clientes.update',   'description' => 'Actualizar cliente'])->assignRole($admin);
        Permission::create(['name' => 'api.clientes.destroy',  'description' => 'Eliminar cliente'])->assignRole($admin);
    }
}
