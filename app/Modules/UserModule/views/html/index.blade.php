@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'users',
])

@section('content')
    <div class="content mt-0">
        <div class="d-flex flex-row flex-wrap">
            <div class="col-md-12">
                <x-tableStyled class-table="table-md mt-4">
                    <x-slot name="inputSearch">
                        <div class="d-flex flex-row flex-wrap align-items-center justify-content-end">
                            <div class="col-md-6 text-left">
                                <h6 class="title-view h3">Listado de usuarios</h6>
                            </div>

                            <div class="col-md-6 text-right">
                                <a href="{{ route('users.create') }}" class="btn btn-success btnbys">Crear</a>
                                <button class="btn btn-primary btn-filter btnbys">Filtrar</button>
                            </div>

                        </div>
                        <div class="form-filter mt-2"
                            style="display: {{ count(request()->input()) == 1 ? 'none' : 'block' }}">
                            <div class="card-body bg-gray-100 rounded-sm">
                                <div class="col-12">
                                    <h6 class="title-view">Filtros</h6>
                                </div>
                                <form action="{{ route('users.index') }}" method="get">
                                    <div class="row">
                                        <div class="col-12 col-md-6 form-group">
                                            <label for="name">Nombre completo</label>
                                            <input type="text" name="full_name" id="full_name" class="form-control"
                                                placeholder="Escriba nombre" aria-describedby="helpId"
                                                value="{{ request()->full_name }}">
                                            <small id="helpId" class="text-muted">Nombre completo filtro</small>
                                        </div>
                                        <div class="col-12 col-md-6 form-group">
                                            <label for="name">Correo Electrónico</label>
                                            <input type="email" name="email" id="email" class="form-control"
                                                placeholder="Escriba email" aria-describedby="helpId"
                                                value="{{ request()->email }}">
                                            <small id="helpId" class="text-muted">filtro correo electronico</small>
                                        </div>
                                        <div class="col-12 col-md-6 form-group">
                                            <label for="name">Rol</label>
                                            <select name="role_id" class="form-control">
                                                <option value="">Seleccione rol</option>
                                                @foreach ($roles as $item)
                                                    <option {{ request()->role_id == $item->id ? 'selected' : '' }}
                                                        value="{{ $item->id }}">
                                                        {{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                            <small id="helpId" class="text-muted">filtro rol</small>
                                        </div>
                                        <div class="col-12 col-md-6 form-group">
                                            <label for="name">Celular</label>
                                            <input type="text" name="phone" id="phone" class="form-control"
                                                placeholder="Escriba numero celular" aria-describedby="helpId"
                                                value="{{ request()->phone }}">
                                            <small id="helpId" class="text-muted">filtro celular</small>
                                        </div>
                                        <div class="col-12 col-md-6 form-group">
                                            <label for="name">Estado</label>
                                            <select name="active" class="form-control" id="">
                                                <option {{ request()->active == '' ? 'selected' : '' }} disabled>Selecione
                                                    estado
                                                </option>
                                                <option {{ request()->active == 1 ? 'selected' : '' }} value="1">
                                                    Activo
                                                </option>
                                                <option
                                                    {{ request()->active == 0 && request()->active != '' ? 'selected' : '' }}
                                                    value="0">Inactivo</option>
                                            </select>
                                            <small id="helpId" class="text-muted">filtro estado</small>
                                        </div>
                                        {{-- <div class="col-12 col-md-6 form-group">
                                            <a href="{{ route('users.index') }}" class="btn btn-block"
                                                style="background-color: #244473; color: #fff">Limpiar</a>
                                            <button type="submit" class="btn btn-block"
                                                style="background-color: #244473; color: #fff">filtrar</button>
                                        </div> --}}
                                        <div class="col-12 d-flex flex-row flex-wrap justify-content-end">
                                            <button type="submit" class="btn btn-primary mr-2">Aplicar</button>
                                            <a href="{{ route('users.index') }}" class="btn btn-secondary">Limpiar</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        @include('layouts.alerts')
                    </x-slot>
                    <x-slot name="thead">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Nombre completo</th>
                                <th scope="col">Correo electrónico</th>
                                <th scope="col">Tipo</th>
                                <th scope="col">Celular</th>
                                <th scope="col">Estado</th>
                                <th scope="col">Opciones</th>
                                <th></th>
                            </tr>
                        </thead>
                    </x-slot>
                    <x-slot name="tbody">
                        <tbody>
                            @foreach ($users as $item)
                                <tr id="{{$item->id}}">
                                    <td>{{ $item->full_name }}
                                    </td>
                                    <td>{{ $item->email ?? '' }}</td>
                                    <td>{{ $item->getRole->name ?? '' }}</td>
                                    <td>{{ $item->phone ?? '' }}</td>
                                    <td>{{ $item->active == 1 ? 'Activo' : 'Inactivo' }}</td>

                                    <td>
                                        <a href="{{ route('users.show', $item->id) }}" title="Detalle"
                                            class="btn btn-icon btn-primary btn-sm mr-2">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('users.edit', $item) }}"
                                            class="btn btn-icon btn-warning btn-sm mr-2">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="#"
                                            onclick="deleteResource('/usuarios/'+{{ $item->id }},false,{{ $item->id }})"
                                            class="btn btn-icon btn-danger btn-sm mr-2">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </x-slot>
                </x-tableStyled>
                <div class="col-md-12 d-flex align-items-center justify-content-end">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
