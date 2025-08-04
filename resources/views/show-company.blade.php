<!DOCTYPE html>
<html>
<head>
    <title>Company Details</title>
    <style>
        /* ...existing styles... */
        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }
        .btn-success {
            background-color: #28a745;
            color: white;
        }
        .btn-success:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="back-link">
            <a href="{{ route('companies.index') }}">&larr; Back to Companies List</a>
        </div>

        <div class="company-header">
            @if($company['logo'])
                <img src="{{ asset('storage/' . $company['logo']) }}" alt="Company Logo" class="company-logo">
            @endif
            <h1 class="company-name">{{ $company['name'] ?? 'No Name' }}</h1>
        </div>

        <div class="info-section">
            <h2 class="info-title">Company Information</h2>
            
            <div class="info-item">
                <span class="info-label">Company Name:</span>
                <span class="info-value">{{ $company['name'] ?? 'No Name' }}</span>
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
            <div class="section-header">
                <h2 class="info-title">Employees</h2>
                <a href="{{ route('employees.create', ['company_id' => $company['id']]) }}" class="btn btn-success">+ Add Employee</a>
            </div>
            
            @if(count($company['employees']) > 0)
                <ul class="employees-list">
                    @foreach($company['employees'] as $employee)
                        <li class="employee-item">
                            <div class="employee-name">{{ $employee['name'] ?? 'No Name' }}</div>
                            <div class="employee-email">Phone: {{ $employee['phone'] ?? 'No Phone' }}</div>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="no-data">No employees found for this company.</p>
                <div style="text-align: center; margin-top: 20px;">
                    <a href="{{ route('employees.create', ['company_id' => $company['id']]) }}" class="btn btn-success">Add First Employee</a>
                </div>
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