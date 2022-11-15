{{-- Extends layout --}}
@extends('layouts.app')

{{-- Content --}}
@section('content')
    {{-- {{dd($parm_id)}} --}}
    <div class="content w-100 p-10 px-20 d-flex flex-row flex-wrap justify-content-around"
        style="padding-inline:100px !important">

        <div class="col-md-6">
            <x-tableStyled class-table="">
                <x-slot name="inputSearch">
                    <div class="d-flex flex-row flex-wrap justify-content-between">
                        <div class="left-inner-addon input-container col-6">
                        </div>
                        <div class="d-flex flex-row flex-wrap align-items-center">
                            <div class="mr-2">
                                <a href="#" class="btn btn-warning btn-block btn-round" data-toggle="modal"
                                    data-target="#modalCreateFaculty">
                                    <div class="d-flex flex-row flex-wrap align-items-center justify-content-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24">
                                            <g id="Icon_feather-plus" data-name="Icon feather-plus"
                                                transform="translate(-6 -6)">
                                                <path id="Trazado_99" data-name="Trazado 99" d="M18,7.5v21" fill="none"
                                                    stroke="#fff" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="3" />
                                                <path id="Trazado_100" data-name="Trazado 100" d="M7.5,18h21" fill="none"
                                                    stroke="#fff" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="3" />
                                            </g>
                                        </svg>
                                        <span class="ml-3">Crear Facultad</span>
                                    </div>
                                </a>
                            </div>
                            <div class="">
                                <button type="button" data-toggle="collapse" data-target="#filterCollapseFac"
                                    aria-expanded="true" aria-controls="filterCollapse" class="btn btn-primary btn-round"><i
                                        class="fad fa-filter"></i> Filtrar
                                </button>
                            </div>
                        </div>
                    </div>
                    <div id="filterCollapseFac" class="p-5 bg-gray-100 rounded-sm mt-4 collapse">
                        <div class="d-flex flex-row flex-wrap">
                            <div class="col-12">
                                <h6 class="title-view">Filtros</h6>
                            </div>

                            <div class="col-md-6 mb-2"><label for="type"
                                    class="title-view text-info-12">Facultad:</label>
                                <select name="type" id="type" class="form-control">
                                    <option value="">
                                        Facultad de Arquitectura
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-2"><label for="status" class="title-view text-info-12">Estado:</label>
                                <select id="status" class="form-control">
                                    <option value="1">Activo</option>
                                    <option value="0">Inactivo</option>
                                </select>
                            </div>
                            <div class="col-12 d-flex flex-row flex-wrap justify-content-end"><button type="button"
                                    class="btn btn-primary mr-2">Aplicar</button> <button type="button"
                                    class="btn btn-secondary">Limpiar</button>
                            </div>
                        </div>
                    </div>
                </x-slot>

                <x-slot name="thead">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Nombre de Facultad</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Opciones</th>
                        </tr>
                    </thead>
                </x-slot>
                <x-slot name="tbody">
                    {{-- {{dd($falcult)}} --}}
                    <tbody id='fact'>
                        @foreach ($dat as $item)
                            <tr id={{ $item->id }}>
                                <td>{{ $item->name }}</td>
                                @if ($item->active == 1)
                                    <td>
                                        <a href="#">
                                            <img src="{{ asset('img/icon/statusok.png') }}" class="icon-table"
                                                alt="">
                                        </a>
                                    </td>
                                @elseif ($item->active == 0)
                                    <td>
                                        <a href="#">
                                            <img src="{{ asset('img/icon/statusbad.png') }}" class="icon-table"
                                                alt="">
                                        </a>
                                    </td>
                                @endif
                                <td>
                                    <a href="#" class="showEditFaculty mr-2" data-tooltip title="Editar" data-toggle="modal"
                                        data-target="#modalEditFaculty" data-idedit={{ $item->id }}>
                                        <img
                                            src="/img/icon/edit.png" class="icon-table" alt=""></a>
                                    <a href="#" class="deleteFac" data-id={{ $item->id }}><img
                                            src="/img/icon/delete.png" class="icon-table" data-tooltip title="Eliminar" alt=""></a>
                                </td>
                                <td>
                                </td>
                            </tr>
                        @endforeach
                </x-slot>
            </x-tableStyled>
        </div>


        <div class="col-md-6">
            <x-tableStyled class-table="">
                <x-slot name="inputSearch">
                    <div class="d-flex flex-row flex-wrap justify-content-between">
                        <div class="left-inner-addon input-container col-6">
                        </div>
                        <div class="d-flex flex-row align-items-center">
                            <div class="mr-2">
                                <a href="#" class="btn btn-warning btn-block btn-round" data-toggle="modal"
                                    data-target="#modalCreateProgram">
                                    <div class="d-flex flex-row flex-wrap align-items-center justify-content-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24">
                                            <g id="Icon_feather-plus" data-name="Icon feather-plus"
                                                transform="translate(-6 -6)">
                                                <path id="Trazado_99" data-name="Trazado 99" d="M18,7.5v21"
                                                    fill="none" stroke="#fff" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="3" />
                                                <path id="Trazado_100" data-name="Trazado 100" d="M7.5,18h21"
                                                    fill="none" stroke="#fff" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="3" />
                                            </g>
                                        </svg>
                                        <span class="ml-3">Crear Programa</span>
                                    </div>
                                </a>
                            </div>
                            <div>
                                <button type="button" data-toggle="collapse" data-target="#filterCollapseProg"
                                    aria-expanded="true" aria-controls="filterCollapse"
                                    class="btn btn-primary btn-round"><i class="fad fa-filter"></i> Filtrar
                                </button>
                            </div>
                        </div>
                    </div>
                    <div id="filterCollapseProg" class="p-5 bg-gray-100 rounded-sm mt-4 collapse">
                        <div class="d-flex flex-row flex-wrap">
                            <div class="col-12">
                                <h6 class="title-view">Filtros</h6>
                            </div>

                            <div class="col-md-6 mb-2"><label for="type"
                                    class="title-view text-info-12">Programa:</label>
                                <select name="type" id="type" class="form-control">
                                    <option value="">
                                        Arquitectura
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-2"><label for="status"
                                    class="title-view text-info-12">Estado:</label>
                                <select id="status" class="form-control">
                                    <option value="1">Activo</option>
                                    <option value="0">Inactivo</option>
                                </select>
                            </div>
                            <div class="col-12 d-flex flex-row flex-wrap justify-content-end"><button type="button"
                                    class="btn btn-primary mr-2">Aplicar</button> <button type="button"
                                    class="btn btn-secondary">Limpiar</button>
                            </div>
                        </div>
                    </div>
                </x-slot>
                <x-slot name="thead">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Nombre de Programa</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Opciones</th>
                        </tr>
                    </thead>
                </x-slot>
                <x-slot name="tbody">
                    <tbody id="showProgram">
                        {{-- @foreach ($prog as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                @if ($item->state == 1)
                                    <td>
                                        <a href="#">
                                            <img src="{{ asset('img/icon/statusok.png') }}" class="icon-table" alt="">
                                        </a>
                                    </td>
                                @elseif ($item->state == 0)
                                    <td>
                                        <a href="#">
                                            <img src="{{ asset('img/icon/statusbad.png') }}" class="icon-table" alt="">
                                        </a>
                                    </td>
                                @endif
                                <td>
                                    <a href="#">
                                        <img src="{{ asset('img/icon/edit.png') }}" class="icon-table" alt="">
                                    </a>
                                </td>
                                <td>
                                    <a href="#">
                                        <img src="{{ asset('img/icon/delete.png') }}" class="icon-table" alt="">
                                    </a>
                                </td>
                            </tr>
                        @endforeach --}}
                    </tbody>
                </x-slot>
            </x-tableStyled>
        </div>

        <div class="col-md-12 px-0">
            <investigation-line :faculties="{{ $faculties }}" :inv_lines="{{ $inv_line }}">
            </investigation-line>
        </div>


        {{-- components --}}
        <x-modal-component id-component="modalCreateFaculty" title-modal="Crear Facultad" button-submit="Crear"
            route-name="{{ route('faculty.store') }}" method="POST" button-delete="false" route-delete=""
            secondary-method="false" class-modal="modal-md">
            <x-slot name="modalBody">
                <div class="col-12">
                    <div class="form-group">
                        <label>Nombre:<span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" id="name" placeholder=""
                            required />
                    </div>
                    <div class="form-group" hidden>
                        <input type="text" name="parameter_id" class="form-control" placeholder=""
                            value="{{ $fac }}" />
                    </div>
                    <div class="form-group mb-5">
                        <label for="descrip">Descripción:</label>
                        <textarea class="form-control" name="description" id="descrip" rows="3"></textarea>
                    </div>
                </div>
            </x-slot>
        </x-modal-component>

        <x-modal-component id-component="modalCreateProgram" title-modal="Crear Programa" button-submit="Crear"
            route-name="{{ route('programs.store') }}" method="POST" button-delete="false" route-delete=""
            secondary-method="false" class-modal="modal-md">
            <x-slot name="modalBody">
                <div class="col-12">
                    <div class="form-group">
                        <label for="frmPrograms">Facultad:<span class="text-danger">*</span></label>
                        <select name="parent_id" id="frmPrograms" class="form-control" required>
                            <option value="" disabled selected>Seleccione una facultad</option>
                            @foreach ($dat->where('active', 1) as $fac)
                                <option value="{{ $fac->id }}">{{ $fac->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Nombre:<span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" placeholder="" required />
                    </div>
                    <div class="form-group" hidden>
                        <input type="text" name="parameter_id" class="form-control" placeholder=""
                            value="{{ $parm_id }}" />
                    </div>
                    <div class="form-group mb-1">
                        <label for="descrip">Descripción:</label>
                        <textarea class="form-control" name="description" id="descrip" rows="3"></textarea>
                    </div>
                </div>
            </x-slot>
        </x-modal-component>

        <x-modal-component id-component="modalEditProgram" title-modal="Editar Programa" button-submit="Guardar"
            route-name="#" method="PUT" button-delete="false" id="" route-delete=""
            secondary-method="false" class-modal="modal-md">
            <x-slot name="modalBody">
                <div class="col-12">
                    <div class="form-group">
                        <label for="frmPrograms">Facultad:<span class="text-danger">*</span></label>
                        <select name="parent_id" id="frmPrograms" class="form-control">
                            <option value="" id="opt" selected disabled>Seleccione una facultad</option>
                            @foreach ($dat as $fac)
                                <option value="{{ $fac->id }}">{{ $fac->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Nombre:<span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" id="name" placeholder=""
                            required />
                    </div>
                    <div class="form-group" hidden>
                        <input type="text" name="parameter_id" class="form-control" placeholder=""
                            value="{{ $parm_id }}" />
                    </div>
                    <div class="form-group mb-5">
                        <label for="descrip">Descripción:</label>
                        <textarea class="form-control" name="description" id="descrip" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="descrip">Estado:</label>
                        <input type="checkbox" class="progState" name="active" id="parameter_state_edit" />
                    </div>
                    {{-- <div class="form-group mb-1">
                        <label for="descrip" class="ml-3">Estado: </label>
                        @if ($item->state == 1)
                            <td>
                                <a href="#">
                                    <img src="{{ asset('img/icon/statusok.png') }}" class="icon-table" alt="">
                                </a>
                            </td>
                        @elseif ($item->state == 0)
                            <td>
                                <a href="#">
                                    <img src="{{ asset('img/icon/statusbad.png') }}" class="icon-table" alt="">
                                </a>
                            </td>
                        @endif
                    </div> --}}
                </div>
            </x-slot>
        </x-modal-component>
        <x-modal-component id-component="modalEditFaculty" title-modal="Editar Facultad" button-submit="Guardar"
            route-name="#" method="PUT" button-delete="false" route-delete="" secondary-method="false"
            class-modal="modal-md">
            <x-slot name="modalBody">
                <div class="col-12">
                    <div class="form-group">
                        <label>Nombre de facultad:<span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" id="name" placeholder=""
                            required />
                    </div>
                    <div class="form-group" hidden>
                        <input type="text" name="parameter_id" class="form-control" placeholder=""
                            value="{{ $fac }}" />
                    </div>
                    <div class="form-group mb-5">
                        <label for="descrip">Descripción:</label>
                        <textarea class="form-control" name="description" id="descrip" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="descrip">Estado:</label>
                        <input type="checkbox" class="progState" name="active" id="parameter_state_edit" />
                    </div>
                </div>
            </x-slot>
        </x-modal-component>
    </div>

    {{-- </div> --}}
@endsection
