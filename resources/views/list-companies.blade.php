<!DOCTYPE html>
<html>
<head>
    <title>Companies List</title>
</head>
<body>
    <h1>Companies</h1>
    
    @forelse($companies as $company)
        <div class="company-card">
            <h3>{{ $company['name'] }}</h3>
            <p><strong>ID:</strong> {{ $company['id'] }}</p>
            <p><strong>Description:</strong> {{ $company['description'] }}</p>
            <p><strong>Total Employees:</strong> {{ count($company['employees']) }}</p>
        </div>
    @empty
        <p>No companies available.</p>
    @endforelse
</body>
</html>