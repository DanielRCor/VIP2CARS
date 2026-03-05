<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clients = [
            ['nombre' => 'Carlos', 'apellidos' => 'Ramírez Torres', 'nro_documento' => '74521890', 'correo' => 'carlos.ramirez@vip2cars.pe', 'telefono' => '+51 987 654 321'],
            ['nombre' => 'María', 'apellidos' => 'López Mendoza', 'nro_documento' => '62431087', 'correo' => 'maria.lopez@gmail.com', 'telefono' => '+51 976 543 210'],
            ['nombre' => 'Jorge', 'apellidos' => 'Huamán Quispe', 'nro_documento' => '47890123', 'correo' => 'jhuaman@hotmail.com', 'telefono' => '+51 965 432 109'],
            ['nombre' => 'Lucía', 'apellidos' => 'Vargas Soto', 'nro_documento' => '53218976', 'correo' => 'lucia.vargas@empresa.com', 'telefono' => '+51 954 321 098'],
            ['nombre' => 'Roberto', 'apellidos' => 'Peña Castillo', 'nro_documento' => '61097843', 'correo' => 'rpena@negocios.pe', 'telefono' => '+51 943 210 987'],
            ['nombre' => 'Ana', 'apellidos' => 'Gonzales Ruiz', 'nro_documento' => '40987123', 'correo' => 'ana.gonzales@outlook.com', 'telefono' => '+51 932 109 876'],
            ['nombre' => 'Luis', 'apellidos' => 'Sánchez Prado', 'nro_documento' => '45678901', 'correo' => 'lsanchez@servicios.com', 'telefono' => '+51 921 098 765'],
            ['nombre' => 'Sofía', 'apellidos' => 'Castro Morales', 'nro_documento' => '71234567', 'correo' => 'sofia.castro@gmail.com', 'telefono' => '+51 910 987 654'],
            ['nombre' => 'Diego', 'apellidos' => 'Fernández Luna', 'nro_documento' => '48901234', 'correo' => 'diego.f@tech.pe', 'telefono' => '+51 900 876 543'],
            ['nombre' => 'Elena', 'apellidos' => 'Ramos Díaz', 'nro_documento' => '41235678', 'correo' => 'eramos@vip2cars.pe', 'telefono' => '+51 890 765 432'],
            ['nombre' => 'Andrés', 'apellidos' => 'Zevallos Paz', 'nro_documento' => '46789012', 'correo' => 'azevallos@empresa.pe', 'telefono' => '+51 880 654 321'],
            ['nombre' => 'Claudia', 'apellidos' => 'Pacheco Vera', 'nro_documento' => '70123456', 'correo' => 'cpacheco@gmail.com', 'telefono' => '+51 870 543 210'],
        ];

        foreach ($clients as $client) {
            Client::create($client);
        }
    }
}
