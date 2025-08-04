<!DOCTYPE html>
<html>
<head>
    <title>Edit Employee</title>
    <style>
        /* ...existing styles... */
    </style>
</head>
<body>
    <div class="container">
        <div class="back-link">
            <a href="{{ route('employees.show', [$companyId, $employee['id']]) }}">&larr; Back to Employee Details</a>
        </div>

        <h1>Edit Employee</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Employee Info Display (Read-only) -->
        <div class="form-section">
            <div class="section-title">Employee Information</div>
            
            <div class="form-group">
                <label>Employee Name</label>
                <input type="text" value="{{ $employee['name'] }}" readonly style="background-color: #f8f9fa; cursor: not-allowed;">
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" value="{{ $employee['email'] }}" readonly style="background-color: #f8f9fa; cursor: not-allowed;">
            </div>
        </div>

        <!-- Current Photo Display -->
        <div class="current-photo">
            <h3 style="color: #666; margin-bottom: 10px;">Current Photo</h3>
            @if($employee['logo'])
                <img src="{{ asset('storage/' . $employee['logo']) }}" alt="Current Photo" class="photo-preview">
            @else
                <div class="no-photo">No Photo</div>
            @endif
        </div>

        <form action="{{ route('employees.update', [$companyId, $employee['id']]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Editable Fields -->
            <div class="form-section">
                <div class="section-title">Update Information</div>
                
                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="text" id="phone" name="phone" value="{{ old('phone', $employee['phone']) }}" placeholder="e.g., 08123456789">
                    @error('phone')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="logo">Upload New Photo</label>
                    <input type="file" id="logo" name="logo" accept="image/*">
                    <small style="color: #666; display: block; margin-top: 5px;">
                        Accepted formats: JPG, PNG, GIF (Max: 2MB). Leave empty to keep current photo.
                    </small>
                    @error('logo')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Update Employee</button>
                <a href="{{ route('employees.show', [$companyId, $employee['id']]) }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>