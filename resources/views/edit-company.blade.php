<!DOCTYPE html>
<html>
<head>
    <title>Edit Company</title>
    <style>
    
    </style>
</head>
<body>
    <div class="container">
        <div class="back-link">
            <a href="{{ route('companies.show', $company['id']) }}">&larr; Back to Company Details</a>
        </div>

        <h1>Edit Company: {{ $company['name'] }}</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('companies.update', $company['id']) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label for="name">Company Name <span class="required">*</span></label>
                <input type="text" id="name" name="name" value="{{ old('name', $company['name']) }}" required>
                @error('name')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" rows="4" placeholder="Enter company description...">{{ old('description', $company['description']) }}</textarea>
                @error('description')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="logo">Company Logo</label>
                
                @if($company['logo'])
                    <div class="current-logo">
                        <p><strong>Current Logo:</strong></p>
                        <img src="{{ asset('storage/' . $company['logo']) }}" alt="Current Company Logo">
                    </div>
                @endif
                
                <div class="file-input-wrapper">
                    <input type="file" id="logo" name="logo" accept="image/*">
                    <small style="color: #666; display: block; margin-top: 5px;">
                        Leave empty to keep current logo. Accepted formats: JPG, PNG, GIF (Max: 2MB)
                    </small>
                </div>
                
                @error('logo')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Update Company</button>
                <a href="{{ route('companies.show', $company['id']) }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>

    <script>
        // Preview logo sebelum upload
        document.getElementById('logo').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const currentLogo = document.querySelector('.current-logo img');
                    if (currentLogo) {
                        currentLogo.src = e.target.result;
                    } else {
                        // Buat preview baru jika belum ada logo
                        const preview = document.createElement('div');
                        preview.className = 'current-logo';
                        preview.innerHTML = '<p><strong>New Logo Preview:</strong></p><img src="' + e.target.result + '" alt="Logo Preview">';
                        document.querySelector('.file-input-wrapper').insertBefore(preview, document.getElementById('logo'));
                    }
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>
</html>