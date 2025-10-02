<div x-data="{ cargando: false }" class="row mt-5">

    <!-- Spinner overlay -->
    <div x-show="cargando" class="spinner-overlay align-content-center text-center">
        <div class="spinner-border color-active" role="status"></div>
    </div>

@if ($paginator->hasPages())

        <div class="col text-center">
            <div class="block-27">
                <ul>
                    <li>
                        @if ($paginator->onFirstPage())
                            <span class="text-muted">&lt;</span>
                        @else
                            <a href="#" wire:click.prevent="previousPage" wire:loading.attr="disabled" @click="cargando = true; setTimeout(() => cargando = false, 2000)">&lt;</a>
                        @endif
                    </li>

                    {{-- Páginas --}}
                    @foreach ($elements as $element)
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <li class="active"><span>{{ $page }}</span></li>
                                @else
                                    <li><a href="#" wire:click.prevent="gotoPage({{ $page }})" @click="cargando = true; setTimeout(() => cargando = false, 2000)">{{ $page }}</a></li>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    <li>
                        @if ($paginator->onLastPage())
                            <span class="text-muted">&gt;</span>
                        @else
                            <a href="#" wire:click.prevent="nextPage" wire:loading.attr="disabled" @click="cargando = true; setTimeout(() => cargando = false, 2000)">&gt;</a>
                        @endif
                    </li>
                </ul>
            </div>
        </div>

    @endif
</div>
