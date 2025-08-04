<!DOCTYPE html>
<html>
<head>
    <title>Company Details</title>
    <style>
        
    </style>
</head>
<body>
    <div class="container">
        <div class="back-link">
            <a href="{{ route('companies.index') }}">&larr; Back to Companies List</a>
        </div>

        <div class="company-header flex justify-center items-center bg-blue-500 p-4">
            @if($company['logo'])
                <img src="{{ asset('storage/' . $company['logo']) }}" alt="Company Logo" class="company-logo">
            @endif
            <h1 class="company-name text-white">{{ $company['name'] ?? 'No Name' }}</h1>
        </div>

        <div class="info-section flex justify-center items-center">
            <h2 class="info-title">Company Information</h2>
            
            <div class="info-item">
                <span class="info-label">Company Name:</span>
                <span class="info-value">{{ $company['name'] ?? 'No Name' }}</span>
            </div>
            
            <div class="info-item">
                <span class="info-label">Email:</span>
                <span class="info-value">{{ $company['email'] ?? 'No Email' }}</span>
            </div>
            
            <div class="info-item">
                <span class="info-label">Description:</span>
                <span class="info-value">{{ $company['description'] ?? 'No Description' }}</span>
            </div>
            
            <div class="info-item">
                <span class="info-label">Total Employees:</span>
                <span class="info-value">{{ count($company['employees']) }} employees</span>
            </div>
        </div>

        <div class="info-section">
            <h2 class="info-title">Employees</h2>
            
            @if(count($company['employees']) > 0)
                <ul class="employees-list">
                    @foreach($company['employees'] as $employee)
                        <li class="employee-item">
                            <div class="employee-name">{{ $employee['user']['name'] ?? 'No Name' }}</div>
                            <div class="employee-email">{{ $employee['user']['email'] ?? 'No Email' }}</div>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="no-data">No employees found for this company.</p>
            @endif
        </div>

        <div class="actions">
            <a href="{{ route('companies.edit', $company['id']) }}" class="btn btn-primary">Edit Company</a>

            <form action="{{ route('companies.destroy', $company['id']) }}" method="POST" style="display: inline;" 
                  onsubmit="return confirm('Are you sure you want to delete this company?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete Company</button>
            </form>
        </div>
    </div>
</body>
</html>