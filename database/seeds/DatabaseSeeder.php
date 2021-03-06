<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(TiposAreasSeeder::class);
		$this->call(AreasSeeder::class);
		$this->call(CargosSeeder::class);
		
		$this->call(UsersTableSeeder::class);
		$this->call(RolesTableSeeder::class);
		$this->call(PermissionsSeeder::class);
		
		$this->call(CategoriasSeeder::class);
		$this->call(UnidadesSeeder::class);
		$this->call(ProductosSeeder::class);
		$this->call(AlmacenesSeeder::class);
		
		$this->call(EstadosRQSSeeder::class);
		$this->call(AccionesRQSSeeder::class);
		$this->call(AccionesAlmacenSeeder::class);
		$this->call(ConfiguracionSeeder::class);
		
		
		
    }
}
