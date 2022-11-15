@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'users',
])

@section('content')
    <div class="content" id="app">
        <div class="row">
            <div class="col-md-12 d-flex justify-content-center mt-4 py-4">
                <div class="card  col-md-11 mt-4">
                    <div class="card-header text-center">
                        <h5 class="card-title h3">Formulario de edición</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            @include('layouts.alerts')
                            <div class="row">
                                <div class="form-group col-md-6 col-sm-12">
                                    <label class="form-control-label" for="input-name">Nombres<span
                                            style="color:red">*</span></label>
                                    <input type="text" name="name" id="input-name" value="{{ $user->name }}"
                                        class="form-control" placeholder="Jaden">
                                </div>
                                <div class="form-group col-md-6 col-sm-12">
                                    <label class="form-control-label" for="input-last_name">Apellidos<span
                                            style="color:red">*</span></label>
                                    <input type="text" name="last_name" id="input-last_name"
                                        value="{{ $user->last_name }}" class="form-control" placeholder="Smith">
                                </div>
                                <div class=" form-group col-md-6 col-sm-12">
                                    <label class="form-control-label" for="input-type">Tipo de usuario <span
                                            style="color:red">*</span></label>
                                    <select name="role_id" id="role-id" class="form-control">
                                        <option value="" selected disabled> Seleccione </option>
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
                                        class="form-control" placeholder="acronym@example.com">
                                </div>
                                <div class="form-group col-md-3 col-sm-12">
                                    <label class="form-control-label" for="input-phone">Teléfono </label>
                                    <input type="text" name="phone" id="input-phone" value="{{ $user->phone }}"
                                        class="form-control" placeholder="+57 300 6356789">
                                </div>
                                <div class=" form-group col-md-3 col-sm-12">
                                    <label class="form-control-label" for="input-type">Tipo de documento <span
                                            style="color:red">*</span></label>
                                    <select name="user_document_type" id="user_document_type" class="form-control">
                                        <option value="" selected disabled> Seleccione </option>
                                        @foreach ($user_document_types as $item)
                                            <option value="{{ $item->id }}"
                                                {{ $user->user_document_type == $item->id ? 'selected' : '' }}>
                                                {{ $item->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-3 col-sm-12">
                                    <label class="form-control-label" for="input-document_number">Número de documento
                                    </label>
                                    <input type="text" name="document_number" id="input-document_number"
                                        value="{{ $user->document_number }}" class="form-control" placeholder="123132132">
                                </div>
                                <div class="form-group col-md-3 col-sm-12">
                                    <label class="form-control-label" for="input-address">Dirección </label>
                                    <input type="text" name="address" id="input-address" value="{{ $user->address }}"
                                        class="form-control" placeholder="+57 300 6356789">
                                </div>
                                <div class=" form-group col-md-3 col-sm-12">
                                    <label class="form-control-label" for="input-type">Estado <span
                                            style="color:red">*</span></label>
                                    <select name="active" class="form-control">
                                        <option value="1" {{ $user->active == 1 ? 'selected' : '' }}> Activo
                                        </option>
                                        <option value="0" {{ $user->active == 0 ? 'selected' : '' }}> Inactivo
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6 col-sm-12">
                                    <label class="form-control-label" for="input-password">Contraseña <span
                                            style="color:red">*</span></label>
                                    <input type="password" name="password" v-model="password" id="input-password"
                                        class="form-control" placeholder="Contraseña">
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group col-md-6 col-sm-12">
                                    <label class="form-control-label" for="input-password">Repetir Contraseña <span
                                            style="color:red">*</span></label>
                                    <input type="password" name="password_confirmation" v-model="password"
                                        id="input-password" class="form-control" placeholder="Contraseña">
                                    @if ($errors->has('password_confirmation'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <input type="hidden" id="roles" value="{{ $roles }}">
                                <div id="document-container"
                                    class="{{ isset($user->getRole->documents) ? 'd-block' : 'd-none' }}">
                                    <div class="col-md-12 my-2" style="border-bottom: solid 1px #eee;">
                                        <h6 class="mb-0">Documentos</h6>
                                    </div>
                                    @if (isset($user->getRole->documents))
                                        @foreach ($user->getRole->documents as $document)
                                            <div class="form-group">
                                                <label for=""
                                                    class="form-control-label">{{ $document->name }}</label>
                                                <input type="file" name="{{ $document->id }}" class="form-control">
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <button type="submit" class="btn btn-primary btn-block">Actualizar usuario</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
