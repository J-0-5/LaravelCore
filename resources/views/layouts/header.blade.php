{{-- Header --}}
<div id="kt_header" class="header header-fixed ">

    {{-- Container --}}
    <div class="container-fluid d-flex align-items-center justify-content-between pr-0">

        {{-- Header Menu --}}
        <div class="header-menu-wrapper header-menu-wrapper-left align-items-center" id="kt_header_menu_wrapper">
            <span class="mr-3" style="cursor: pointer;" id="collapseButton"><img src="{{asset('/img/desplegable.png')}}" style="width: 40px;" alt="toggle" srcset=""></span>
            <div class="header-logo">
            </div>
        </div>
        {{--notification--}}
        {{-- <div class="dropdown ml-auto ">
            <a class="btn dropdown-toggle px-0 mr-3" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                aria-expanded="false">
                <i class="fas fa-bell text-white"></i>
                <span class="badge rounded-pill text-white bg-danger position-absolute top-0">1</span>
            </a>

            <div class="dropdown-menu dropdown-menu-width mr-37" aria-labelledby="dropdownMenuLink">
                <div class="col-sm-12 scroll scroll-pull max-h-450px">
                    <div class="card" id="notificationList">

                    </div>
                </div>
            </div>
        </div> --}}
        {{--@if (Route::currentRouteName() != 'home.index')
            <div class="col-md-4">
                <input type="text" name="" id="" class="form-control" placeholder="">
            </div>
        @endif--}}
        {{--notification--}}

        <div class="d-flex flex-row flex-wrap align-items-center h-100">
            <div class="dropdown mx-4">
                <a class="dropdown-toggle droptop" href="#" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="{{asset('img/icon/feather-bell.png')}}" alt="notificaciones" style="width: 19px;">
                </a>
                <div class="dropdown-menu dropcolor p-4" aria-labelledby="dropdownMenuButton">
                    <p class="dropcolor-item-text">Hoy</p>
                    <a class="dropdown-item dropcolor-item flex-column" href="#">
                        <div class="d-flex flex-row flex-wrap align-items-center justify-content-between">
                            <p class="dropcolor-item-text mb-0">Registro</p>
                            <svg xmlns="http://www.w3.org/2000/svg" width="8.118" height="8.118" viewBox="0 0 8.118 8.118">
                                <g id="Grupo_56" data-name="Grupo 56" transform="translate(-245.85 -127.444)">
                                  <path id="Trazado_65" data-name="Trazado 65" d="M246.557,128.151l6.7,6.7" fill="none" stroke="#fff" stroke-linecap="round" stroke-width="1"></path>
                                  <path id="Trazado_66" data-name="Trazado 66" d="M253.261,128.151l-6.7,6.7" fill="none" stroke="#fff" stroke-linecap="round" stroke-width="1"></path>
                                </g>
                              </svg>
                        </div>
                        <div class="d-flex flex-row flex-wrap dropcolor-item-text">
                            <small>Se actualizó un registro</small>
                        </div>
                    </a>
                </div>
            </div>


            <div class="dropdown mx-0 h-100 d-flex flex-row flex-wrap align-items-center justify-content-center" style="background: #8F9EC0;
            width: 150px;">
                <a class="dropdown-toggle droptop" href="#" id="profile_drop" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="d-flex flex-row flex-wrap align-items-center">
                        <div>
                            <img src="https://cietalca.cl/intranet/wp-content/themes/cera/assets/images/avatars/user-avatar.png" alt="image-profile" style="width: 40px; border-radius:50%;">
                        </div>
                        <div class="d-flex flex-column flex-wrap">
                            <p class="mb-0 mr-3 text-right text-white font-weight-bolder">{{ Auth::user()->first_name }}</p>
                            <p class="mb-0 mr-3 text-right font-weight-bolder" style="color: #CCD3E3;">Opciones</p>
                        </div>
                    </div>
                </a>
                <div class="dropdown-menu dropcolor p-4" aria-labelledby="profile_drop" style="left: -2vw !important; top: -8px !important;">
                    <a class="dropdown-item dropcolor-item-text d-flex flex-row flex-wrap align-items-center justify-content-start" href="{{route('profile.index')}}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="15.315" height="17.042" viewBox="0 0 15.315 17.042">
                            <g id="Icon_feather-user" data-name="Icon feather-user" transform="translate(0.75 0.75)">
                              <path id="Trazado_59" data-name="Trazado 59" d="M19.815,27.681V25.954A3.454,3.454,0,0,0,16.361,22.5H9.454A3.454,3.454,0,0,0,6,25.954v1.727" transform="translate(-6 -12.139)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></path>
                              <path id="Trazado_60" data-name="Trazado 60" d="M18.907,7.954A3.454,3.454,0,1,1,15.454,4.5,3.454,3.454,0,0,1,18.907,7.954Z" transform="translate(-8.546 -4.5)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></path>
                            </g>
                          </svg>
                          <p class=" ml-4 dropcolor-item-text mb-0">Perfil</p>
                    </a>
                    <a class="dropdown-item dropcolor-item-text d-flex flex-row flex-wrap align-items-center justify-content-start" href="{{route('users.index')}}">
                          <p class=" ml-4 dropcolor-item-text mb-0">Usuarios</p>
                    </a>
                    <a class="dropdown-item dropcolor-item-text d-flex flex-row flex-wrap align-items-center justify-content-start" href="{{route('permits.index')}}">
                        <p class=" ml-4 dropcolor-item-text mb-0">Permisos</p>
                    </a>
                    <a class="dropdown-item dropcolor-item-text d-flex flex-row flex-wrap align-items-center justify-content-start" href="{{route('log.index')}}">
                        <p class=" ml-4 dropcolor-item-text mb-0">Logs</p>
                    </a>
                    <a class="dropdown-item dropcolor-item-text d-flex flex-row flex-wrap align-items-center justify-content-start" href="{{route('parameters.index')}}">
                        <p class=" ml-4 dropcolor-item-text mb-0">Parámetros</p>
                    </a>
                    <a class="dropdown-item dropcolor-item-text d-flex flex-row flex-wrap align-items-center justify-content-start" href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <svg xmlns="http://www.w3.org/2000/svg" width="15.315" height="15.315" viewBox="0 0 15.315 15.315">
                            <g id="Icon_feather-log-out" data-name="Icon feather-log-out" transform="translate(0.75 0.75)">
                              <path id="Trazado_62" data-name="Trazado 62" d="M9.1,18.315H6.035A1.535,1.535,0,0,1,4.5,16.78V6.035A1.535,1.535,0,0,1,6.035,4.5H9.1" transform="translate(-4.5 -4.5)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></path>
                              <path id="Trazado_63" data-name="Trazado 63" d="M24,18.175l3.837-3.837L24,10.5" transform="translate(-14.023 -7.43)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></path>
                              <path id="Trazado_64" data-name="Trazado 64" d="M22.71,18H13.5" transform="translate(-8.895 -11.093)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></path>
                            </g>
                          </svg>
                          <p class=" ml-4 dropcolor-item-text mb-0">Cerrar Sesión</p>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
