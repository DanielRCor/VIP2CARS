<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Vehicle;
use Illuminate\Database\Seeder;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clients = Client::pluck('id', 'nro_documento');

        $vehicles = [
            ['placa' => 'ABC-123', 'marca' => 'Toyota', 'modelo' => 'Corolla', 'anio_fabricacion' => 2020, 'client_id' => $clients['74521890']],
            ['placa' => 'DEF-456', 'marca' => 'Hyundai', 'modelo' => 'Tucson', 'anio_fabricacion' => 2021, 'client_id' => $clients['74521890']],
            ['placa' => 'GHI-789', 'marca' => 'Kia', 'modelo' => 'Sportage', 'anio_fabricacion' => 2019, 'client_id' => $clients['62431087']],
            ['placa' => 'JKL-012', 'marca' => 'Chevrolet', 'modelo' => 'Tracker', 'anio_fabricacion' => 2022, 'client_id' => $clients['47890123']],
            ['placa' => 'MNO-345', 'marca' => 'Nissan', 'modelo' => 'Sentra', 'anio_fabricacion' => 2018, 'client_id' => $clients['53218976']],
            ['placa' => 'PQR-678', 'marca' => 'Honda', 'modelo' => 'Civic', 'anio_fabricacion' => 2023, 'client_id' => $clients['53218976']],
            ['placa' => 'STU-901', 'marca' => 'Mazda', 'modelo' => 'CX-5', 'anio_fabricacion' => 2021, 'client_id' => $clients['61097843']],
            ['placa' => 'VWX-234', 'marca' => 'Ford', 'modelo' => 'Explorer', 'anio_fabricacion' => 2020, 'client_id' => $clients['61097843']],
            ['placa' => 'BBB-444', 'marca' => 'Suzuki', 'modelo' => 'Swift', 'anio_fabricacion' => 2022, 'client_id' => $clients['40987123']],
            ['placa' => 'CCC-555', 'marca' => 'Mitsubishi', 'modelo' => 'L200', 'anio_fabricacion' => 2021, 'client_id' => $clients['45678901']],
            ['placa' => 'DDD-666', 'marca' => 'Subaru', 'modelo' => 'Forester', 'anio_fabricacion' => 2023, 'client_id' => $clients['71234567']],
            ['placa' => 'EEE-777', 'marca' => 'Volkswagen', 'modelo' => 'Tiguan', 'anio_fabricacion' => 2020, 'client_id' => $clients['48901234']],
            ['placa' => 'FFF-888', 'marca' => 'Renault', 'modelo' => 'Duster', 'anio_fabricacion' => 2019, 'client_id' => $clients['41235678']],
            ['placa' => 'GGG-999', 'marca' => 'Peugeot', 'modelo' => '3008', 'anio_fabricacion' => 2022, 'client_id' => $clients['46789012']],
            ['placa' => 'HHH-000', 'marca' => 'BMW', 'modelo' => 'X3', 'anio_fabricacion' => 2023, 'client_id' => $clients['70123456']],
        ];

        foreach ($vehicles as $vehicle) {
            Vehicle::create($vehicle);
        }
    }
}
