<div class="aside" id="collapseAside">
    <div class="col-12 py-3">
        <a href="{{ url('/') }}" class="d-flex flex-row flex-wrap align-items-center justify-content-center">
            <img src="{{ asset('img/load.png') }}" style="width: 128px" alt="">
        </a>
    </div>
    <div class="my-5 scroll max-h-500px pb-25">
        <ul class="px-5 list-sidebar">
            @foreach ($SuperModules as $item)
                @if ($item->position > 5 && $item->parent_id == null)
                    {{-- {{dd($item->reference)}} --}}
                    <a href="{{ route($item->reference == 'dashboard' ? 'home.index' : $item->reference . '.index') }}">
                        @php
                        $porciones = explode(".", Route::currentRouteName());
                        @endphp

                        <li
                            class="text-capitalize {{ $item->reference . '.index' === $porciones[0].'.index' ? 'active' : '' }} text-dark p-3">
                            <img src="{{ asset('img/icon/' . $item->icon) }}" style="width: 20px" class="mr-4"
                                alt=""> {{ $item->name }}</li>
                    </a>
                @endif
            @endforeach
        </ul>
    </div>
    <div class="px-4 py-40 mx-8">
        <span class="text-muted font-weight-bold mr-2">{{ date('Y') }} &copy;</span>
            <a href="https://www.developapp.co/" target="_blank" class="text-dark-75 text-hover-primary">Develop App
                S.A.S</a>    
    </div>
</div>
