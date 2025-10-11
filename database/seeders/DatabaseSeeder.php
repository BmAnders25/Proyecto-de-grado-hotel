<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        $this->call(RoleSeeder::class);
        $this->call(GastoSeeder::class);
        $this->call(ConfiguracioneSeeder::class);
        $this->call(EmpleadosSeeder::class);
        $this->call(ClientesSeeder::class);
        $this->call(VendedoresSeeder::class);
        $this->call(ProveedoresSeeder::class);
        $this->call(ProductosSeeder::class);
        $this->call(ServiciosSeeder::class);
        $this->call(ServiciosSeeder::class);
        $this->call(TipoHabitacionesSeeder::class);
        $this->call(HabitacionesSeeder::class);
        $this->call(PisosSeeder::class);
        $this->call(MinibarInventarioSeeder::class);
    
        
        \App\Models\User::factory()->create([
            'name'=>'Breekman Anderson Martinez Perez',
            'email'=>'admin@gmail.com',
            'password'=>bcrypt('admin12345')
        ])->assignRole('Administrador');

        //$this->call(Linea_AporteSeeder::class);

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
