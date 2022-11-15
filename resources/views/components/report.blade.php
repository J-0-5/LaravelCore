<div class="col-md-6">
    <div class="card col-md-12">
        <div class="card-header ">
            <p class="title title-view mb-0">{{ $tituloCardTi }}</p>
        </div>
        <div class="card-body">
            <form action="">
                <div class="form-check">
                    {{ $inputTi }}
                </div>
            </form>
        </div>
    </div>
</div>

<div class="col-md-6">
    <div class="card col-md-12">
        <div class="card-header">
            <p class="title title-view mb-0">{{ $tituloCardCd }}</p>
        </div>
        <div class="card-body">
            <form action="">
                <div class="form-check">
                    {{ $inputCd }}
                </div>
            </form>
        </div>
    </div>
</div>

<div class="col-md-6 mt-5">
    <div class="card">
        <div class="card-header">
            <p class="title title-view mb-0">{{$tituloCardFiltros}}</p>
        </div>
        <div class="card-body">
            <form action="{{route('generateReport')}}" method="POST">
            @csrf
                {{ $inputFiltros }}
                <div class="col-md-6"><button type="submit" class="btn btn-warning btn-round" style="width: 100%; background-color: #db7500">
                    Generar reporte</button></div>
            </form>
        </div>
    </div>
</div>

<div class="col-md-6 mt-5">
    <div class="card col-md-12 mb-5">
        <div class="card-header">
            <p class="title title-view mb-0">{{$tituloCardFa}}</p>
        </div>
        <div class="card-body">
            <form action="">
                <div class="form-check">
                    {{ $inputFa }}
                </div>
            </form>
        </div>
    </div>

    <form action="">
        <div class="row">
            <div class="col-md-6"><button type="submit" class="btn btn-warning btn-round" style="width: 100%; background-color: #db7500">
                    Generar reporte</button></div>
            <div class="col-md-6"><button type="submit" class="btn btn-outline-warning btn-round"
                    style="width: 100%">Cancelar
                    informe</button>
            </div>
        </div>
    </form>
</div>
