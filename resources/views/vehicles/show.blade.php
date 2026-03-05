@extends('layouts.app')

@section('title', 'Vehículo — ' . $vehicle->placa)

@section('content')
<div class="page-header">
    <div class="container-xl">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-1" style="--bs-breadcrumb-divider-color:#888;">
                <li class="breadcrumb-item">
                    <a href="{{ route('vehicles.index') }}" class="text-decoration-none text-secondary">Vehículos</a>
                </li>
                <li class="breadcrumb-item active text-white">{{ strtoupper($vehicle->placa) }}</li>
            </ol>
        </nav>
        <h1><i class="bi bi-car-front-fill me-2"></i>{{ $vehicle->marca }} {{ $vehicle->modelo }}</h1>
        <p>Detalle completo del vehículo y su propietario</p>
    </div>
</div>

<div class="container-xl pb-5">
    <div class="row g-4">

        {{-- ── FICHA DEL VEHÍCULO ── --}}
        <div class="col-lg-6">
            <div class="card card-vip h-100">
                <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="bi bi-car-front-fill me-2 text-danger"></i>Vehículo</h5>
                    <span class="badge-placa" style="font-size:.9rem">{{ strtoupper($vehicle->placa) }}</span>
                </div>
                <div class="card-body p-4">
                    <dl class="row mb-0">
                        <dt class="col-sm-5 text-muted">Marca</dt>
                        <dd class="col-sm-7 fw-semibold">{{ $vehicle->marca }}</dd>

                        <dt class="col-sm-5 text-muted">Modelo</dt>
                        <dd class="col-sm-7 fw-semibold">{{ $vehicle->modelo }}</dd>

                        <dt class="col-sm-5 text-muted">Año de fabricación</dt>
                        <dd class="col-sm-7">
                            <span class="badge bg-secondary fs-sm">{{ $vehicle->anio_fabricacion }}</span>
                        </dd>

                        <dt class="col-sm-5 text-muted">Registrado</dt>
                        <dd class="col-sm-7 text-muted small">{{ $vehicle->created_at->format('d/m/Y H:i') }}</dd>

                        <dt class="col-sm-5 text-muted">Última edición</dt>
                        <dd class="col-sm-7 text-muted small">{{ $vehicle->updated_at->format('d/m/Y H:i') }}</dd>
                    </dl>
                </div>
            </div>
        </div>

        {{-- ── FICHA DEL CLIENTE ── --}}
        <div class="col-lg-6">
            <div class="card card-vip h-100">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0"><i class="bi bi-person-fill me-2 text-warning"></i>Cliente Propietario</h5>
                </div>
                <div class="card-body p-4">
                    <dl class="row mb-0">
                        <dt class="col-sm-5 text-muted">Nombre completo</dt>
                        <dd class="col-sm-7 fw-semibold">{{ $vehicle->client->nombre_completo }}</dd>

                        <dt class="col-sm-5 text-muted">Nro. Documento</dt>
                        <dd class="col-sm-7">{{ $vehicle->client->nro_documento }}</dd>

                        <dt class="col-sm-5 text-muted">Correo</dt>
                        <dd class="col-sm-7">
                            <a href="mailto:{{ $vehicle->client->correo }}" class="text-decoration-none">
                                {{ $vehicle->client->correo }}
                            </a>
                        </dd>

                        <dt class="col-sm-5 text-muted">Teléfono</dt>
                        <dd class="col-sm-7">
                            <a href="tel:{{ $vehicle->client->telefono }}" class="text-decoration-none">
                                {{ $vehicle->client->telefono }}
                            </a>
                        </dd>

                        <dt class="col-sm-5 text-muted">Otros vehículos</dt>
                        <dd class="col-sm-7">
                            <span class="badge bg-dark">
                                {{ $vehicle->client->vehicles()->count() }} vehículo(s)
                            </span>
                        </dd>
                    </dl>
                </div>
            </div>
        </div>

    </div>{{-- /row --}}

    {{-- ── ACCIONES ── --}}
    <div class="d-flex gap-3 mt-4 flex-wrap">
        <a href="{{ route('vehicles.index') }}" class="btn btn-outline-secondary" id="back-to-list">
            <i class="bi bi-arrow-left me-1"></i> Volver al listado
        </a>
        <a href="{{ route('vehicles.edit', $vehicle) }}" class="btn btn-primary" id="edit-vehicle">
            <i class="bi bi-pencil me-1"></i> Editar
        </a>
        <button type="button" class="btn btn-outline-danger ms-auto"
                data-bs-toggle="modal" data-bs-target="#deleteModal" id="delete-vehicle">
            <i class="bi bi-trash3 me-1"></i> Eliminar
        </button>
    </div>
</div>

{{-- ── MODAL ELIMINAR ── --}}
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-danger text-white border-0">
                <h5 class="modal-title"><i class="bi bi-exclamation-triangle-fill me-2"></i>Confirmar eliminación</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>¿Estás seguro de eliminar el vehículo <strong>{{ strtoupper($vehicle->placa) }}</strong>
                   ({{ $vehicle->marca }} {{ $vehicle->modelo }})?</p>
                <p class="text-muted small">Si el cliente no tiene más vehículos registrados, también será eliminado.</p>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <form method="POST" action="{{ route('vehicles.destroy', $vehicle) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" id="confirm-delete">
                        <i class="bi bi-trash3 me-1"></i> Sí, eliminar
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
