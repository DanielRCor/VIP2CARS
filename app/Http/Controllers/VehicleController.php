<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVehicleRequest;
use App\Http\Requests\UpdateVehicleRequest;
use App\Models\Client;
use App\Models\Vehicle;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VehicleController extends Controller
{
    /**
     * Listado paginado de vehículos con búsqueda.
     */
    public function index(Request $request): View
    {
        $search = $request->input('search', '');

        $vehicles = Vehicle::with('client')
            ->when($search, function ($query, $search) {
                $query->where('placa', 'like', "%{$search}%")
                    ->orWhere('marca', 'like', "%{$search}%")
                    ->orWhere('modelo', 'like', "%{$search}%")
                    ->orWhereHas('client', function ($q) use ($search) {
                        $q->where('nombre', 'like', "%{$search}%")
                            ->orWhere('apellidos', 'like', "%{$search}%")
                            ->orWhere('nro_documento', 'like', "%{$search}%");
                    });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('vehicles.index', compact('vehicles', 'search'));
    }

    /**
     * Formulario para crear un nuevo vehículo.
     */
    public function create(): View
    {
        return view('vehicles.create');
    }

    /**
     * Almacena un nuevo vehículo y su cliente.
     */
    public function store(StoreVehicleRequest $request): RedirectResponse
    {
        $client = Client::create($request->only([
            'nombre', 'apellidos', 'nro_documento', 'correo', 'telefono',
        ]));

        $client->vehicles()->create($request->only([
            'placa', 'marca', 'modelo', 'anio_fabricacion',
        ]));

        return redirect()
            ->route('vehicles.index')
            ->with('success', 'Vehículo registrado exitosamente.');
    }

    /**
     * Muestra el detalle de un vehículo.
     */
    public function show(Vehicle $vehicle): View
    {
        $vehicle->load('client');

        return view('vehicles.show', compact('vehicle'));
    }

    /**
     * Formulario para editar un vehículo.
     */
    public function edit(Vehicle $vehicle): View
    {
        $vehicle->load('client');

        return view('vehicles.edit', compact('vehicle'));
    }

    /**
     * Actualiza el vehículo y su cliente asociado.
     */
    public function update(UpdateVehicleRequest $request, Vehicle $vehicle): RedirectResponse
    {
        $vehicle->client->update($request->only([
            'nombre', 'apellidos', 'nro_documento', 'correo', 'telefono',
        ]));

        $vehicle->update($request->only([
            'placa', 'marca', 'modelo', 'anio_fabricacion',
        ]));

        return redirect()
            ->route('vehicles.show', $vehicle)
            ->with('success', 'Vehículo actualizado exitosamente.');
    }

    /**
     * Elimina el vehículo (el cliente se elimina por cascade si no tiene otros vehículos).
     */
    public function destroy(Vehicle $vehicle): RedirectResponse
    {
        $client   = $vehicle->client;
        $plate    = $vehicle->placa;

        $vehicle->delete();

        // Si el cliente no tiene más vehículos, lo eliminamos también
        if ($client->vehicles()->count() === 0) {
            $client->delete();
        }

        return redirect()
            ->route('vehicles.index')
            ->with('success', "Vehículo {$plate} eliminado exitosamente.");
    }
}
