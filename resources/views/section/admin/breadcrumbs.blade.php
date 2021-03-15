@if (count($breadcrumbs))

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                @foreach ($breadcrumbs as $breadcrumb)
                @if ($breadcrumb->url && !$loop->last)
                @else
                <h1 class="m-0">{{ $breadcrumb->title }}</h1>
                @endif
                @endforeach
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    @foreach ($breadcrumbs as $breadcrumb)
                    @if ($breadcrumb->url && !$loop->last)
                    <li class="breadcrumb-item"><a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a></li>
                    @else
                    <li class="breadcrumb-item active">{{ $breadcrumb->title }}</li>
                    @endif
                    @endforeach
                </ol>
            </div>
        </div>
    </div>
</div>

@endif