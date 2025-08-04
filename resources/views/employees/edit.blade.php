@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#F3E2D4] flex items-center justify-center py-10">
    <form action="{{ route('employees.update', $employee->id) }}" method="POST"
        class="w-full max-w-lg bg-[#C5B0CD] shadow-lg rounded-xl p-8 space-y-6">
        @csrf
        @method('PUT')

        <h2 class="text-2xl font-bold text-[#17313E] text-center">Edit Employee</h2>

        <div>
            <label class="block text-[#17313E] font-semibold mb-1">Name</label>
            <input type="text" name="name" value="{{ old('name', $employee->name) }}"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#415E72] focus:border-[#415E72]"
                required>
        </div>

        <div>
            <label class="block text-[#17313E] font-semibold mb-1">Email</label>
            <input type="email" name="email" value="{{ old('email', $employee->email) }}"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#415E72] focus:border-[#415E72]"
                required>
        </div>

        <div>
            <label class="block text-[#17313E] font-semibold mb-1">Phone</label>
            <input type="text" name="phone" value="{{ old('phone', $employee->phone) }}"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#415E72] focus:border-[#415E72]"
                required>
        </div>

        <div>
            <label class="block text-[#17313E] font-semibold mb-1">Company</label>
            <select name="company_id"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#415E72] focus:border-[#415E72]"
                required>
                @foreach($companies as $company)
                    <option value="{{ $company->id }}"
                        {{ old('company_id', $employee->company_id) == $company->id ? 'selected' : '' }}>
                        {{ $company->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="text-center">
            <button type="submit"
                class="bg-[#415E72] hover:bg-[#17313E] text-white font-semibold py-2 px-6 rounded-lg shadow-md transition duration-200">
                Update
            </button>
        </div>
    </form>
</div>
@endsection
