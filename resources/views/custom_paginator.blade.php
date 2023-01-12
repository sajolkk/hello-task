<div>
    @if ($paginator->hasPages())
        <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-between">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <button class="btn btn-secondary btn-sm shadow">
                    {!! __('pagination.previous') !!}
                </button>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="btn btn-sm btn-primary shadow">
                    {!! __('pagination.previous') !!}
                </a>
            @endif         

            <!-- Pagination Elements -->
            @foreach ($elements as $element)
                <!-- Array Of Links -->
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        <!--  Use three dots when current page is greater than 3.  -->
                        @if ($paginator->currentPage() > 3 && $page === 2)
                            ...
                        @endif

                        <!--  Show active page two pages before and after it.  -->
                        @if ($page == $paginator->currentPage())
                            <span class="btn btn-sm btn-secondary me-1">{{ $page }}</span>
                        @elseif ($page === $paginator->currentPage() + 1 || $page === $paginator->currentPage() + 2 || $page === $paginator->currentPage() - 1 || $page === $paginator->currentPage() - 2)
                            <a href="{{ $url }}" class="btn btn-primary shadow btn-sm me-1" >{{ $page }}</a>
                        @endif

                        <!--  Use three dots when current page is away from end.  -->
                        @if ($paginator->currentPage() < $paginator->lastPage() - 2  && $page === $paginator->lastPage() - 1)
                            ...
                        @endif
                    @endforeach
                @endif
            @endforeach
            
            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="btn btn-sm btn-primary shadow">
                    {!! __('pagination.next') !!}
                </a>
            @else
                <button class="btn btn-secondary btn-sm shadow">
                    {!! __('pagination.next') !!}
                </button>
            @endif
            <span class="float-end mt-1" >
                @if($paginator->currentPage() == 1)
                    Showing 1 to {{ ($paginator->currentPage() * $paginator->perPage()) }} of {{ $paginator->total() }} entries
                @elseif($paginator->currentPage() == $paginator->lastPage())
                    Showing {{ (($paginator->currentPage() * $paginator->perPage()) - $paginator->perPage())+1 }} to {{ $paginator->total() }} of {{ $paginator->total() }} entries
                @else 
                    Showing {{ (($paginator->currentPage() * $paginator->perPage()) - $paginator->perPage())+1 }} to {{ ($paginator->currentPage() * $paginator->perPage()) }} of {{ $paginator->total() }} entries
                @endif
            </span>
        </nav>
        
    @endif
</div>
