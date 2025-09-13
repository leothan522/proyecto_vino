<div class="container">
    {{-- Nothing in the world is as soft and yielding as water. --}}
    @if($imagenes->isNotEmpty())

        @include('web.section.list-imagenes')

        {{ $imagenes->links('web.section.pagination-links') }}

    @endif
</div>
