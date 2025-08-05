<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __("Employee") }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
			<img src="{{ $employee->company->logo ? asset('storage/' . $employee->company->logo) : 'https://ui-avatars.com/api/?name=' . $employee->company->name . '&background=random&color=fff' }}" alt="{{ $employee->company->name }} logo" class="h-32 w-32 object-cover rounded-full mb-4 m-auto">

			<label class="block mb-4">
				<span class="block text-sm font-medium text-slate-400">
					Company Name
				</span>
				<a href="{{ route('companies.show', $employee->company->id) }}" class="text-black dark:text-white underline">{{ $employee->company->name }}</a>
			</label>

			<label class="block mb-4">
				<span class="block text-sm font-medium text-slate-400">
					Name
				</span>
				<p class="text-black dark:text-white">{{ $employee->name }}</p>
			</label>

			<label class="block mb-4">
				<span class="block text-sm font-medium text-slate-400">
					Email
				</span>
				<p class="text-black dark:text-white">{{ $employee->email }}</p>
			</label>

			<label class="block mb-4">
				<span class="block text-sm font-medium text-slate-400">
					Phone
				</span>
				<p class="text-black dark:text-white">{{ $employee->phone }}</p>
			</label>
        </div>
    </div>
</x-app-layout>
