<div class="card">
    @if(isset($title))
        <div class="card-title">{{ $title }}</div>
    @endif
    <div class="card-content">
        {{ $slot }}
    </div>
</div>
