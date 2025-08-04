@extends('layouts.app')

@section('title', $company->name)

@section('content')
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex justify-between items-start">
            <div class="flex items-center space-x-4">
                @if ($company->logo)
                    <img src="{{ Storage::url($company->logo) }}" alt="{{ $company->name }}"
                        class="h-16 w-16 rounded-lg object-cover border border-gray-300">
                @else
                    <div class="h-16 w-16 rounded-lg bg-gray-200 flex items-center justify-center">
                        <svg class="h-8 w-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-4m-2 0H3m2 0h2m12 0V9a2 2 0 00-2-2H9a2 2 0 00-2 2v12">
                            </path>
                        </svg>
                    </div>
                @endif
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">{{ $company->name }}</h1>
                    <p class="text-gray-600">Company Details</p>
                </div>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('companies.edit', $company) }}"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition duration-200">
                    Edit
                </a>
                <a href="{{ route('companies.index') }}"
                    class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg font-medium transition duration-200">
                    Back to List
                </a>
            </div>
        </div>

        <!-- Company Information -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Company Details -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Company Information</h2>
                    <dl class="grid grid-cols-1 gap-4">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Company Name</dt>
                            <dd class="text-lg text-gray-900">{{ $company->name }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Email</dt>
                            <dd class="text-lg text-gray-900">
                                <a href="mailto:{{ $company->email }}" class="text-blue-600 hover:text-blue-800">
                                    {{ $company->email }}
                                </a>
                            </dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Website</dt>
                            <dd class="text-lg text-gray-900">
                                @if ($company->website)
                                    <a href="{{ $company->website }}" target="_blank"
                                        class="text-blue-600 hover:text-blue-800">
                                        {{ $company->website }}
                                    </a>
                                @else
                                    <span class="text-gray-400">Not provided</span>
                                @endif
                            </dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Created</dt>
                            <dd class="text-lg text-gray-900">{{ $company->created_at->format('M d, Y') }}</dd>
                        </div>
                    </dl>
                </div>
            </div>

            <!-- Statistics -->
            <div class="space-y-6">
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Statistics</h3>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Total Employees</span>
                            <span class="text-2xl font-bold text-blue-600">{{ $company->employees->count() }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Company Users</span>
                            <span class="text-2xl font-bold text-green-600">{{ $company->users->count() }}</span>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h3>
                    <div class="space-y-3">
                        <a href="{{ route('employees.create') }}"
                            class="block w-full text-center bg-green-100 hover:bg-green-200 text-green-800 py-2 px-4 rounded-lg transition duration-200">
                            Add Employee
                        </a>
                        <a href="{{ route('employees.index') }}?company={{ $company->id }}"
                            class="block w-full text-center bg-blue-100 hover:bg-blue-200 text-blue-800 py-2 px-4 rounded-lg transition duration-200">
                            View Employees
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Employees -->
        @if ($company->employees->count() > 0)
            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-bold text-gray-900">Employees</h2>
                    <a href="{{ route('employees.index') }}?company={{ $company->id }}"
                        class="text-blue-600 hover:text-blue-800 font-medium">View All</a>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Email</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Phone</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Added</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($company->employees->take(5) as $employee)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ $employee->name }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-500">{{ $employee->email }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-500">{{ $employee->phone }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-500">{{ $employee->created_at->format('M d, Y') }}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <div class="bg-white rounded-xl shadow-lg p-12 text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                    </path>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">No employees</h3>
                <p class="mt-1 text-sm text-gray-500">This company doesn't have any employees yet.</p>
                <div class="mt-6">
                    <a href="{{ route('employees.create') }}"
                        class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                        Add First Employee
                    </a>
                </div>
            </div>
        @endif
    </div>
@endsection
