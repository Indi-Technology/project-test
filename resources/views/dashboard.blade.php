<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>

			<div class="flex gap-5">
				<a href="{{ route('companies') }}" class="block bg-white dark:bg-gray-800 shadow-md rounded-2xl p-6 w-64 my-10 cursor-pointer">
					<p class="text-gray-500 dark:text-gray-200 text-sm font-medium mb-2">Companies</p>
					<p class="text-3xl font-bold text-gray-900 dark:text-slate-100">{{ $companies->count() }}</p>
				</a>
	
				<a href="{{ route('employees') }}" class="block bg-white dark:bg-gray-800 shadow-md rounded-2xl p-6 w-64 my-10 cursor-pointer">
					<p class="text-gray-500 dark:text-gray-200 text-sm font-medium mb-2">Employees</p>
					<p class="text-3xl font-bold text-gray-900 dark:text-slate-100">{{ $employees->count() }}</p>
				</a>
			</div>
        </div>
    </div>
</x-app-layout>
