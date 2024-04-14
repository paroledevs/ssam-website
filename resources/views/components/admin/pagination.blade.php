@if ($paginator->hasPages())

    <div id="paginado">

    {{-- Previous Page Link --}}
    @if (!$paginator->onFirstPage())

        <a href="{{ $paginator->previousPageUrl() }}"><button>Anterior</button></a>

    @endif
    {{-- Previous Page Link --}}

    {{-- Next Page Link --}}
    @if ($paginator->hasMorePages())

        <a href="{{ $paginator->nextPageUrl() }}"><button>Siguiente</button></a>

    @endif
    {{-- Next Page Link --}}

    </div>

@endif