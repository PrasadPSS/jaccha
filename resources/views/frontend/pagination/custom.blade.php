@if ($paginator->hasPages())
<ul class="pager">
    @if ($paginator->onFirstPage())
    <li class="pg-btn"><a href="javascript:void(0)"><i class="fa fa-angle-left" aria-hidden="true"></i> <span class="dn"> PREVIOUS</span></a></li>
    @else
    <li class="pg-btn"><a href="{{ $paginator->previousPageUrl() }}"><i class="fa fa-angle-left" aria-hidden="true"></i> <span class="dn"> PREVIOUS</span></a></li>
    @endif

    @foreach ($elements as $element)

    @if (is_string($element))
    <li class="disabled"><span>{{ $element }}</span></li>
    @endif

    @if (is_array($element))
    @foreach ($element as $page => $url)
    @if ($page == $paginator->currentPage())
    <li><a href="" style="border: 2px solid #2f2c2a; background-color: #fabf8f;"><span>{{ $page }}</span></a></li>
    @else
    <li><a href="{{ $url }}">{{ $page }}</a></li>
    @endif
    @endforeach
    @endif
    @endforeach

    @if ($paginator->hasMorePages())
    <li class="pg-btn"><a href="{{ $paginator->nextPageUrl() }}"><span class="dn">NEXT </span><i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
    @else
    <li class="pg-btn"><a href="javascript:void(0)"><span class="dn">NEXT </span><i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
    @endif
</ul>
@endif