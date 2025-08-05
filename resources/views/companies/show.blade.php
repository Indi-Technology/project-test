<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __("Company") }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
			<img src="{{ $company->logo ? asset('storage/' . $company->logo) : 'https://ui-avatars.com/api/?name=' . $company->name . '&background=random&color=fff' }}" alt="{{ $company->name }} logo" class="h-32 w-32 object-cover rounded-full mb-4 m-auto">
			<label class="block mb-4">
				<span class="block text-sm font-medium text-slate-400">
					Name
				</span>
				<p class="text-black dark:text-white">{{ $company->name }}</p>
			</label>

			<label class="block mb-4">
				<span class="block text-sm font-medium text-slate-400">
					Email
				</span>
				<p class="text-black dark:text-white">{{ $company->email }}</p>
			</label>

			<label class="block mb-4">
				<span class="block text-sm font-medium text-slate-400">
					Description
				</span>
				<p class="text-black dark:text-white">{{ $company->description }}</p>
			</label>
        </div>

		<div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
			<p class="text-black dark:text-white font-bold text-2xl text-center mt-10 mb-5">Employee of {{ $company->name }}</p>
			<table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
				<thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 text-center">
					<tr>
						<th scope="col" class="px-6 py-3">No.</th>
						<th scope="col" class="px-6 py-3">Name</th>
						<th scope="col" class="px-6 py-3">Email</th>
						<th scope="col" class="px-6 py-3">Phone</th>
					</tr>
				</thead>
				<tbody>
					@php
						$no = 1;
					@endphp
					@foreach ($employees as $employee)
						<tr onclick="window.location.href='{{ route('employees.show', $employee->id) }}'"  class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 text-center cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-600 transition-all">
							<th>{{ $no + ($employees->currentPage() - 1) * $employees->perPage() }}</th>
							<td class="px-6 py-4">
								{{ $employee->name }}
							</td>
							<td class="px-6 py-4">
								{{ $employee->email }}
							</td>
							<td class="px-6 py-4">
								{{ $employee->phone }}
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
</x-app-layout>
