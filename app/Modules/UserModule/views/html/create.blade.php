@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'users',
])

@section('content')
    <div class="content" id="app">
        <div class="d-flex flex-row flex-wrap justify-content-center">
            <div class="col-md-9 d-flex justify-content-center mt-4 py-4">
                <div class="card mt-4">
                    <div class="card-header text-center">
                        <h5 class="card-title h3 mb-0">Formulario de creación</h5>
                    </div>
                    <div class="card-body">
                        @include('layouts.alerts')
                        <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-3 col-sm-12">
                                    <label class="form-control-label" for="input-name">Nombres <span
                                            style="color:red">*</span></label>
                                    <input type="text" name="name" id="input-name" value="{{ old('name') }}"
                                        class="form-control" placeholder="Jaden">
                                </div>

                                <div class="form-group col-md-3 col-sm-12">
                                    <label class="form-control-label" for="input-last_name">Apellidos <span
                                            style="color:red">*</span></label>
                                    <input type="text" name="last_name" id="input-last_name"
                                        value="{{ old('last_name') }}" class="form-control" placeholder="Smith">
                                </div>
                                <div class=" form-group col-md-3 col-sm-12">
                                    <label class="form-control-label" for="input-type">Tipo de usuario <span
                                            style="color:red">*</span></label>
                                    <select name="role_id" id="role-id" class="form-control">
                                        <option value="" selected disabled> Seleccione </option>
                                        @foreach ($roles as $item)
                                            <option value="{{ $item->id }}"
                                                {{ old('role_id') == $item->id ? 'selected' : '' }}> {{ $item->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-3 col-sm-12">
                                    <label class="form-control-label" for="input-email">Correo <span
                                            style="color:red">*</span></label>
                                    <input type="text" name="email" id="input-email" value="{{ old('email') }}"
                                        class="form-control" placeholder="acronym@example.com">
                                </div>
                                <div class="form-group col-md-3 col-sm-12">
                                    <label class="form-control-label" for="input-phone">Teléfono </label>
                                    <input type="text" name="phone" id="input-phone" value="{{ old('phone') }}"
                                        class="form-control" placeholder="+57 300 6356789">
                                </div>
                                <div class=" form-group col-md-3 col-sm-12">
                                    <label class="form-control-label" for="input-type">Tipo de documento <span
                                            style="color:red">*</span></label>
                                    <select name="user_document_type" id="user_document_type" class="form-control">
                                        <option value="" selected disabled> Seleccione </option>
                                        @foreach ($user_document_types as $item)
                                            <option value="{{ $item->id }}"
                                                {{ old('user_document_type') == $item->id ? 'selected' : '' }}>
                                                {{ $item->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-3 col-sm-12">
                                    <label class="form-control-label" for="input-document_number">Número de documento
                                    </label>
                                    <input type="text" name="document_number" id="input-document_number"
                                        value="{{ old('document_number') }}" class="form-control" placeholder="123132132">
                                </div>
                                <div class="form-group col-md-3 col-sm-12">
                                    <label class="form-control-label" for="input-address">Dirección </label>
                                    <input type="text" name="address" id="input-address" value="{{ old('address') }}"
                                        class="form-control" placeholder="+57 300 6356789">
                                </div>
                                <div class="form-group col-md-4 col-sm-12">
                                    <label class="form-control-label" for="input-password">Contraseña <span
                                            style="color:red">*</span></label>
                                    <input type="password" name="password" v-model="password" id="input-password"
                                        class="form-control" placeholder="Contraseña" required>
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group col-md-4 col-sm-12">
                                    <label class="form-control-label" for="input-password">Repetir Contraseña <span
                                            style="color:red">*</span></label>
                                    <input type="password" name="password_confirmation" v-model="password"
                                        id="input-password" class="form-control" placeholder="Contraseña" required>
                                    @if ($errors->has('password_confirmation'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <input type="hidden" id="roles" value="{{ $roles }}">
                                <div id="document-container" class="d-none">
                                </div>
                            </div>
                            <div class="card-footer p-3">
                                <div class="d-flex flex-row flex-wrap justify-content-end">
                                    <button type="submit" class="btn btn-primary btn-rounded">Crear Usuario</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
