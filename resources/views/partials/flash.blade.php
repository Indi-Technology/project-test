@if (session('success'))
    <div style="background: #d1e7dd; color: #0f5132; padding: 10px; border-radius: 5px; margin-bottom: 10px;">
        {{ session('success') }}
    </div>
@endif

@if ($errors->any())
    <div style="background: #f8d7da; color: #842029; padding: 10px; border-radius: 5px; margin-bottom: 10px;">
        <ul style="margin: 0; padding-left: 20px;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
