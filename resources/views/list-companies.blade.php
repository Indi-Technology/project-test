<!DOCTYPE html>
<html>
<head>
    <title>Companies List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 1000px;
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
        .header {
            display: flex;
            justify-content: between;
            align-items: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #007bff;
            padding-bottom: 20px;
        }
        h1 {
            color: #333;
            margin: 0;
        }
        .add-btn {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 4px;
            font-size: 14px;
        }
        .add-btn:hover {
            background-color: #218838;
        }
        .company-card {
            background-color: #f8f9fa;
            padding: 20px;
            margin-bottom: 15px;
            border-radius: 8px;
            border-left: 4px solid #007bff;
        }
        .company-name {
            font-size: 20px;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }
        .company-info {
            margin-bottom: 10px;
            color: #666;
        }
        .company-info strong {
            color: #333;
        }
        .view-btn {
            background-color: #007bff;
            color: white;
            padding: 8px 15px;
            text-decoration: none;
            border-radius: 4px;
            font-size: 14px;
        }
        .view-btn:hover {
            background-color: #0056b3;
        }
        .pagination {
            margin-top: 30px;
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
        .no-companies {
            text-align: center;
            color: #666;
            font-style: italic;
            padding: 40px;
        }
        .pagination-info {
            text-align: center;
            margin-bottom: 20px;
            color: #666;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Companies Management</h1>
            <a href="{{ route('companies.create') }}" class="add-btn">+ Add New Company</a>
        </div>

        @if(session('success'))
            <div style="background-color: #d4edda; color: #155724; padding: 15px; border-radius: 4px; margin-bottom: 20px;">
                {{ session('success') }}
            </div>
        @endif

        @if($companies->count() > 0)
            <!-- Pagination Info -->
            <div class="pagination-info">
                Showing {{ $companies->firstItem() }} to {{ $companies->lastItem() }} of {{ $companies->total() }} companies
            </div>

            @foreach($companies as $company)
                <div class="company-card">
                    <h3 class="company-name">{{ $company['name'] ?? 'No Name' }}</h3>
                    <p class="company-info"><strong>ID:</strong> {{ $company['id'] }}</p>
                    <p class="company-info"><strong>Description:</strong> {{ $company['description'] ?? 'No Description' }}</p>
                    <p class="company-info"><strong>Total Employees:</strong> {{ count($company['employees']) }}</p>
                    <a href="{{ route('companies.show', $company['id']) }}" class="view-btn">View Details</a>
                </div>
            @endforeach

            <!-- Pagination Links -->
            <div class="pagination">
                {{ $companies->links() }}
            </div>
        @else
            <div class="no-companies">
                <p>No companies available.</p>
                <a href="{{ route('companies.create') }}" class="add-btn">Create First Company</a>
            </div>
        @endif
    </div>
</body>
</html>