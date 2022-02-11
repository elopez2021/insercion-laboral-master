<div class="clearfix">
            
            <div class="hint-text">Mostrando <b>{{ $paginator->count() }}</b> de <b>{{ $paginator->total() }}</b> resultados</div>


            <ul class="pagination justify-content-end">
                @if ($paginator->onFirstPage())
                    <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Anterior</a>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->previousPageUrl() }}" tabindex="-1" aria-disabled="true">Anterior</a>
                    </li>
                @endif

              @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}">Después</a>
                </li>
              @else
                <li class="page-item disabled">
                    <a class="page-link" href="#">Después</a>
                </li>
              @endif
            </ul>

        </div>

