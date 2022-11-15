@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex flex-row flex-wrap align-items-center">
        @foreach ($modules as $item)
        @if ($item->position > 4)
        {{-- {{dd($item)}} --}}
            <a href="{{route('oppManagement.index')}}" class="col-md-3 my-3">
                <div class="card card-panel">
                    <div class="card-body d-flex flex-column align-items-center justify-content-center">
                        <img src="{{asset('/img/icon/'.$item->icon)}}" alt="{{$item->name}}" class="icon-panel mb-2" srcset="">
                        <h6 class="h6 text-decoration-none text-center text-dark">{{$item->name}}</h6>
                    </div>
                </div>
            </a>
            @endif
        @endforeach
    </div>
</div>
@endsection
