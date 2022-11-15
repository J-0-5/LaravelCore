@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'users',
])

@section('content')
    <div class="content" id="app">
        <div class="row">
            <div class="col-md-12 d-flex justify-content-center mt-4 py-4">
                <div class="card col-md-11 mt-4">
                    <div class="card-header text-center">
                        <h5 class="card-title h3">Detalle de usuario</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-3 col-sm-12">
                                <label class="form-control-label" for="input-name">Primer Nombre <span
                                        style="color:red">*</span></label>
                                <input type="text" name="name" id="input-name" value="{{ $user->first_name }}"
                                    class="form-control" placeholder="Jaden" readonly>
                            </div>
                            <div class="form-group col-md-3 col-sm-12">
                                <label class="form-control-label" for="input-second_name">Segundo Nombre </label>
                                <input type="text" name="second_name" id="input-second_name"
                                    value="{{ $user->second_name }}" class="form-control" placeholder="Junior" readonly>
                            </div>
                            <div class="form-group col-md-3 col-sm-12">
                                <label class="form-control-label" for="input-last_name">Primer Apellido <span
                                        style="color:red">*</span></label>
                                <input type="text" name="last_name" id="input-last_name" value="{{ $user->last_name }}"
                                    class="form-control" placeholder="Smith" readonly>
                            </div>
                            <div class="form-group col-md-3 col-sm-12">
                                <label class="form-control-label" for="input-second_last_name">Segundo Apellido <span
                                        style="color:red">*</span></label>
                                <input type="text" name="second_last_name" id="input-second_last_name"
                                    value="{{ $user->second_last_name }}" class="form-control" placeholder="Jackson"
                                    readonly>
                            </div>
                            <div class=" form-group col-md-3 col-sm-12">
                                <label class="form-control-label" for="input-type">Tipo de usuario <span
                                        style="color:red">*</span></label>
                                <select name="role_id" id="role_id" class="form-control" disabled>
                                    @foreach ($roles as $item)
                                        <option value="{{ $item->id }}"
                                            {{ $user->role_id == $item->id ? 'selected' : '' }}> {{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3 col-sm-12">
                                <label class="form-control-label" for="input-email">Correo <span
                                        style="color:red">*</span></label>
                                <input type="text" name="email" id="input-email" value="{{ $user->email }}"
                                    class="form-control" placeholder="acronym@example.com" readonly>
                            </div>
                            <div class="form-group col-md-3 col-sm-12">
                                <label class="form-control-label" for="input-phone">Teléfono </label>
                                <input type="text" name="phone" id="input-phone" value="{{ $user->phone }}"
                                    class="form-control" placeholder="+57 300 6356789" readonly>
                            </div>
                            <div class=" form-group col-md-3 col-sm-12">
                                <label class="form-control-label" for="input-level_study">Nivel de estudio </label>
                                <select name="level_study" id="level_study" class="form-control" disabled>
                                    <option value=""> Seleccione </option>
                                    <option value="1" {{ $user->level_study == 1 ? 'selected' : '' }}> Técnico </option>
                                    <option value="2" {{ $user->level_study == 2 ? 'selected' : '' }}> Tecnólogo
                                    </option>
                                    <option value="3" {{ $user->level_study == 3 ? 'selected' : '' }}> Profesional
                                    </option>
                                </select>
                            </div>
                            <div class=" form-group col-md-3 col-sm-12">
                                <label class="form-control-label" for="input-faculty">Facultad </label>
                                <select name="faculty" id="faculty" class="form-control" disabled>
                                    <option value=""> Seleccione </option>
                                    <option value="1" {{ $user->faculty == 1 ? 'selected' : '' }}> Facultad de
                                        Arquitectura
                                    </option>
                                    <option value="2" {{ $user->faculty == 2 ? 'selected' : '' }}> Facultad de Artes y
                                        Diseño </option>
                                    <option value="3" {{ $user->faculty == 3 ? 'selected' : '' }}> Facultad de Ciencias
                                    </option>
                                </select>
                            </div>
                            <div class=" form-group col-md-3 col-sm-12">
                                <label class="form-control-label" for="input-program">Programa </label>
                                <select name="program" id="program" class="form-control" disabled>
                                    <option value=""> Seleccione </option>
                                    <option value="1" {{ $user->program == 1 ? 'selected' : '' }}> Ingenieria Industrial
                                    </option>
                                    <option value="2" {{ $user->program == 2 ? 'selected' : '' }}> Ingenieria de Sistemas
                                    </option>
                                    <option value="3" {{ $user->program == 3 ? 'selected' : '' }}> Administración de
                                        Empresas </option>
                                </select>
                            </div>
                            <div class="form-group col-md-3 col-sm-12">
                                <label class="form-control-label" for="input-researcher_since">Fecha Investigador </label>
                                <input type="date" name="researcher_since" id="input-researcher_since"
                                    value="{{ $user->researcher_since }}" class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
