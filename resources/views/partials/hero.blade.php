<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
            <div class="flex-grow-1">
                <h1 class="h3 fw-bold mb-2">
                    {{ isset($title) ? $title : '' }}
                </h1>
            </div>
            <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    @if(isset($breadcrumb) && is_array($breadcrumb) && count($breadcrumb) > 0)
                        @foreach($breadcrumb as $key => $itemBreadcrumb)
                            <li class="breadcrumb-item">
                                <a class="link-fx" href="{{ route($key) }}">{{ $itemBreadcrumb }}</a>
                            </li>
                        @endforeach
                    @endif
                    <li class="breadcrumb-item" aria-current="page">
                        {{ isset($title) ? $title : '' }}
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>
