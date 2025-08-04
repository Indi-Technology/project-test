<!DOCTYPE html>
<html>
<head>
    <title>Companies List</title>
</head>
<body>
    <h1>Companies</h1>
    
    @forelse($companies as $company)
        <div class="company-card">
            <h3>{{ $company->name }}</h3>
            <p><strong>Owner:</strong> {{ $company->user->name ?? 'No Owner' }}</p>
            <p><strong>Total Employees:</strong> {{ $company->employees->count() }}</p>
        </div>
    @empty
        <p>No companies available.</p>
    @endforelse
</body>
</html>