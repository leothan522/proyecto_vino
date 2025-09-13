<div class="row mt-5">
    @if ($paginator->hasPages())

        <div class="col text-center">
            <div class="block-27">
                <ul>
                    <li>
                        @if ($paginator->onFirstPage())
                            <span class="text-muted">&lt;</span>
                        @else
                            <a href="#" wire:click.prevent="previousPage" wire:loading.attr="disabled">&lt;</a>
                        @endif
                    </li>

                    {{-- Páginas --}}
                    @foreach ($elements as $element)
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <li class="active"><span>{{ $page }}</span></li>
                                @else
                                    <li><a href="#" wire:click.prevent="gotoPage({{ $page }})">{{ $page }}</a></li>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    <li>
                        @if ($paginator->onLastPage())
                            <span class="text-muted">&gt;</span>
                        @else
                            <a href="#" wire:click.prevent="nextPage" wire:loading.attr="disabled">&gt;</a>
                        @endif
                    </li>
                </ul>
            </div>
        </div>

    @endif
</div>
