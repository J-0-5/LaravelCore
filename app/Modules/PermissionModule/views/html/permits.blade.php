{{-- Extends layout --}}
@extends('layouts.app')

{{-- Content --}}
@section('content')
    @include('layouts.alerts')
    @include('PermissionModule.views.html.roleModals')
    <div class="row p-3">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">

                </div>
                <div class="card-body">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <button class="nav-link active" id="nav-role-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-role" type="button" role="tab" aria-controls="nav-role"
                                aria-selected="true">Roles</button>
                            <button class="nav-link" id="nav-user-tab" data-bs-toggle="tab" data-bs-target="#nav-user"
                                type="button" role="tab" aria-controls="nav-user"
                                aria-selected="false">Usuarios</button>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active bg-white" id="nav-role" role="tabpanel"
                            aria-labelledby="nav-role-tab">
                            <div class="row p-2">
                                <hr>
                                <div class="col-12 text-right pt-2">
                                    <button {{ Auth::user()->id != 1 ? 'disabled' : '' }} type="button"
                                        class="btn btn-primary btn-sm text-uppercase" data-toggle="modal"
                                        data-target="#createRolModal"><i class="fa fa-plus"></i>
                                        Agregar rol</button>
                                </div>
                            </div>
                            <table class="table table__contenedor">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Estado</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roles as $role)
                                        <tr id="{{ $role->id }}" attribute-name="{{ $role->name }}" associate="roles">
                                            <td class="text-uppercase">{{ $role->name }}</td>
                                            <td>
                                                <span
                                                    class="badge badge-{{ Config::get('const.states')[$role->active]['color'] }} text-uppercase">{{ Config::get('const.states')[$role->active]['name'] }}</span>
                                            </td>
                                            <td class="text-center">
                                                <button {{ Auth::user()->id != 1 ? 'disabled' : '' }} name="btnEditRole"
                                                    id="btnRole-{{ $role->id }}"
                                                    class="btn btn-primary btn-sm btn-fab btn-icon" data-toggle="modal"
                                                    data-target="#editRolModal" data-tooltip title="Editar">
                                                    <i class="fa fa-pencil"></i>
                                                </button>
                                                <button {{ $role->id == 1 || Auth::user()->id != 1 ? 'disabled' : '' }}
                                                    class="btn btn-danger btn-sm btn-fab btn-icon" data-tooltip
                                                    title="Eliminar" onclick="confirmDelete('/roles/'+{{ $role->id }})">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                                <button {{ $role->id == 1 || Auth::user()->id != 1 ? 'disabled' : '' }}
                                                    class="btn btn-info btn-sm btn-fab btn-icon configuration-role-btn"
                                                    data-tooltip title="Configurar">
                                                    <i class="fa fa-cog"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade bg-white" id="nav-user" role="tabpanel" aria-labelledby="nav-user-tab">
                            <table class="table table__contenedor">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Estado</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr id="{{ $user->id }}" attribute-name="{{ $user->full_name }}" associate="users">
                                            <td class="text-uppercase">{{ $user->full_name }}</td>
                                            <td>
                                                <span
                                                    class="badge badge-{{ Config::get('const.states')[$user->active]['color'] }} text-uppercase">{{ Config::get('const.states')[$user->active]['name'] }}</span>
                                            </td>
                                            <td class="text-center">
                                                <button {{ $user->id == 1 || Auth::user()->id != 1 ? 'disabled' : '' }}
                                                    class="btn btn-info btn-sm btn-fab btn-icon configuration-user-btn"
                                                    data-tooltip title="Configurar">
                                                    <i class="fa fa-cog"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="card formclass">
                <form id="documents-form" method="POST">
                    @csrf @method('PUT')
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <h4 id="documents-label" class="card-title">Documentos</h4>
                            </div>
                            <div class="col text-right">
                                <button type="submit" class="btn btn-primary btn-sm d-none" id="submit-btn-documents">
                                    <i class="fas fa-save"></i> Guardar documentos
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-12">
                                <div class="card my-2">
                                    <div class="card-body" id="card-body-documents">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="row p-3">
        <div class="col-md-12">
            <div class="card formclass">
                <form id="permits-form" method="POST">
                    @csrf @method('PUT')

                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <h4 id="permits-label" class="card-title">Permisos</h4>
                            </div>
                            <div class="col text-right">
                                <button type="submit" class="btn btn-primary btn-sm d-none" id="submit-btn"><i
                                        class="fas fa-save"></i> Guardar
                                    permisos</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-12">
                                <div class="card my-2">
                                    <div class="card-body" id="card-body">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
