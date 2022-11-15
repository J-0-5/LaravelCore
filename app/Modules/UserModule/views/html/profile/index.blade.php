{{-- Extends layout --}}
@extends('layouts.app')

{{-- Content --}}
@section('content')
    {{-- @include('layouts.breadCrumbs') --}}
    <div class="d-flex flex-row flex-wrap p-4">
        <div class="col-md-4 card-container-perfil">
            <div class="card card-round ">
                <div class="image"><img
                        src="https://png.pngtree.com/thumb_back/fw800/back_our/20190625/ourmid/pngtree-overshoot-computer-desktop-background-image_259786.jpg"
                        alt="...">
                </div>
                <div class="card-body text-center card-body-user">
                    <div class="avatar">
                        @if (auth()->user()->photo != null)
                            @if (preg_match('/(https?:\/\/.*\.)/i', $user->photo))
                                <img class="avatar border-gray" src="{{ $user->photo }}" alt="profile-image">
                            @else
                                <img class="avatar border-gray" src="{{ asset('storage/') }}/{{ $user->photo }}"
                                    alt="profile-image">
                            @endif
                        @else
                            <img src="https://cietalca.cl/intranet/wp-content/themes/cera/assets/images/avatars/user-avatar.png"
                                class="mb-7" alt="profile-image">
                        @endif
                        <h5 class="title mb-7">{{ Auth::user()->first_name }}</h5>
                        <p class="description mb-2">
                            {{ '@' . Auth::user()->first_name }}
                        </p>
                    </div>
                    <p class="description mb-1">
                        Datos del {{ Auth::user()->first_name }}
                    </p>
                    {{-- {{dd(Auth::user()->type ? Auth::user()->type : 'Administrador')}} --}}
                    <p class="description mb-1">
                        Tipo de usuario {{ Auth::user()->type ? Auth::user()->type : 'Administrador' }}
                    </p>
                    <form action="{{ route('profile.update-photo', $user->id) }}" method="POST"
                        enctype="multipart/form-data" class="col-md-12">
                        @method('PUT')
                        @csrf
                        <input type="file" name="photo" class="form-control mb-4">
                        <div class="row">
                            <div class="col-md-12"><button type="submit" class="btn  btn-primary">Actualizar Foto</button></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8 text-center">
            <form action="{{ route('profile.update', $user->id) }}" class="col-md-12" method="POST">
                @method('PUT')
                @csrf
                <div class="card mb-7 card-round">
                    <div class="card-header">
                        <h2 class="title">Editar Perfil</h2>
                    </div>
                    @include('layouts.alerts')
                    <div class="card-body card-round">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="col-form-label">Primer Nombre</label>
                                <input type="text" class="form-control" name="first_name" placeholder="Primer Nombre"
                                    required="required" value="{{ $user->first_name }}">
                            </div>
                            <div class="col-md-6">
                                <label class="col-form-label">Segundo Nombre</label>
                                <input type="text" class="form-control" name="second_name" placeholder="Segundo Nombre"
                                    required="required" value="{{ $user->second_name }}">
                            </div>
                            <div class="col-md-6">
                                <label class="col-form-label">Primer Apellido</label>
                                <input type="text" class="form-control" name="last_name" placeholder="Primer Apellido"
                                    required="required" value="{{ $user->last_name }}">
                            </div>
                            <div class="col-md-6">
                                <label class="col-form-label">Segundo Apellido</label>
                                <input type="text" class="form-control" name="second_last_name"
                                    placeholder="Segundo Apellido" required="required"
                                    value="{{ $user->second_last_name }}">
                            </div>
                            <div class="col-md-6">
                                <label class="col-form-label">Correo</label>
                                <input type="text" class="form-control" name="email" placeholder="member@ua.com"
                                    required="required" value="{{ $user->email }}">
                            </div>
                            <div class="col-md-6">
                                <label class="col-form-label">Teléfono</label>
                                <input type="text" class="form-control" name="phone" placeholder="+57 (871) 636-6686"
                                    required="required" value="{{ $user->phone }}">
                            </div>
                            <div class="col-md-6">
                                <label class="col-form-label">Facultad</label>
                                <input type="text" class="form-control" name="faculty" placeholder="Facultad"
                                    required="required" value="Ingeniería">
                            </div>
                            <div class="col-md-6">
                                <label class="col-form-label">Programa Académico</label>
                                <input type="text" class="form-control" name="phone" placeholder="Programa Acádemico"
                                    required="required" value="Ciencias Básicas">
                            </div>
                            <div class="col-md-6">
                                <label class="col-form-label">Rol</label>
                                <input type="text" class="form-control" name="phone" placeholder="Rol"
                                    required="required" value="Administrador">
                            </div>
                            {{-- <div class="col-md-6">
                                <label class="col-form-label">Tipo documento</label>
                                <select name="document_type" class="form-control">
                                    <option value="" selected disabled> Seleccione </option>
                                    @foreach ($documents as $item)
                                        <option value="{{ $item->id }}"
                                            {{ $item->id == $user->document_type ? 'selected' : '' }}>
                                            {{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="col-form-label">Numero documento</label>
                                <input type="text" class="form-control" name="document_number" placeholder="1001330920"
                                    required="required" value="{{ $user->document_number }}">
                            </div> --}}
                        </div>
                        <div class="row mt-5">
                            <div class="col-md-12 text-center"><button type="submit"
                                    class="btn  btn-primary">Actualizar Cambios</button>
                            </div>
                        </div>
                    </div>
                </div>

            </form>


            <form action="{{ route('profile.update-password', $user->id) }}" method="POST" class="col-md-12 ">
                @method('PUT')
                @csrf
                <div class="card card-round">
                    <div class="card-header">
                        <h2 class="title">Cambiar Contraseña</h2>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <label class="col-md-3 col-form-label">Nueva contraseña</label>
                            <div class="form-group col-md-9">
                                <input type="password" class="form-control" name="password" placeholder="Contraseña"
                                    required="required">
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-md-3 col-form-label">Confirmar Contraseña</label>

                            <div class="form-group col-md-9">
                                <input type="password" name="password_confirmation" placeholder="Confirme contraseña"
                                    required="required" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-center"><button type="submit"
                                    class="btn  btn-primary">Actualizar Cambios</button></div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

{{-- Styles Section --}}
@section('styles')
@endsection
