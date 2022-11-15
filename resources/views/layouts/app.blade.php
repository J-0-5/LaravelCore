<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>UniAtlántico</title>
    {{-- Favicon --}}
    <link rel="shortcut icon" href="{{ asset('/img/icon/Grupo 833.png') }}" />

    <!-- Scripts -->
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD9MFKCZ2zM_6wtlJCiaSdalzbubH_tKFk&libraries=places"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/tooltip.js') }}"></script>
    <script src="{{ asset('js/toggle.js') }}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="{{ asset('js/alert.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="{{ asset('js/apexcharts.js?v=1.0.1') }}"></script>
    <script src="{{ asset('js/selectBranchOffice.js') }}"></script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="{{ asset('css/please-wait.css') }}" rel="stylesheet" />

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=EB+Garamond:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
        integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Styles -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/duotone.css"
        integrity="sha384-R3QzTxyukP03CMqKFe0ssp5wUvBPEyy9ZspCB+Y01fEjhMwcXixTyeot+S40+AjZ" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/fontawesome.css"
        integrity="sha384-eHoocPgXsiuZh+Yy6+7DsKAerLXyJmu2Hadh4QYyt+8v86geixVYwFqUvMU8X90l" crossorigin="anonymous" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.bundle.css?v=1.0.7') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/tooltip.css') }}">




    <!-- cdn stytle table bootstrap -->

</head>

<body
    class="quick-panel-right demo-panel-right offcanvas-right header-fixed header-mobile-fixed subheader-enabled subheader-fixed"
    style="left: 200px">
    {{-- <script src="{{ asset('js/please-wait.min.js') }}"></script>
    <script type="text/javascript">
        window.loading_screen = window.pleaseWait({
            logo: "{{ asset('img/load.png') }}",
            backgroundColor: '#fff',
            display: "fixed"
        });
    </script> --}}
    <div id="app">

        <main class="d-flex flex-column flex-root " style="height: 100vh;">

            <div class="d-flex flex-row flex-column-fluid page">
                <div class="d-flex @guest flex-column flex-row-fluid login-signup-on @else flex-row @endguest"
                    id="kt_wrapper">
                    @guest
                        <div class="d-flex flex-column flex-column-fluid" id="kt_content">
                            <div>
                                @yield('content')
                            </div>
                        </div>
                    @else
                    @include('layouts.collapseAside')
                    <div class="content-page">
                        @include('layouts.header')
                        <div class="content d-flex flex-row justify-content-center flex-row-fluid backdots" id="kt_content">
                            {{-- @if (Route::currentRouteName() != 'users.index')
                                @includeWhen(Route::currentRouteName() != 'home.index', 'layouts.subSidebar')
                            @endif --}}
                            {{-- @includeWhen(Route::currentRouteName() != 'home.index', ) --}}
                            <div class="px-0 w-100">
                                @includeWhen(Route::currentRouteName() != 'home.index', 'layouts.breadCrumbs')
                                {{-- @include('layouts.breadCrumbs') --}}
                                @yield('content')
                                @include('layouts.footer')
                            </div>
                        </div>
                    </div>
                    @endguest
                </div>
            </div>
        </main>
    </div>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
    {{-- <script type="text/javascript">
        setTimeout(() => {
            window.loading_screen.finish({
                 display: "none"
            });
        }, 300);
    </script> --}}
    @stack('scripts')
    @yield('js')
</body>

</html>
