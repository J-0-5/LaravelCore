@isset($children)
    @if ($parent_module->parent_id == null && $parent_module->position > 5)
        <div class="aside aside-left d-flex flex-column flex-row-auto px-0" id="kt_aside">
            {{-- Brand --}}
            <div class="brand flex-row-auto border-bottom mx-4" id="kt_brand">
                <div class="brand-logo align-items-center">
                    <a href="#">
                        <img src="{{ asset('img/icon/' . $parent_module->icon) }}" class="img-subsidebar" />
                    </a>
                    <p class="font-weight-bold text-white mt-3 ml-3">{{ $parent_module->name }}</p>
                </div>

            </div>
            {{-- Aside menu --}}
            <div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
                <div id="kt_aside_menu" class="aside-menu my-4" data-menu-vertical="1">
                    <ul class="menu-nav ml-3">
                        <a
                            href="{{ route($parent_module->reference == 'ghost' ? 'ghost' : $parent_module->reference . '.index') }}">
                            <li class="text-white mb-2 py-1 px-3 itemSub">Dashboard</li>
                        </a>

                        @foreach ($children as $item)
                            <a href="{{ route($item->reference . '.index') }}">
                                <li
                                    class="text-white mb-2 py-1 px-3 itemSub {{ $item->reference . '.index' === Route::currentRouteName() ? 'active' : '' }}">
                                    {{ $item->name }}</li>
                            </a>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="px-4 py-2 mx-3 border-top btn-margin"><a href="javascript:history.back()"
                    class="btn btn-outline-neutral btn-block font-italic font-weight-bold text-uppercase">Volver</a></div>
        </div>
    @endif
@endisset
