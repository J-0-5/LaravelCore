@extends('layouts.app')

@section('content')
    <div class="container p-7">
        <div class="d-flex flex-row flex-wrap align-items-center">
            <div class="col-12 d-flex flex-row flex-wrap">
                <x-stat-card cantidad="12" tituloCard="Solicitudes" themeIcon="success" class-card="col-md-3 mr-4">
                </x-stat-card>
                <x-stat-card cantidad="100" tituloCard="Solicitudes" themeIcon="warning" class-card="col-md-3 mr-4">
                </x-stat-card>
                <x-stat-card cantidad="55" tituloCard="Solicitudes" themeIcon="primary" class-card="col-md-3 mr-4">
                </x-stat-card>
            </div>

            <div class="col-12 mt-4">
                <div class="card" style="box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;">
                    <div class="card-header">
                        <h6 class="title-view mb-0">Estadísticas</h6>
                    </div>
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-3">
                                <p class="mb-0 font-weight-bold">ESTADISTICAS</p>
                                <p class="mb-0 font-weight-bolder">10000</p>
                            </div>
                            <div class="col-3">
                                <p class="mb-0 font-weight-bold">PROYECTOS</p>
                                <p class="mb-0 font-weight-bolder">10000</p>
                            </div>
                            <div class="col-3">
                                <p class="mb-0 font-weight-bold">SOLICITUDES</p>
                                <p class="mb-0 font-weight-bolder">10000</p>
                            </div>
                            <div class="col-3">
                                <p class="mb-0 font-weight-bold">TERMINADOS</p>
                                <p class="mb-0 font-weight-bolder">10000</p>
                            </div>
                        </div>
                        <div class="d-flex flex-row flex-wrap">
                            <div class="firstChart">

                            </div>
                            <div class="secondChart">

                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
