@extends('layouts.app')

@section('title', $employee->name)

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-start">
        <div class="flex items-center space-x-4">
            @if($employee->profile_picture)
                <img src="{{ Storage::url($employee->profile_picture) }}" alt="{{ $employee->name }}" class="h-16 w-16 rounded-full object-cover border border-gray-300">
            @else
                <div class="h-16 w-16 rounded-full bg-gray-200 flex items-center justify-center">
                    <span class="text-xl font-medium text-gray-700">
                        {{ substr($employee->name, 0, 2) }}
                    </span>
                </div>
            @endif
            <div>
                <h1 class="text-3xl font-bold text-gray-900">{{ $employee->name }}</h1>
                <p class="text-gray-600">Employee Details</p>
            </div>
        </div>
        <div class="flex space-x-3">
            <a href="{{ route('employees.edit', $employee) }}" 
               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition duration-200">
                Edit
            </a>
            <a href="{{ route('employees.index') }}" 
               class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg font-medium transition duration-200">
                Back to List
            </a>
        </div>
    </div>

    <!-- Employee Information -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Personal Information -->
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h2 class="text-xl font-bold text-gray-900 mb-4">Personal Information</h2>
            <dl class="grid grid-cols-1 gap-4">
                <div>
                    <dt class="text-sm font-medium text-gray-500">Full Name</dt>
                    <dd class="text-lg text-gray-900">{{ $employee->name }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Email</dt>
                    <dd class="text-lg text-gray-900">
                        <a href="mailto:{{ $employee->email }}" class="text-blue-600 hover:text-blue-800">
                            {{ $employee->email }}
                        </a>
                    </dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Phone</dt>
                    <dd class="text-lg text-gray-900">
                        <a href="tel:{{ $employee->phone }}" class="text-blue-600 hover:text-blue-800">
                            {{ $employee->phone }}
                        </a>
                    </dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Joined</dt>
                    <dd class="text-lg text-gray-900">{{ $employee->created_at->format('M d, Y') }}</dd>
                </div>
            </dl>
        </div>

        <!-- Company Information -->
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h2 class="text-xl font-bold text-gray-900 mb-4">Company Information</h2>
            <div class="flex items-start space-x-4">
                @if($employee->company->logo)
                    <img src="{{ Storage::url($employee->company->logo) }}" alt="{{ $employee->company->name }}" class="h-16 w-16 rounded-lg object-cover border border-gray-300">
                @else
                    <div class="h-16 w-16 rounded-lg bg-gray-200 flex items-center justify-center">
                        <svg class="h-8 w-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-4m-2 0H3m2 0h2m12 0V9a2 2 0 00-2-2H9a2 2 0 00-2 2v12"></path>
                        </svg>
                    </div>
                @endif
                <div class="flex-1">
                    <h3 class="text-lg font-semibold text-gray-900">{{ $employee->company->name }}</h3>
                    <div class="mt-2 space-y-1">
                        <p class="text-sm text-gray-600">
                            <span class="font-medium">Email:</span>
                            <a href="mailto:{{ $employee->company->email }}" class="text-blue-600 hover:text-blue-800">
                                {{ $employee->company->email }}
                            </a>
                        </p>
                        @if($employee->company->website)
                        <p class="text-sm text-gray-600">
                            <span class="font-medium">Website:</span>
                            <a href="{{ $employee->company->website }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                                {{ $employee->company->website }}
                            </a>
                        </p>
                        @endif
                    </div>
                    <div class="mt-4">
                        @if(Auth::user()->isAdmin())
                        <a href="{{ route('companies.show', $employee->company) }}" 
                           class="inline-flex items-center px-3 py-1 text-sm bg-blue-100 text-blue-800 rounded-lg hover:bg-blue-200 transition duration-200">
                            View Company Details
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Additional Actions -->
    <div class="bg-white rounded-xl shadow-lg p-6">
        <h2 class="text-xl font-bold text-gray-900 mb-4">Actions</h2>
        <div class="flex space-x-4">
            <a href="mailto:{{ $employee->email }}" 
               class="inline-flex items-center px-4 py-2 bg-green-100 text-green-800 rounded-lg hover:bg-green-200 transition duration-200">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
                Send Email
            </a>
            <a href="tel:{{ $employee->phone }}" 
               class="inline-flex items-center px-4 py-2 bg-blue-100 text-blue-800 rounded-lg hover:bg-blue-200 transition duration-200">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                </svg>
                Call Employee
            </a>
            <form action="{{ route('employees.destroy', $employee) }}" method="POST" class="inline"
                  onsubmit="return confirm('Are you sure you want to delete this employee? This action cannot be undone.')">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        class="inline-flex items-center px-4 py-2 bg-red-100 text-red-800 rounded-lg hover:bg-red-200 transition duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                    Delete Employee
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
