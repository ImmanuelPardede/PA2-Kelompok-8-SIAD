@if ($paginator->hasPages())
    <nav>
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span class="page-link" aria-hidden="true">&lsaquo;</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
                </li>
            @endif

            {{-- Logic to display pagination links --}}
            @php
                $maxLinks = 5;
                $currentPage = $paginator->currentPage();
                $totalPages = $paginator->lastPage();
                $start = 1; // Always show first page
                $end = $totalPages; // Always show last page

                // Prepare an array to hold page numbers
                $pageLinks = [];

                // Add the first page
                $pageLinks[] = $start;

                // Add previous page if within range
                if ($currentPage > 2) {
                    $pageLinks[] = $currentPage - 1;
                }

                // Add the current page
                $pageLinks[] = $currentPage;

                // Add next page if within range
                if ($currentPage < $totalPages - 1) {
                    $pageLinks[] = $currentPage + 1;
                }

                // Always add the last page
                if ($totalPages > 1) {
                    $pageLinks[] = $end;
                }

                // Remove duplicates and sort the links
                $pageLinks = array_unique($pageLinks);
                sort($pageLinks);
            @endphp

            {{-- Pagination Elements --}}
            @foreach ($pageLinks as $page)
                @if ($page == $currentPage)
                    <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                @else
                    <li class="page-item"><a class="page-link" href="{{ $paginator->url($page) }}">{{ $page }}</a></li>
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span class="page-link" aria-hidden="true">&rsaquo;</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
