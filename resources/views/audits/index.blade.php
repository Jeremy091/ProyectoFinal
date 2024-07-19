@extends('tablar::page')

@section('title')
    Auditorías
@endsection

@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        List
                    </div>
                    <h2 class="page-title">
                        {{ __('Auditorías') }}
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-12 col-md-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="{{ route('audits.pdf') }}" class="btn btn-secondary d-none d-sm-inline-block">
                            Exportar a PDF
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            @if (config('tablar', 'display_alert'))
                @include('tablar::common.alert')
            @endif
            <div class="row row-deck row-cards">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Auditorías</h3>
                        </div>
                        <div class="card-body border-bottom py-3">
                            <div class="d-flex">
                                <div class="ms-auto text-muted">
                                    Buscar:
                                    <div class="ms-2 d-inline-block">
                                        <form action="{{ route('audits.index') }}" method="GET">
                                            <input type="text" name="search" class="form-control form-control-sm"
                                                aria-label="Search category" value="{{ request()->input('search') }}">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive min-vh-100">
                            <table class="table card-table table-vcenter text-nowrap datatable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Usuario</th>
                                        <th>Evento</th>
                                        <th>Modelo</th>
                                        <th>ID del Modelo</th>
                                        <th>Valores Anteriores</th>
                                        <th>Valores Nuevos</th>
                                        <th>Fecha</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($audits as $audit)
                                        <tr>
                                            <td style="word-wrap: break-word; white-space: pre-wrap;">{{ $audit->id }}</td>
                                            <td style="word-wrap: break-word; white-space: pre-wrap;">{{ optional($audit->user)->name }}</td>
                                            <td style="word-wrap: break-word; white-space: pre-wrap;">{{ $audit->event }}</td>
                                            <td style="word-wrap: break-word; white-space: pre-wrap;">{{ class_basename($audit->auditable_type) }}</td>
                                            <td style="word-wrap: break-word; white-space: pre-wrap;">{{ $audit->auditable_id }}</td>
                                            <td style="word-wrap: break-word; white-space: pre-wrap;">
                                                @foreach ($audit->old_values as $key => $value)
                                                    <strong>{{ $key }}:</strong> {{ $value }}<br>
                                                @endforeach
                                            </td>
                                            <td style="word-wrap: break-word; white-space: pre-wrap;">
                                                @foreach ($audit->new_values as $key => $value)
                                                    <strong>{{ $key }}:</strong> {{ $value }}<br>
                                                @endforeach
                                            </td>
                                            <td style="word-wrap: break-word; white-space: pre-wrap;">{{ $audit->created_at }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer d-flex align-items-center">
                            {{ $audits->links('tablar::pagination') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Selector de tipo de gráfico -->
        <div class="row row-deck row-cards mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Gráfica de Auditorías</h3>
                        <div class="ms-auto">
                            <select id="chartType" class="form-select">
                                <option value="bar">Barras</option>
                                <option value="pie">Circular</option>
                                <option value="line">Líneas</option>
                                <option value="area">Área</option>
                            </select>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="auditChart" width="400" height="200" style="max-width: 100%; height: auto;"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Script para generar la gráfica -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const ctx = document.getElementById('auditChart').getContext('2d');
            
            const userEvents = @json($userEvents);

            // Generar colores aleatorios para cada usuario
            const colors = Object.keys(userEvents).map(() => {
                const color = `#${Math.floor(Math.random()*16777215).toString(16)}`;
                return {
                    backgroundColor: color + '33', // Transparente para área y barras
                    borderColor: color
                };
            });

            let chartType = document.getElementById('chartType').value;

            let auditChart = new Chart(ctx, {
                type: chartType,
                data: {
                    labels: Object.keys(userEvents),
                    datasets: [
                        {
                            label: 'Creado',
                            data: Object.values(userEvents).map(user => user.created),
                            ...colors[0]
                        },
                        {
                            label: 'Actualizado',
                            data: Object.values(userEvents).map(user => user.updated),
                            ...colors[1]
                        },
                        {
                            label: 'Eliminado',
                            data: Object.values(userEvents).map(user => user.deleted),
                            ...colors[2]
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            document.getElementById('chartType').addEventListener('change', function() {
                const selectedType = this.value;
                auditChart.destroy();
                auditChart = new Chart(ctx, {
                    type: selectedType === 'area' ? 'line' : selectedType,
                    data: {
                        labels: Object.keys(userEvents),
                        datasets: [
                            {
                                label: 'Creado',
                                data: Object.values(userEvents).map(user => user.created),
                                fill: selectedType === 'area',
                                ...colors[0]
                            },
                            {
                                label: 'Actualizado',
                                data: Object.values(userEvents).map(user => user.updated),
                                fill: selectedType === 'area',
                                ...colors[1]
                            },
                            {
                                label: 'Eliminado',
                                data: Object.values(userEvents).map(user => user.deleted),
                                fill: selectedType === 'area',
                                ...colors[2]
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            });
        });
    </script>
@endsection
