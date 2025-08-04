@extends('layouts.app')

@section('title', 'Edit Employee')

@section('content')
    <div class="max-w-2xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Edit Employee</h1>
            <p class="mt-2 text-gray-600">Update employee information</p>
        </div>

        <!-- Form -->
        <div class="bg-white rounded-xl shadow-lg p-6">
            <form action="{{ route('employees.update', $employee) }}" method="POST" enctype="multipart/form-data"
                class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Full Name *</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $employee->name) }}" required
                        class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('name') @enderror"
                        placeholder="Enter employee full name">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $employee->email) }}"
                        required
                        class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('email') @enderror"
                        placeholder="Enter employee email">
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone *</label>
                    <input type="tel" id="phone" name="phone" value="{{ old('phone', $employee->phone) }}"
                        required
                        class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('phone') @enderror"
                        placeholder="Enter employee phone number">
                    @error('phone')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Current Profile Picture -->
                @if ($employee->profile_picture)
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Current Profile Picture</label>
                        <img src="{{ Storage::url($employee->profile_picture) }}" alt="{{ $employee->name }}"
                            class="h-32 w-32 object-cover rounded-full border border-gray-300">
                    </div>
                @endif

                <div>
                    <label for="profile_picture"
                        class="block text-sm font-medium text-gray-700 mb-2">{{ $employee->profile_picture ? 'Update Profile Picture' : 'Profile Picture' }}</label>
                    <div
                        class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md hover:border-gray-400 transition duration-200">
                        <div class="space-y-1 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none"
                                viewBox="0 0 48 48">
                                <path
                                    d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <div class="flex text-sm text-gray-600">
                                <label for="profile_picture"
                                    class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                    <span>Upload a photo</span>
                                    <input id="profile_picture" name="profile_picture" type="file" class="sr-only"
                                        accept="image/*">
                                </label>
                                <p class="pl-1">or drag and drop</p>
                            </div>
                            <p class="text-xs text-gray-500">PNG, JPG, GIF up to 2MB (min 100x100px)</p>
                            @if ($employee->profile_picture)
                                <p class="text-xs text-blue-600">Leave empty to keep current photo</p>
                            @endif
                        </div>
                    </div>
                    @error('profile_picture')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Preview -->
                <div id="imagePreview" class="hidden">
                    <label class="block text-sm font-medium text-gray-700 mb-2">New Photo Preview</label>
                    <img id="preview" class="h-32 w-32 object-cover rounded-full border border-gray-300"
                        alt="Profile preview">
                </div>

                @if (Auth::user()->isAdmin())
                    <div>
                        <label for="company_id" class="block text-sm font-medium text-gray-700 mb-2">Company *</label>
                        <select id="company_id" name="company_id" required
                            class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('company_id') @enderror">
                            <option value="">Select Company</option>
                            @foreach ($companies as $company)
                                <option value="{{ $company->id }}"
                                    {{ old('company_id', $employee->company_id) == $company->id ? 'selected' : '' }}>
                                    {{ $company->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('company_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                @else
                    <!-- For company users, show their company info -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Company</label>
                        <div class="px-3 py-2 bg-gray-50 border border-gray-300 rounded-md">
                            <span class="text-gray-900">{{ $employee->company->name }}</span>
                        </div>
                        <input type="hidden" name="company_id" value="{{ $employee->company_id }}">
                    </div>
                @endif

                <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                    <a href="{{ route('employees.index') }}"
                        class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Cancel
                    </a>
                    <button type="submit"
                        class="px-6 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Update Employee
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('profile_picture').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('preview').src = e.target.result;
                    document.getElementById('imagePreview').classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            } else {
                document.getElementById('imagePreview').classList.add('hidden');
            }
        });
    </script>
@endsection
