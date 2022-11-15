<div class="card {{$classCard}}" style="border-radius: 10px; box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;">
    <div class="card-body text-center px-0">
        <small class="text-dark mb-0 font-weight-bold">{{ $tituloCard }}</small>
        <div class="d-flex flex-row flex-wrap">
            @if ($themeIcon == 'success')
                <div class="bg-success-o-50 p-4 rounded">
                    <img src="{{asset('img/icon/dash1.svg')}}" alt="">
                </div>
            @elseif ($themeIcon == 'warning')
                <div class="bg-warning-o-50 p-4 rounded">
                    <img src="{{asset('img/icon/dash2.svg')}}" alt="">
                </div>
            @else
                <div class="bg-primary-o-50 p-4 rounded">
                    <img src="{{asset('img/icon/dash3.svg')}}" alt="">
                </div>
            @endif
            <p class="h1 ml-3 mb-2 text-left font-weight-bold">{{ $cantidad }}</p>
        </div>
    </div>
</div>
