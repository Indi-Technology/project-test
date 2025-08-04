@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#F3E2D4] flex items-center justify-center py-10">
    <form action="{{ route('companies.store') }}" method="POST" enctype="multipart/form-data"
        class="w-full max-w-lg bg-[#C5B0CD] shadow-lg rounded-xl p-8 space-y-6">
        @csrf

        <h2 class="text-2xl font-bold text-[#17313E] text-center">Create Company</h2>

        <div>
            <label class="block text-[#17313E] font-semibold mb-1">Name</label>
            <input type="text" name="name" value="{{ old('name') }}"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#415E72] focus:border-[#415E72]"
                required>
        </div>

        <div>
            <label class="block text-[#17313E] font-semibold mb-1">Email</label>
            <input type="email" name="email" value="{{ old('email') }}"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#415E72] focus:border-[#415E72]"
                required>
        </div>

        <div>
            <label class="block text-[#17313E] font-semibold mb-1">Logo (min 100x100px)</label>
            <input type="file" name="logo"
                class="block w-full text-sm text-gray-700 border border-gray-300 rounded-lg cursor-pointer bg-white focus:outline-none focus:ring-2 focus:ring-[#415E72] focus:border-[#415E72] file:mr-4 file:py-2 file:px-4 file:border-0 file:text-sm file:font-semibold file:bg-[#415E72] file:text-white hover:file:bg-[#17313E]">
        </div>

        <div>
            <label class="block text-[#17313E] font-semibold mb-1">Description</label>
            <textarea name="description" rows="4"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#415E72] focus:border-[#415E72]">{{ old('description') }}</textarea>
        </div>

        <div class="text-center">
            <button type="submit"
                class="bg-[#415E72] hover:bg-[#17313E] text-white font-semibold py-2 px-6 rounded-lg shadow-md transition duration-200">
                Create
            </button>
        </div>
    </form>
</div>
@endsection
