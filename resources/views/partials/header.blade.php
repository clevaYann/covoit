<style>
    .header {
        background-color: #4CAF50;
        color: white;
        padding: 20px;
        border-radius: 5px;
        margin-bottom: 30px;
        text-align: center;
    }

    .header h1 {
        font-size: 28px;
        font-weight: bold;
        margin-bottom: 5px;
    }

    .header p {
        margin: 0;
    }
</style>

<div class="header">
    <h1>Covoit Application</h1>
    @if(isset($subtitle))
        <p>{{ $subtitle }}</p>
    @endif
</div>
