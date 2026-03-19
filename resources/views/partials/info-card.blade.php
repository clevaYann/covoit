<style>
    .card {
        background-color: white;
        padding: 25px;
        border-radius: 5px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .card-title {
        font-weight: bold;
        color: #333;
        margin-bottom: 15px;
        font-size: 18px;
    }

    .card-content {
        background-color: #e3f2fd;
        padding: 15px;
        border-radius: 4px;
        border-left: 4px solid #4CAF50;
    }

    .info-row {
        margin-bottom: 12px;
        padding: 8px 0;
        border-bottom: 1px solid #ddd;
    }

    .info-row:last-child {
        border-bottom: none;
    }

    .info-label {
        font-weight: bold;
        color: #555;
        display: block;
        margin-bottom: 3px;
    }

    .info-value {
        color: #333;
        margin-left: 5px;
    }
</style>

<div class="card">
    @if(isset($title))
        <div class="card-title">{{ $title }}</div>
    @endif
    <div class="card-content">
        {{ $slot }}
    </div>
</div>
