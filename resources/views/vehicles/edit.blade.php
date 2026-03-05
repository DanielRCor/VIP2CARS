@extends('layouts.app')

@section('title', 'Editar — ' . $vehicle->placa)

@section('content')
<div class="page-header">
    <div class="container-xl">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-1" style="--bs-breadcrumb-divider-color:#888;">
                <li class="breadcrumb-item">
                    <a href="{{ route('vehicles.index') }}" class="text-decoration-none text-secondary">Vehículos</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('vehicles.show', $vehicle) }}" class="text-decoration-none text-secondary">
                        {{ strtoupper($vehicle->placa) }}
                    </a>
                </li>
                <li class="breadcrumb-item active text-white">Editar</li>
            </ol>
        </nav>
        <h1><i class="bi bi-pencil-square me-2"></i>Editar Vehículo</h1>
        <p>Placa: <strong>{{ strtoupper($vehicle->placa) }}</strong> &mdash; {{ $vehicle->marca }} {{ $vehicle->modelo }}</p>
    </div>
</div>

<div class="container-xl pb-5">
    <form method="POST" action="{{ route('vehicles.update', $vehicle) }}" id="edit-vehicle-form" novalidate>
        @csrf
        @method('PUT')

        <div class="row g-4">

            {{-- ── DATOS DEL VEHÍCULO ── --}}
            <div class="col-lg-6">
                <div class="card card-vip h-100">
                    <div class="card-header bg-dark text-white rounded-top">
                        <h5 class="mb-0"><i class="bi bi-car-front-fill me-2 text-danger"></i>Datos del Vehículo</h5>
                    </div>
                    <div class="card-body p-4">

                        <div class="mb-3">
                            <label for="placa" class="form-label">Placa <span class="text-danger">*</span></label>
                            <input type="text" id="placa" name="placa"
                                   class="form-control text-uppercase @error('placa') is-invalid @enderror"
                                   value="{{ old('placa', $vehicle->placa) }}"
                                   maxlength="20" required>
                            @error('placa')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="marca" class="form-label">Marca <span class="text-danger">*</span></label>
                            <input type="text" id="marca" name="marca"
                                   class="form-control @error('marca') is-invalid @enderror"
                                   value="{{ old('marca', $vehicle->marca) }}"
                                   maxlength="80" required>
                            @error('marca')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="modelo" class="form-label">Modelo <span class="text-danger">*</span></label>
                            <input type="text" id="modelo" name="modelo"
                                   class="form-control @error('modelo') is-invalid @enderror"
                                   value="{{ old('modelo', $vehicle->modelo) }}"
                                   maxlength="100" required>
                            @error('modelo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="anio_fabricacion" class="form-label">Año de Fabricación <span class="text-danger">*</span></label>
                            <input type="number" id="anio_fabricacion" name="anio_fabricacion"
                                   class="form-control @error('anio_fabricacion') is-invalid @enderror"
                                   value="{{ old('anio_fabricacion', $vehicle->anio_fabricacion) }}"
                                   min="1900" max="{{ date('Y') }}" required>
                            @error('anio_fabricacion')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                </div>
            </div>

            {{-- ── DATOS DEL CLIENTE ── --}}
            <div class="col-lg-6">
                <div class="card card-vip h-100">
                    <div class="card-header bg-dark text-white rounded-top">
                        <h5 class="mb-0"><i class="bi bi-person-fill me-2 text-warning"></i>Datos del Cliente</h5>
                    </div>
                    <div class="card-body p-4">

                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre <span class="text-danger">*</span></label>
                            <input type="text" id="nombre" name="nombre"
                                   class="form-control @error('nombre') is-invalid @enderror"
                                   value="{{ old('nombre', $vehicle->client->nombre) }}"
                                   maxlength="100" required>
                            @error('nombre')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="apellidos" class="form-label">Apellidos <span class="text-danger">*</span></label>
                            <input type="text" id="apellidos" name="apellidos"
                                   class="form-control @error('apellidos') is-invalid @enderror"
                                   value="{{ old('apellidos', $vehicle->client->apellidos) }}"
                                   maxlength="150" required>
                            @error('apellidos')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="nro_documento" class="form-label">DNI <span class="text-danger">*</span></label>
                            <input type="text" id="nro_documento" name="nro_documento"
                                   class="form-control @error('nro_documento') is-invalid @enderror"
                                   value="{{ old('nro_documento', $vehicle->client->nro_documento) }}"
                                   maxlength="8" required>
                            @error('nro_documento')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="correo" class="form-label">Correo Electrónico <span class="text-danger">*</span></label>
                            <input type="email" id="correo" name="correo"
                                   class="form-control @error('correo') is-invalid @enderror"
                                   value="{{ old('correo', $vehicle->client->correo) }}"
                                   maxlength="255" required>
                            @error('correo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="telefono" class="form-label">Teléfono <span class="text-danger">*</span></label>
                            <input type="tel" id="telefono" name="telefono"
                                   class="form-control @error('telefono') is-invalid @enderror"
                                   value="{{ old('telefono', $vehicle->client->telefono) }}"
                                   maxlength="20" required>
                            @error('telefono')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                </div>
            </div>

        </div>{{-- /row --}}

        <div class="d-flex justify-content-end gap-3 mt-4">
            <a href="{{ route('vehicles.show', $vehicle) }}" class="btn btn-outline-secondary px-4">
                <i class="bi bi-arrow-left me-1"></i> Cancelar
            </a>
            <button type="submit" class="btn btn-vip-primary px-5" id="submit-edit">
                <i class="bi bi-floppy me-1"></i> Actualizar Vehículo
            </button>
        </div>

    </form>
</div>
@endsection

@push('scripts')
<script>
document.getElementById('placa').addEventListener('input', function() {
    this.value = this.value.toUpperCase();
});
</script>
@endpush
