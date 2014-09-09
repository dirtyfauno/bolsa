<?php

class CatUsuariosTableSeeder extends Seeder {

  public function run()
  {
    $tipos = array(
      'Admin',
      'Reclutador',
      'Zorro'
    );

    foreach ($tipos as $tipo)
    {
      TipoUsuarioModel::create(array(
        'tipo' => $tipo,
        'slug' => Str::slug($tipo)
      ));
    }
  }
}