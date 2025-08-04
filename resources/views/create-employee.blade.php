<!DOCTYPE html>
<html>
<head>
    <title>Create Employee</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 600px;
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
        h1 {
            color: #333;
            margin-bottom: 30px;
            border-bottom: 2px solid #007bff;
            padding-bottom: 10px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #555;
        }
        input, select, textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 14px;
        }
        input:focus, select:focus, textarea:focus {
            border-color: #007bff;
            outline: none;
            box-shadow: 0 0 5px rgba(0,123,255,0.3);
        }
        .btn {
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            text-decoration: none;
            display: inline-block;
            margin-right: 10px;
        }
        .btn-primary {
            background-color: #007bff;
            color: white;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .btn-secondary {
            background-color: #6c757d;
            color: white;
        }
        .btn-secondary:hover {
            background-color: #545b62;
        }
        .error {
            color: #dc3545;
            font-size: 14px;
            margin-top: 5px;
        }
        .alert {
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 4px;
        }
        .alert-danger {
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
        }
        .form-actions {
            margin-top: 30px;
            text-align: center;
            border-top: 1px solid #eee;
            padding-top: 20px;
        }
        .required {
            color: #dc3545;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="back-link">
            @if($companyId)
                <a href="{{ route('companies.show', $companyId) }}">&larr; Back to Company Details</a>
            @else
                <a href="{{ route('employees.index') }}">&larr; Back to Employees List</a>
            @endif
        </div>

        <h1>Create New Employee</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('employees.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            @if($companyId)
                <input type="hidden" name="company_id" value="{{ $companyId }}">
            @endif

            <div class="form-group">
                <label for="name">Employee Name <span class="required">*</span></label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required>
                @error('name')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email <span class="required">*</span></label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                @error('email')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password <span class="required">*</span></label>
                <input type="password" id="password" name="password" required>
                @error('password')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirm Password <span class="required">*</span></label>
                <input type="password" id="password_confirmation" name="password_confirmation" required>
            </div>

            @if(!$companyId)
                <div class="form-group">
                    <label for="company_id">Company <span class="required">*</span></label>
                    <select id="company_id" name="company_id" required>
                        <option value="">Select Company</option>
                        @foreach($companies as $company)
                            <option value="{{ $company['id'] }}" {{ old('company_id') == $company['id'] ? 'selected' : '' }}>
                                {{ $company['name'] }}
                            </option>
                        @endforeach
                    </select>
                    @error('company_id')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
            @endif

            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="text" id="phone" name="phone" value="{{ old('phone') }}" placeholder="e.g., 08123456789">
                @error('phone')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="logo">Employee Photo</label>
                <input type="file" id="logo" name="logo" accept="image/*">
                <small style="color: #666; display: block; margin-top: 5px;">
                    Accepted formats: JPG, PNG, GIF (Max: 2MB)
                </small>
                @error('logo')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Create Employee</button>
                @if($companyId)
                    <a href="{{ route('companies.show', $companyId) }}" class="btn btn-secondary">Cancel</a>
                @else
                    <a href="{{ route('employees.index') }}" class="btn btn-secondary">Cancel</a>
                @endif
            </div>
        </form>
    </div>
</body>
</html>