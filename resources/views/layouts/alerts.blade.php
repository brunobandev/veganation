@if (session('success'))
    <div class="alert alert-success mt-4" role="alert">
        {{ session('success') }}
    </div>
@endif

@if (session('warning'))
    <div class="alert alert-warning mt-4" role="alert">
        {{ session('warning') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-error mt-4" role="alert">
        {{ session('error') }}
    </div>
@endif
