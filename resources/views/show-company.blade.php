<!DOCTYPE html>
<html>
<head>
    <title>Company Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 1200px;
            margin: 50px auto;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .back-link {
            margin-bottom: 20px;
        }
        .back-link a {
            color: #007bff;
            text-decoration: none;
            font-size: 14px;
        }
        .back-link a:hover {
            text-decoration: underline;
        }
        .company-header {
            border-bottom: 2px solid #007bff;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .company-logo {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 15px;
        }
        .company-name {
            font-size: 28px;
            font-weight: bold;
            color: #333;
            margin: 0;
        }
        .info-section {
            margin-bottom: 30px;
        }
        .info-title {
            font-size: 20px;
            font-weight: bold;
            color: #007bff;
            margin-bottom: 15px;
            border-bottom: 1px solid #eee;
            padding-bottom: 5px;
        }
        .info-item {
            margin-bottom: 10px;
            padding: 10px;
            background-color: #f8f9fa;
            border-radius: 4px;
        }
        .info-label {
            font-weight: bold;
            color: #666;
            width: 120px;
            display: inline-block;
        }
        .info-value {
            color: #333;
        }
        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            margin: 0 5px;
            text-decoration: none;
            border-radius: 4px;
            font-size: 14px;
            cursor: pointer;
            border: none;
        }
        .btn-primary {
            background-color: #007bff;
            color: white;
        }
        .btn-success {
            background-color: #28a745;
            color: white;
        }
        .btn-danger {
            background-color: #dc3545;
            color: white;
        }
        .btn:hover {
            opacity: 0.8;
        }
        .employees-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .employees-table th {
            background-color: #007bff;
            color: white;
            padding: 15px;
            text-align: left;
            font-weight: bold;
        }
        .employees-table td {
            padding: 15px;
            border-bottom: 1px solid #eee;
        }
        .employees-table tr:hover {
            background-color: #f8f9fa;
        }
        .employees-table tr:last-child td {
            border-bottom: none;
        }
        .employee-photo {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 50%;
            border: 2px solid #ddd;
        }
        .no-photo {
            width: 50px;
            height: 50px;
            background-color: #e9ecef;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #6c757d;
            font-size: 12px;
            text-align: center;
        }
        .pagination {
            margin-top: 20px;
            display: flex;
            justify-content: center;
        }
        .pagination nav {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .pagination .page-link {
            padding: 8px 12px;
            border: 1px solid #ddd;
            text-decoration: none;
            color: #007bff;
            border-radius: 4px;
        }
        .pagination .page-link:hover {
            background-color: #f8f9fa;
        }
        .pagination .page-item.active .page-link {
            background-color: #007bff;
            color: white;
            border-color: #007bff;
        }
        .pagination .page-item.disabled .page-link {
            color: #6c757d;
            pointer-events: none;
        }
        .pagination-info {
            text-align: center;
            margin-bottom: 15px;
            color: #666;
            font-size: 14px;
        }
        .no-data {
            color: #666;
            font-style: italic;
            text-align: center;
            padding: 40px;
        }
        .actions {
            margin-top: 30px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="back-link">
            @if(Auth::user()->role === 'admin')
                <a href="{{ route('companies.index') }}">&larr; Back to Companies List</a>
            @else
                <a href="{{ route('dashboard') }}">&larr; Back to Dashboard</a>
            @endif
        </div>

        <div class="company-header">
            @if($result['company']['logo'])
                <img src="{{ asset('storage/' . $result['company']['logo']) }}" alt="Company Logo" class="company-logo">
            @endif
            <h1 class="company-name">{{ $result['company']['name'] ?? 'No Name' }}</h1>
        </div>

        <div class="info-section">
            <h2 class="info-title">Company Information</h2>
            
            <div class="info-item">
                <span class="info-label">Company Name:</span>
                <span class="info-value">{{ $result['company']['name'] ?? 'No Name' }}</span>
            </div>
            
            <div class="info-item">
                <span class="info-label">Email:</span>
                <span class="info-value">{{ $result['company']['email'] ?? 'No Email' }}</span>
            </div>
            
            <div class="info-item">
                <span class="info-label">Description:</span>
                <span class="info-value">{{ $result['company']['description'] ?? 'No Description' }}</span>
            </div>
            
            <div class="info-item">
                <span class="info-label">Total Employees:</span>
                <span class="info-value">{{ $result['employees']->total() }} employees</span>
            </div>
        </div>

        <div class="info-section">
            <div class="section-header">
                <h2 class="info-title">Employees</h2>
                @if(Auth::user()->role === 'company')
                    <a href="{{ route('employees.create', ['id' => $result['company']['id']]) }}" class="btn btn-success">+ Add Employee</a>
                @endif
            </div>

            @if($result['employees']->count() > 0)
                <!-- Pagination Info -->
                <div class="pagination-info">
                    Showing {{ $result['employees']->firstItem() }} to {{ $result['employees']->lastItem() }} of {{ $result['employees']->total() }} employees
                </div>

                <!-- Employees Table -->
                <table class="employees-table">
                    <thead>
                        <tr>
                            <th>Photo</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($result['employees'] as $employee)
                            <tr>
                                <td>
                                    @if($employee['logo'])
                                        <img src="{{ asset('storage/' . $employee['logo']) }}" alt="Employee Photo" class="employee-photo">
                                    @else
                                        <div class="no-photo">No Photo</div>
                                    @endif
                                </td>
                                <td>
                                    <strong>{{ $employee['name'] ?? 'No Name' }}</strong>
                                </td>
                                <td>
                                    {{ $employee['phone'] ?? 'No Phone' }}
                                </td>
                                <td>
                                    @if(Auth::user()->role === 'company')
                                        <a href="{{ route('employees.show', ['id' => $result['company']['id'], 'employeeId' => $employee['id']]) }}" class="btn btn-primary" style="font-size: 12px; padding: 5px 10px;">View</a>
                                        <a href="{{ route('employees.edit', ['id' => $result['company']['id'], 'employeeId' => $employee['id']]) }}" class="btn btn-success" style="font-size: 12px; padding: 5px 10px;">Edit</a>
                                    @elseif(Auth::user()->role === 'admin')
                                        <a href="{{ route('employees.show', ['id' => $result['company']['id'], 'employeeId' => $employee['id']]) }}" class="btn btn-primary" style="font-size: 12px; padding: 5px 10px;">View</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Pagination Links -->
                <div class="pagination">
                    {{ $result['employees']->links() }}
                </div>
            @else
                <div class="no-data">
                    <p>No employees found for this company.</p>
                    @if(Auth::user()->role === 'company')
                        <div style="margin-top: 20px;">
                            <a href="{{ route('employees.create', ['id' => $result['company']['id']]) }}" class="btn btn-success">Add First Employee</a>
                        </div>
                    @endif
                </div>
            @endif
        </div>

        <!-- Action buttons berdasarkan role -->
        <div class="actions">
            @if(Auth::user()->role === 'admin')
                <a href="{{ route('companies.edit', $company['id']) }}" class="btn btn-primary">Edit Company</a>
                
                <form action="{{ route('companies.destroy', $company['id']) }}" method="POST" style="display: inline;" 
                      onsubmit="return confirm('Are you sure you want to delete this company?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete Company</button>
                </form>
            @elseif(Auth::user()->role === 'company')
                <a href="{{ route('employees.index', $result['company']['id']) }}" class="btn btn-primary">Manage All Employees</a>
            @endif
        </div>
    </div>
</body>
</html>