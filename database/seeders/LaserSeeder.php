<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class LaserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('laser')->insert([
            'zona' => 'Manos',
            'tipo_zona' => 'Zona Mini',
            'precio_sesion' => 200,
            'precio_paquete' => 180,
            'costo_paquete' => 2160,
        ]);

        DB::table('laser')->insert([
            'zona' => 'Frente',
            'tipo_zona' => 'Zona Mini',
            'precio_sesion' => 200,
            'precio_paquete' => 180,
            'costo_paquete' => 2160,
        ]);

        DB::table('laser')->insert([
            'zona' => 'Patillas',
            'tipo_zona' => 'Zona Mini',
            'precio_sesion' => 200,
            'precio_paquete' => 180,
            'costo_paquete' => 2160,
        ]);

        DB::table('laser')->insert([
            'zona' => 'Mejillas',
            'tipo_zona' => 'Zona Mini',
            'precio_sesion' => 200,
            'precio_paquete' => 180,
            'costo_paquete' => 2160,
        ]);

        DB::table('laser')->insert([
            'zona' => 'Bigote',
            'tipo_zona' => 'Zona Mini',
            'precio_sesion' => 200,
            'precio_paquete' => 180,
            'costo_paquete' => 2160,
        ]);

        DB::table('laser')->insert([
            'zona' => 'Mentón',
            'tipo_zona' => 'Zona Mini',
            'precio_sesion' => 200,
            'precio_paquete' => 180,
            'costo_paquete' => 2160,
        ]);

        DB::table('laser')->insert([
            'zona' => 'Línea Alba',
            'tipo_zona' => 'Zona Mini',
            'precio_sesion' => 200,
            'precio_paquete' => 180,
            'costo_paquete' => 2160,
        ]);

        DB::table('laser')->insert([
            'zona' => 'Pies',
            'tipo_zona' => 'Zona Mini',
            'precio_sesion' => 200,
            'precio_paquete' => 180,
            'costo_paquete' => 2160,
        ]);

        DB::table('laser')->insert([
            'zona' => 'Ante brazos',
            'tipo_zona' => 'Zonas Pequeñas',
            'precio_sesion' => 400,
            'precio_paquete' => 330,
            'costo_paquete' => 3690,
        ]);

        DB::table('laser')->insert([
            'zona' => 'Brazos Sup.',
            'tipo_zona' => 'Zonas Pequeñas',
            'precio_sesion' => 400,
            'precio_paquete' => 330,
            'costo_paquete' => 3690,
        ]);

        DB::table('laser')->insert([
            'zona' => 'Nuca',
            'tipo_zona' => 'Zonas Pequeñas',
            'precio_sesion' => 400,
            'precio_paquete' => 330,
            'costo_paquete' => 3690,
        ]);

        DB::table('laser')->insert([
            'zona' => 'Hombros',
            'tipo_zona' => 'Zonas Pequeñas',
            'precio_sesion' => 400,
            'precio_paquete' => 330,
            'costo_paquete' => 3690,
        ]);

        DB::table('laser')->insert([
            'zona' => 'Cuello',
            'tipo_zona' => 'Zonas Pequeñas',
            'precio_sesion' => 400,
            'precio_paquete' => 330,
            'costo_paquete' => 3690,
        ]);

        DB::table('laser')->insert([
            'zona' => 'Escote',
            'tipo_zona' => 'Zonas Pequeñas',
            'precio_sesion' => 400,
            'precio_paquete' => 330,
            'costo_paquete' => 3690,
        ]);

        DB::table('laser')->insert([
            'zona' => 'Axilas',
            'tipo_zona' => 'Zonas Pequeñas',
            'precio_sesion' => 400,
            'precio_paquete' => 330,
            'costo_paquete' => 3690,
        ]);

        DB::table('laser')->insert([
            'zona' => 'Bikini Basic',
            'tipo_zona' => 'Zonas Pequeñas',
            'precio_sesion' => 400,
            'precio_paquete' => 330,
            'costo_paquete' => 3690,
        ]);

        DB::table('laser')->insert([
            'zona' => 'Zona Íntima',
            'tipo_zona' => 'Zonas Pequeñas',
            'precio_sesion' => 400,
            'precio_paquete' => 330,
            'costo_paquete' => 3690,
        ]);

        DB::table('laser')->insert([
            'zona' => 'Línea interglútea',
            'tipo_zona' => 'Zonas Pequeñas',
            'precio_sesion' => 400,
            'precio_paquete' => 330,
            'costo_paquete' => 3690,
        ]);

        DB::table('laser')->insert([
            'zona' => 'Brazos Completos',
            'tipo_zona' => 'Zonas Medianas',
            'precio_sesion' => 900,
            'precio_paquete' => 800,
            'costo_paquete' => 12000,
        ]);

        DB::table('laser')->insert([
            'zona' => 'Espalda Alta',
            'tipo_zona' => 'Zonas Medianas',
            'precio_sesion' => 900,
            'precio_paquete' => 800,
            'costo_paquete' => 12000,
        ]);

        DB::table('laser')->insert([
            'zona' => 'Pecho',
            'tipo_zona' => 'Zonas Medianas',
            'precio_sesion' => 900,
            'precio_paquete' => 800,
            'costo_paquete' => 12000,
        ]);

        DB::table('laser')->insert([
            'zona' => 'Espalda baja',
            'tipo_zona' => 'Zonas Medianas',
            'precio_sesion' => 900,
            'precio_paquete' => 800,
            'costo_paquete' => 12000,
        ]);

        DB::table('laser')->insert([
            'zona' => 'Abdomen',
            'tipo_zona' => 'Zonas Medianas',
            'precio_sesion' => 900,
            'precio_paquete' => 800,
            'costo_paquete' => 12000,
        ]);

        DB::table('laser')->insert([
            'zona' => 'Glúteos',
            'tipo_zona' => 'Zonas Medianas',
            'precio_sesion' => 900,
            'precio_paquete' => 800,
            'costo_paquete' => 12000,
        ]);

        DB::table('laser')->insert([
            'zona' => 'Piernas Sup',
            'tipo_zona' => 'Zonas Medianas',
            'precio_sesion' => 900,
            'precio_paquete' => 800,
            'costo_paquete' => 12000,
        ]);

        DB::table('laser')->insert([
            'zona' => 'Piernas Inf',
            'tipo_zona' => 'Zonas Medianas',
            'precio_sesion' => 900,
            'precio_paquete' => 800,
            'costo_paquete' => 12000,
        ]);

        DB::table('laser')->insert([
            'zona' => 'Espalda Completa',
            'tipo_zona' => 'Zonas Grandes',
            'precio_sesion' => 1200,
            'precio_paquete' => 1000,
            'costo_paquete' => 15000,
        ]);

        DB::table('laser')->insert([
            'zona' => 'Piernas Completas',
            'tipo_zona' => 'Zonas Grandes',
            'precio_sesion' => 1200,
            'precio_paquete' => 1000,
            'costo_paquete' => 15000,
        ]);
    }
}
