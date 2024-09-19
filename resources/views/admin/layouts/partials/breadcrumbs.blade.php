@if (isset($breadcrumbs) && !empty($breadcrumbs->getBreadcrumbs()))
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            @foreach ($breadcrumbs = $breadcrumbs->getBreadcrumbs() as $item)
                                @if (!$loop->last)
                                    <li class="breadcrumb-item">
                                        @if ($item['url'])
                                            <a href="{{ $item['url'] }}" class="text-muted">{{ $item['label'] }}</a>
                                        @else
                                            <span class="text-muted">{{ $item['label'] }}</span>
                                        @endif
                                    </li>
                                @else
                                    <li class="breadcrumb-item active" aria-current="page">{{ $item['label'] }}</li>
                                @endif
                            @endforeach
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endif
