<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Eliminar todos los registros en `permissions` y `roles` y sus relaciones
        Permission::query()->delete();
        Role::query()->delete();
        \DB::table('model_has_permissions')->delete();
        \DB::table('model_has_roles')->delete();

        // Crear roles
        $role1 = Role::create(['name' => 'Administrador']);
        $role2 = Role::create(['name' => 'Recepcionista']);
        $role3 = Role::create(['name' => 'Mantenimiento']);

        // Crear y asignar permisos
        Permission::create(['name' => 'home'])->syncRoles([$role1, $role2, $role3]);

        Permission::create(['name' => 'ver-estadistica'])->syncRoles([$role1, $role2]);
        
        Permission::create(['name' => 'ver-configuracion'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'editar-configuracion'])->syncRoles([$role1, $role2]);

        Permission::create(['name' => 'ver-checkins'])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'crear-checkins'])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'editar-checkins'])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'borrar-checkins'])->syncRoles([$role1, $role2]);

        Permission::create(['name' => 'ver-checkouts'])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'crear-checkouts'])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'editar-checkouts'])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'borrar-checkouts'])->syncRoles([$role1, $role2]);
        

        Permission::create(['name' => 'ver-reservas'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'crear-reservas'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'editar-reservas'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'borrar-reservas'])->syncRoles([$role1]);

        Permission::create(['name' => 'ver-pisos'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'crear-pisos'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'editar-pisos'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'borrar-pisos'])->syncRoles([$role1]);

        Permission::create(['name' => 'ver-habitaciones'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'crear-habitaciones'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'editar-habitaciones'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'borrar-habitaciones'])->syncRoles([$role1]);

        Permission::create(['name' => 'ver-tipo-habitaciones'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'crear-tipo-habitaciones'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'editar-tipo-habitaciones'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'borrar-tipo-habitaciones'])->syncRoles([$role1]);

        Permission::create(['name' => 'ver-gastos'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'crear-gastos'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'editar-gastos'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'borrar-gastos'])->syncRoles([$role1]);

        Permission::create(['name' => 'ver-empleados'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'crear-empleados'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'editar-empleados'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'borrar-empleados'])->syncRoles([$role1]);

        Permission::create(['name' => 'ver-servicios'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'crear-servicios'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'editar-servicios'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'borrar-servicios'])->syncRoles([$role1]);

        Permission::create(['name' => 'ver-minibar-inventario'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'editar-minibar-inventario'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'borrar-productos-inventario'])->syncRoles([$role1]);

        Permission::create(['name' => 'ver-productos'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'crear-productos'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'editar-productos'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'borrar-productos'])->syncRoles([$role1]);

        
        Permission::create(['name' => 'ver-consumos'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'crear-consumos'])->syncRoles([$role1, $role2]);

        Permission::create(['name' => 'ver-productos-comprados'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'crear-productos-comprados'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'editar-productos-comprados'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'borrar-productos-comprados'])->syncRoles([$role1]);

        Permission::create(['name' => 'ver-productos-vendidos'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'crear-productos-vendidos'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'editar-productos-vendidos'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'borrar-productos-vendidos'])->syncRoles([$role1]);

        Permission::create(['name' => 'ver-facturas'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'crear-facturas'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'editar-facturas'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'borrar-facturas'])->syncRoles([$role1]);

        Permission::create(['name' => 'ver-detalle-facturas'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'borrar-detalle-facturas'])->syncRoles([$role1]);

        Permission::create(['name' => 'ver-pacientes'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'crear-pacientes'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'editar-pacientes'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'borrar-pacientes'])->syncRoles([$role1]);

        

        Permission::create(['name' => 'ver-clientes'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'crear-clientes'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'editar-clientes'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'borrar-clientes'])->syncRoles([$role1]);

        Permission::create(['name' => 'ver-proveedores'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'crear-proveedores'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'editar-proveedores'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'borrar-proveedores'])->syncRoles([$role1]);

        Permission::create(['name' => 'ver-vendedores'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'crear-vendedores'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'editar-vendedores'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'borrar-vendedores'])->syncRoles([$role1]);
        
        Permission::create(['name' => 'ver-usuarios'])->syncRoles([$role1]);
        Permission::create(['name' => 'crear-usuarios'])->syncRoles([$role1]);
        Permission::create(['name' => 'editar-usuarios'])->syncRoles([$role1]);
        Permission::create(['name' => 'borrar-usuarios'])->syncRoles([$role1]);

        Permission::create(['name' => 'ver-roles'])->syncRoles([$role1]);
        Permission::create(['name' => 'crear-roles'])->syncRoles([$role1]);
        Permission::create(['name' => 'editar-roles'])->syncRoles([$role1]);
        Permission::create(['name' => 'borrar-roles'])->syncRoles([$role1]);

        Permission::create(['name' => 'ver-permisos'])->syncRoles([$role1]);
        Permission::create(['name' => 'crear-permisos'])->syncRoles([$role1]);
        Permission::create(['name' => 'editar-permisos'])->syncRoles([$role1]);
        Permission::create(['name' => 'borrar-permisos'])->syncRoles([$role1]);

    }
}