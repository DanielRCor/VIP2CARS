@extends('layouts.app')

@section('title', 'Vehículos')

@section('content')
<div class="page-header">
    <div class="container-xl d-flex justify-content-between align-items-center flex-wrap gap-3">
        <div>
            <h1><i class="bi bi-car-front-fill me-2"></i>Vehículos Registrados</h1>
            <p>Listado completo de vehículos y clientes de VIP2CARS</p>
        </div>
        <a href="{{ route('vehicles.create') }}" class="btn btn-vip-primary">
            <i class="bi bi-plus-lg me-1"></i> Nuevo Vehículo
        </a>
    </div>
</div>

<div class="container-xl pb-4">

    {{-- ── BARRA DE BÚSQUEDA ── --}}
    <div class="card card-vip mb-4">
        <div class="card-body py-3">
            <form method="GET" action="{{ route('vehicles.index') }}" id="search-form">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0">
                        <i class="bi bi-search text-muted"></i>
                    </span>
                    <input
                        type="text"
                        id="search"
                        name="search"
                        class="form-control border-start-0 ps-0"
                        placeholder="Buscar por placa, marca, modelo, nombre o documento..."
                        value="{{ $search }}"
                        autocomplete="off"
                    >
                    @if($search)
                        <a href="{{ route('vehicles.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-x-lg"></i> Limpiar
                        </a>
                    @endif
                    <button type="submit" class="btn btn-vip-primary px-4" id="search-btn">
                        Buscar
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- ── RESULTADOS ── --}}
    @if($vehicles->isEmpty())
        <div class="card card-vip">
            <div class="card-body text-center py-5">
                <i class="bi bi-car-front text-muted" style="font-size:3rem"></i>
                <p class="mt-3 text-muted fs-5">
                    @if($search)
                        No se encontraron vehículos para "<strong>{{ $search }}</strong>"
                    @else
                        Aún no hay vehículos registrados.
                    @endif
                </p>
                <a href="{{ route('vehicles.create') }}" class="btn btn-vip-primary mt-2">
                    <i class="bi bi-plus-lg me-1"></i> Registrar Primer Vehículo
                </a>
            </div>
        </div>
    @else
        {{-- Info de resultados --}}
        <div class="d-flex justify-content-between align-items-center mb-2">
            <small class="text-muted">
                Mostrando {{ $vehicles->firstItem() }}&ndash;{{ $vehicles->lastItem() }}
                de <strong>{{ $vehicles->total() }}</strong> vehículos
                @if($search) para "<em>{{ $search }}</em>" @endif
            </small>
        </div>

        <div class="card card-vip">
            <div class="table-responsive">
                <table class="table table-vip table-hover align-middle mb-0" id="vehicles-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Placa</th>
                            <th>Marca / Modelo</th>
                            <th>Año</th>
                            <th>Cliente</th>
                            <th>Documento</th>
                            <th>Teléfono</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($vehicles as $vehicle)
                        <tr>
                            <td class="text-muted fs-sm">{{ $vehicle->id }}</td>
                            <td>
                                <span class="badge-placa">{{ strtoupper($vehicle->placa) }}</span>
                            </td>
                            <td>
                                <strong>{{ $vehicle->marca }}</strong>
                                <span class="text-muted d-block" style="font-size:.85rem">{{ $vehicle->modelo }}</span>
                            </td>
                            <td>
                                <span class="badge bg-secondary">{{ $vehicle->anio_fabricacion }}</span>
                            </td>
                            <td>
                                <strong>{{ $vehicle->client->nombre_completo }}</strong>
                                <a href="mailto:{{ $vehicle->client->correo }}"
                                   class="d-block text-muted text-decoration-none"
                                   style="font-size:.82rem">
                                    {{ $vehicle->client->correo }}
                                </a>
                            </td>
                            <td class="text-monospace">{{ $vehicle->client->nro_documento }}</td>
                            <td>{{ $vehicle->client->telefono }}</td>
                            <td class="text-center">
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="{{ route('vehicles.show', $vehicle) }}"
                                       class="btn btn-outline-secondary" title="Ver detalle" id="show-{{ $vehicle->id }}">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('vehicles.edit', $vehicle) }}"
                                       class="btn btn-outline-primary" title="Editar" id="edit-{{ $vehicle->id }}">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button type="button"
                                            class="btn btn-outline-danger btn-delete"
                                            data-id="{{ $vehicle->id }}"
                                            data-placa="{{ $vehicle->placa }}"
                                            data-bs-toggle="modal"
                                            data-bs-target="#deleteModal"
                                            title="Eliminar" id="delete-btn-{{ $vehicle->id }}">
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- ── PAGINACIÓN ── --}}
        @if($vehicles->hasPages())
        <div class="d-flex justify-content-center mt-4">
            {{ $vehicles->links('pagination::bootstrap-5') }}
        </div>
        @endif
    @endif
</div>

{{-- ── MODAL DE CONFIRMACIÓN DE BORRADO ── --}}
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-danger text-white border-0">
                <h5 class="modal-title"><i class="bi bi-exclamation-triangle-fill me-2"></i>Confirmar eliminación</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p class="mb-1">¿Estás seguro de eliminar el vehículo con placa:</p>
                <p class="fs-4 fw-bold text-center my-2" id="modal-placa"></p>
                <p class="text-muted small">Esta acción no se puede deshacer. Si el cliente no tiene más vehículos, también será eliminado.</p>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="bi bi-x me-1"></i>Cancelar
                </button>
                <form id="delete-form" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" id="confirm-delete">
                        <i class="bi bi-trash3 me-1"></i>Sí, eliminar
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.querySelectorAll('.btn-delete').forEach(btn => {
    btn.addEventListener('click', function() {
        const id    = this.dataset.id;
        const placa = this.dataset.placa;
        document.getElementById('modal-placa').textContent = placa.toUpperCase();
        document.getElementById('delete-form').action =
            '/vehicles/' + id;
    });
});
</script>
@endpush
