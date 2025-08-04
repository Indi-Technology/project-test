<!DOCTYPE html>
<html>
<head>
    <title>Companies List</title>
</head>
<body>
    <h1>Companies</h1>
    
    @forelse($companies as $company)
        <div class="company-card">
            <h3 class="company-name ">{{ $company['name'] }}</h3>
            <p><strong>ID:</strong> {{ $company['id'] }}</p>
            <p><strong>Description:</strong> {{ $company['description'] }}</p>
            <p><strong>Total Employees:</strong> {{ count($company['employees']) }}</p>
            <a href="{{ route('companies.show', $company['id']) }}">View Details</a>
        </div>
    @empty
        <p>No companies available.</p>
    @endforelse
</body>
</html>