<!DOCTYPE html>
<html>
<head>
    <title>Employee Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
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
        .employee-header {
            display: flex;
            align-items: center;
            border-bottom: 2px solid #007bff;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .employee-photo {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 50%;
            margin-right: 20px;
            border: 4px solid #007bff;
        }
        .no-photo {
            width: 120px;
            height: 120px;
            background-color: #e9ecef;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #6c757d;
            font-size: 14px;
            text-align: center;
            margin-right: 20px;
            border: 4px solid #ddd;
        }
        .employee-info {
            flex: 1;
        }
        .employee-name {
            font-size: 28px;
            font-weight: bold;
            color: #333;
            margin: 0 0 10px 0;
        }
        .employee-role {
            font-size: 16px;
            color: #666;
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
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
        .info-item {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            border-left: 4px solid #007bff;
        }
        .info-label {
            font-weight: bold;
            color: #666;
            font-size: 14px;
            margin-bottom: 5px;
        }
        .info-value {
            color: #333;
            font-size: 16px;
        }
        .btn {
            display: inline-block;
            padding: 12px 20px;
            margin: 0 10px 10px 0;
            text-decoration: none;
            border-radius: 4px;
            font-size: 14px;
            cursor: pointer;
            border: none;
            text-align: center;
        }
        .btn-primary {
            background-color: #007bff;
            color: white;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .btn-success {
            background-color: #28a745;
            color: white;
        }
        .btn-success:hover {
            background-color: #218838;
        }
        .btn-danger {
            background-color: #dc3545;
            color: white;
        }
        .btn-danger:hover {
            background-color: #c82333;
        }
        .btn-secondary {
            background-color: #6c757d;
            color: white;
        }
        .btn-secondary:hover {
            background-color: #545b62;
        }
        .actions {
            margin-top: 30px;
            text-align: center;
            border-top: 1px solid #eee;
            padding-top: 20px;
        }
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
        }
        .alert-success {
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
        }
        .alert-danger {
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
        }
        @media (max-width: 768px) {
            .employee-header {
                flex-direction: column;
                text-align: center;
            }
            .employee-photo, .no-photo {
                margin-right: 0;
                margin-bottom: 15px;
            }
            .info-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="back-link">
            <a href="{{ route('companies.show', $companyId) }}">&larr; Back to Company Details</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="employee-header">
            @if($employee['logo'])
                <img src="{{ asset('storage/' . $employee['logo']) }}" alt="Employee Photo" class="employee-photo">
            @else
                <div class="no-photo">No Photo</div>
            @endif
            
            <div class="employee-info">
                <h1 class="employee-name">{{ $employee['name'] ?? 'No Name' }}</h1>
                <p class="employee-role">Employee</p>
            </div>
        </div>

        <div class="info-section">
            <h2 class="info-title">Personal Information</h2>
            
            <div class="info-grid">
                <div class="info-item">
                    <div class="info-label">Full Name</div>
                    <div class="info-value">{{ $employee['name'] ?? 'No Name' }}</div>
                </div>
                
                <div class="info-item">
                    <div class="info-label">Email Address</div>
                    <div class="info-value">{{ $employee['email'] ?? 'No Email' }}</div>
                </div>
                
                <div class="info-item">
                    <div class="info-label">Phone Number</div>
                    <div class="info-value">{{ $employee['phone'] ?? 'No Phone' }}</div>
                </div>
                
                <div class="info-item">
                    <div class="info-label">Employee ID</div>
                    <div class="info-value">#{{ $employee['id'] }}</div>
                </div>
            </div>
        </div>

        <div class="info-section">
            <h2 class="info-title">Company Information</h2>
            
            <div class="info-grid">
                <div class="info-item">
                    <div class="info-label">Company Name</div>
                    <div class="info-value">{{ $employee['company_name'] ?? 'No Company' }}</div>
                </div>
                
                <div class="info-item">
                    <div class="info-label">Position</div>
                    <div class="info-value">Employee</div>
                </div>
                
                <div class="info-item">
                    <div class="info-label">Status</div>
                    <div class="info-value">
                        <span style="background-color: #28a745; color: white; padding: 4px 8px; border-radius: 4px; font-size: 12px;">
                            Active
                        </span>
                    </div>
                </div>
                
                <div class="info-item">
                    <div class="info-label">Joined Date</div>
                    <div class="info-value">N/A</div>
                </div>
            </div>
        </div>

        <!-- Action buttons berdasarkan role -->
        <div class="actions">
            @if(Auth::user()->role === 'company')
                <a href="{{ route('employees.edit', ['id' => $companyId, 'employeeId' => $employee['id']]) }}" class="btn btn-primary">Edit Employee</a>
                
                <form action="{{ route('employees.destroy', ['id' => $companyId, 'employeeId' => $employee['id']]) }}" method="POST" style="display: inline;" 
                      onsubmit="return confirm('Are you sure you want to delete this employee?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete Employee</button>
                </form>
                
                <a href="{{ route('companies.show', $companyId) }}" class="btn btn-secondary">View All Employees</a>
            @elseif(Auth::user()->role === 'admin')
                <a href="{{ route('companies.show', $companyId) }}" class="btn btn-primary">Back to Company</a>
            @endif
        </div>
    </div>
</body>
</html>