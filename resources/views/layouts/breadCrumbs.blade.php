<nav class="navbar navbar-expand-lg bg-white">
    <div class="container-fluid">
      <div class="navbar-wrapper">
        <a class="navbar-brand" href="javascript:;"></a>
        <nav aria-label="breadcrumb bg-white">
            <ol class="breadcrumb mb-0 bg-white" style="background-color: transparent;">
                <li class="breadcrumb-item Active"><a href="/" style="color: #6f6f6f !important;">Inicio</a></li>
                @foreach (explode(".",request()->route()->getName()) as $item)
                    @if ($item!="index")
                        @if(request()->route()->parameters && count(request()->route()->parameters) > 1)
                            @foreach(request()->route()->parameters as $key)
                                <li class="breadcrumb-item active" aria-current="page" > <a href="{{ucfirst(request()->segment(1))==__("$item")?'/'.request()->segment(1).'/'.$key:'#'}}" style="color: #6f6f6f !important;">{{__("$item")}}</a> </li>
                                @break
                            @endforeach
                        @else
                            <li class="breadcrumb-item active" aria-current="page"> <a href="{{ucfirst(request()->segment(1))==__("$item")?'/'.request()->segment(1):'#'}}" style="color: #6f6f6f !important;">{{__("$item")}}</a> </li>
                        @endif
                    @endif
                @endforeach
            </ol>
        </nav>
      </div>
      <a class="navbar-brand d-sm-block d-block d-md-none d-lg-none" data-toggle="modal" data-target="#modal-right" data-toggle-class="modal-open-aside"> <i class="fa fa-bars text-danger"></i> </a>
      <div class="collapse navbar-collapse justify-content-end">
          @yield('nav')
      </div>
    </div>
  </nav>