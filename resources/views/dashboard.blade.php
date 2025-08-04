<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <p>You're logged in!</p>
                <ul class="mt-4 space-y-2">
                    <li>
                        <a href="{{ route('companies.index') }}" class="text-blue-600 hover:underline">📁 Manage Companies</a>
                    </li>
                    <li>
                        <a href="{{ route('employees.index') }}" class="text-blue-600 hover:underline">👤 Manage Employees</a>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</x-app-layout>
