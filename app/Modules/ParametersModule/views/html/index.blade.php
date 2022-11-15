@extends('layouts.app')

{{-- Content --}}
@section('content')
    {{-- @include('layouts.breadCrumbs') --}}
    <div class="content" id="app">
        <div class="d-flex flex-row flex-wrap">
            <div class="col-md-7">
                @include('layouts.alerts')
                <div class="card">
                    <div class="card-header pb-0">
                        <h4 class="card-title">Parámetros </h4>
                    </div>
                    <div class="card-body px-0">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="thead-light">
                                    <th>
                                        Nombre
                                    </th>
                                    <th>
                                        Descripción
                                    </th>
                                    <th>
                                        Estado
                                    </th>
                                    <th>
                                        Opciones
                                    </th>
                                </thead>
                                <tbody>
                                    @foreach ($parameters as $parameter)
                                        <tr>
                                            <td>{{ __($parameter->name) }}</td>
                                            <td>{{ $parameter->description ?? 'Sin descripción' }}</td>
                                            <td>
                                                <span
                                                    class="label label-inline label-light-{{ $parameter->active == 1 ? 'success' : 'danger' }} font-weight-bold">
                                                    {{ $parameter->active == 1 ? 'Activo' : 'Inactivo' }}
                                                </span>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-primary btn-rd" editable="{{ $parameter->editable }}"
                                                    name="btnShowParameters" id="{{ $parameter->id }}">
                                                    <i class="fad fa-eye" style="padding:0px;" data-tooltip title="Detalle"></i>
                                                </button>
                                                {{-- <button type="button" class="btn btn-success btn-rd"
                                                data-toggle="modal" data-target="#modalEditParameter" name="btnEditParameter" id="{{$parameter->id}}">
                                                <i class="fad fa-edit" style="padding:0px;"></i>
                                            </button>
                                            <button type="button" class="btn btn-danger btn-rd" onclick="confirmDelete('parametros/delete/{{$parameter->id}}')">
                                                <i class="fad fa-trash-alt" style="padding:0px;"></i>
                                            </button> --}}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="row">
                            <div class="col">
                                <h4 class="card-title">Parámetros - Valor</h4>
                            </div>
                            <div class="d-none" id="divCreateParameter">
                                <button class="btn btn-success btn-rd" data-toggle="modal"
                                    data-target="#modalCreateParameter"> <i class="fad fa-plus p-0"></i> </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0">
                        <div class="table-responsive">
                            <table class="table" id="parameterValueTable">
                                <thead class="thead-light">
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th>Estado</th>
                                    <th>Opciones</th>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('ParametersModule.views.html.editParameterModal')
    @include('ParametersModule.views.html.createParameterValueModal')
@endsection
