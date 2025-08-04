<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Employees') }}
        </h2>
    </x-slot>

    <div class="py-12">
		
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
			@if (session('success'))
				<div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 border border-green-300" role="alert">
					{{ session('success') }}
				</div>
			@endif

			@if (session('error'))
				<div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 border border-red-300" role="alert">
					{{ session('error') }}
				</div>
			@endif

            <a href="{{ route('employees.create') }}" class="bg-green-500 hover:bg-green-700 dark:bg-gray-600 dark:hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                + Add
            </a>

			<div class="mt-6">
				<form action="{{ route('employees') }}" method="GET" class="flex items-center">
					<input type="text" name="search" placeholder="Search by name or email" class="border border-gray-300 rounded-lg px-4 py-2 w-full" value="{{ request('search') }}">
					<select id="company"
							name="company"
							class="block w-3/12 ml-3 px-4 py-2 text-sm text-gray-700 bg-slate-300 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
							<option value="">All Companies</option>
							@foreach($companies as $company)
								<option value="{{ $company->id }}" {{ (request('company') == $company->id) ? 'selected' : '' }}>
									{{ $company->name }}
								</option>
							@endforeach
					</select>
					<button type="submit" class="ml-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
						Search
					</button>
				</form>
			</div>
            <div class="mt-10">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 text-center">
                        <tr>
                            <th scope="col" class="px-6 py-3">No.</th>
                            <th scope="col" class="px-6 py-3">Company</th>
                            <th scope="col" class="px-6 py-3">Name</th>
                            <th scope="col" class="px-6 py-3">Email</th>
                            <th scope="col" class="px-6 py-3">Phone</th>
                            <th scope="col" class="px-6 py-3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($employees as $employee)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 text-center">
                                <th>{{ $no + ($employees->currentPage() - 1) * $employees->perPage() }}</th>
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white underline">
									<a href="{{ route('companies.show', $employee->company->id) }}">
										{{ $employee->company->name }}
									</a>
                                </th>
                                <td class="px-6 py-4">
                                    {{ $employee->name }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $employee->email }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $employee->phone }}
                                </td>
                                <td class="flex gap-5 px-6 py-6 justify-center">
									<a href="{{ route('employees.show', $employee->id) }}" class="text-blue-600 hover:text-blue-900">View</a>
                                    <a href="{{ route('employees.edit', $employee->id) }}" class="text-yellow-600 hover:text-yellow-900">Edit</a>
                                    <form action="{{ route('employees.delete', $employee->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Are you sure?')" class="text-red-600 hover:text-red-900">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @php
                                $no++;
                            @endphp
						@endforeach
                    </tbody>
                </table>
				<div class="mt-4">
					{{ $employees->links() }}
				</div>
            </div>
        </div>
    </div>
</x-app-layout>
