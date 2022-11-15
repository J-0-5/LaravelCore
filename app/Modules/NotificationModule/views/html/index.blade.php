{{-- Extends layout --}}
@extends('layouts.app')

{{-- Content --}}
@section('content')
<div class="content content-left-main p-5">
    <div class="d-flex flex-row flex-wrap">
        <div class="col-md-12">
            <x-tableStyled class-table="table-sm">
                <x-slot name="inputSearch">
                    <div class="d-flex flex-row flex-wrap align-items-center justify-content-between">
                        <h6 class="title-view mb-0">NOTIFICACIONES</h6>
                        <div class="col-md-4 d-flex flex-row justify-content-end">
                            <a href="#" role="button" class="btn btn-success btnbys mr-3">
                                Crear
                            </a>
                            <button class="btn btn-primary btn-filter btnbys">Filtro</button>
                        </div>
                        <div class="col-md-12">
                            <div class="form-filter mt-2"
                                style="display: {{ request()->input() == [] ? 'none' : 'block' }}">
                                <div class="card-body bg-gray-100 rounded-sm">
                                    <div class="col-12">
                                        <h6 class="title-view">Filtros</h6>
                                    </div>
                                    <form action="#" method="get">
                                        <div class="row">
                                            <div class="col-12 col-md-6 form-group">
                                                <label for="">NOMBRE</label>
                                                <input type="text" name="name_lab" id=""
                                                    class="form-control"
                                                    aria-describedby="helpId" value="">
                                            </div>
                                            <div class="col-12 col-md-6 form-group">
                                                <label for="">FECHA</label>
                                                <input type="date" name="name_lab" id=""
                                                    class="form-control" placeholder="Nombre convocatoria"
                                                    aria-describedby="helpId" value="">
                                            </div>
                                            <div class="col-12 col-md-6 form-group">
                                                <label for="">HORA</label>
                                                <input type="time" name="name_lab" id=""
                                                    class="form-control"
                                                    aria-describedby="helpId">
                                            </div>
                                            <div class="col-12 col-md-6 form-group">
                                                <label for="">Estado</label>
                                                <select class="form-control" id="exampleSelect1">
                                                    <option>1</option>
                                                    <option>2</option>
                                                    <option>3</option>
                                                    <option>4</option>
                                                    <option>5</option>
                                                </select>
                                            </div>
                                            {{-- <div class="col-12 col-md-6 form-group">
                                            <label for="pagination">Paginación</label>
                                            <select name="pagination" class="form-control" id="pagination">
                                                <option value="15"
                                                    {{ request()->pagination == 15 ? 'selected' : '' }}>15
                                                </option>
                                                <option value="25"
                                                    {{ request()->pagination == 25 ? 'selected' : '' }}>25
                                                </option>
                                                <option value="50"
                                                    {{ request()->pagination == 50 ? 'selected' : '' }}>50
                                                </option>
                                                <option value="100"
                                                    {{ request()->pagination == 100 ? 'selected' : '' }}>100
                                                </option>
                                            </select>
                                            <small id="helpId" class="text-muted">paginar</small>
                                        </div> --}}
                                            <div class="col-12 d-flex flex-row flex-wrap justify-content-end">
                                                <a href="#"
                                                    class="btn btn-secondary mr-2">Limpiar</a>
                                                <button type="submit" class="btn btn-primary">Filtrar</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @include('layouts.alerts')
                </x-slot>
                <x-slot name="thead">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">NOMBRE</th>
                            <th scope="col">FECHA</th>
                            <th scope="col">HORA</th>
                            <th scope="col">Opciones</th>
                        </tr>
                    </thead>
                </x-slot>
                <x-slot name="tbody">
                    <tbody>
                        <tr>
                            <td>CREACIÓN DE NUEVA SOLICITUD</td>
                            <td>
                                12/12/2022
                            </td>
                            <td>
                                10:00
                            </td>
                            <td class="d-flex justify-content-center">
                                <a href="#" data-tooltip title="Detalle"
                                    class="btn btn-icon btn-primary btn-sm mr-2">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </x-slot>
            </x-tableStyled>
        </div>
    </div>
</div>
@endsection
