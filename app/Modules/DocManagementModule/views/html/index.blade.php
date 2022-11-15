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
                            <h6 class="title-view mb-0">Gestión Documental</h6>
                            <div class="col-md-4 d-flex flex-row justify-content-end">
                                <a href="#" role="button" class="btn btn-success btnbys mr-3" data-toggle="modal"
                                    data-target="#modalCreate">
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
                                                    <label for="">Numero de convocatoria</label>
                                                    <input type="number" name="name_lab" id=""
                                                        class="form-control" aria-describedby="helpId" value="">
                                                </div>
                                                <div class="col-12 col-md-6 form-group">
                                                    <label for="">Nombre de convocatoria</label>
                                                    <input type="text" name="name_lab" id=""
                                                        class="form-control" placeholder="Nombre convocatoria"
                                                        aria-describedby="helpId" value="">
                                                </div>
                                                <div class="col-12 col-md-6 form-group">
                                                    <label for="">Fecha de solicitud</label>
                                                    <input type="date" name="name_lab" id=""
                                                        class="form-control" aria-describedby="helpId">
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
                                                <div class="col-12 col-md-6 form-group">
                                                    <label for="">Abogado</label>
                                                    <input type="text" name="name_lab" id=""
                                                        class="form-control" aria-describedby="helpId">
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
                                                    <a href="#" class="btn btn-secondary mr-2">Limpiar</a>
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
                                <th scope="col">TIPO</th>
                                <th scope="col">ESTADO</th>
                                <th scope="col">Opciones</th>
                            </tr>
                        </thead>
                    </x-slot>
                    <x-slot name="tbody">
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>
                                    <div class="d-flex flex-row flex-wrap align-items-center justify-content-center">
                                        Documento
                                        <div
                                            class="ml-2 icon-dom d-flex flex-row flex-wrap align-items-center justify-content-center">
                                            <img src="{{ asset('img/icon/word.svg') }}" alt="">
                                        </div>
                                    </div>
                                </td>
                                <td><span
                                        class="label label-success label-pill label-inline font-weight-bold mr-2">Activo</span>
                                </td>
                                <td class="d-flex justify-content-center">
                                    <a href="#" data-tooltip title="Detalle"
                                        class="btn btn-icon btn-primary btn-sm mr-2">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="#" data-tooltip title="Editar"
                                        class="btn btn-icon btn-warning btn-sm mr-2">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <a href="#" data-tooltip title="Eliminar"
                                        class="btn btn-icon btn-danger btn-sm mr-2">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </x-slot>
                </x-tableStyled>
            </div>
        </div>
        <x-modal-table idComponent="modalCreate" classModal="modal-lg" titleModal="Generar certificado">
            <x-slot name="modalBody">
                <div class="d-flex flex-row flex-wrap px-10 py-3">
                    <div class="col-6 form-group">
                        <label>Nombre del certificado <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" />
                    </div>
                    <div class="col-6 form-group">
                        <label>Tipo de certificado <span class="text-danger">*</span></label>
                        <select class="form-control" id="exampleSelect1">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                        </select>
                    </div>
                    <div class="col-12 content-template px-10">
                        <div class="d-flex flex-row flex-wrap align-items-center justify-content-between my-10">
                            <p>Barranquilla, 13 de Julio de 2022</p>
                            <img class="w-25" src="{{ asset('img/load.png') }}" alt="">
                        </div>
                        <div class="d-flex flex-column flex-wrap">
                            <p class="font-weight-bold text-center">
                                CERTIFICADO
                            </p>
                            <div class="content-text-editable">
                                <p contenteditable="true">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                    Molestiae, consectetur. <strong>{Accusamus deleniti ipsam aperiam iste}</strong>, nostrum
                                    dicta neque ratione odio quibusdam culpa quam. Ea libero dolores beatae commodi alias
                                    quis?</p>
                            </div>
                            <div class="d-flex flex-column my-10 flex-wrap align-items-center justify-content-center">
                                <img src="{{asset('img/Firma_Harriet.svg')}}" alt="">
                                <div class="w-50 text-center" style="border-top: solid 2px #dfdfdf;">
                                    <p>FIRMA</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 d-flex flex-row flex-wrap align-items-center justify-content-between px-10">
                    <button class="btn btn-success p-2 btn-lg ">Descargar</button>
                    <button class="btn btn-primary p-2 btn-lg ">Subir orfeo</button>
                </div>
            </x-slot>
        </x-modal-table>
    </div>
@endsection
