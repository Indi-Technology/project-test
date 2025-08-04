<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add Employees') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <form class="flex flex-col gap-5" action="{{ route('employees.store') }}" method="POST">
				@csrf

				<div class="">
					<label for="company" class="block text-sm font-medium text-slate-400">
						Select Company <span class="text-red-500">*</span>
					</label>
					<select id="company"
							name="company_id"
							class="block w-full px-4 py-2 text-sm text-gray-700 bg-slate-300 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
							@foreach($companies as $company)
								<option value="{{ $company->id }}" {{ (old('company_id') == $company->id) ? 'selected' : '' }}>
									{{ $company->name }}
								</option>
							@endforeach
					</select>
					@error('company_id')
						<p class="mt-2 text-pink-600 text-sm">
							{{ $message }}
						</p>
					@enderror
				</div>
				
				<label class="block">
					<span class="block text-sm font-medium text-slate-400">
						Name <span class="text-red-500">*</span>
					</span>
					<input name="name" type="text" required placeholder="Employee Name" value="{{ old('name') }}" class="peer mt-1 block w-full px-3 py-2 bg-slate-300 focus:bg-white border border-slate-300 rounded-md text-sm shadow-sm placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500 disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none">
					@error('name')
						<p class="mt-2 text-pink-600 text-sm">
							{{ $message }}
						</p>
					@enderror
				</label>

				<label class="block">
					<span class="block text-sm font-medium text-slate-400">
						Email <span class="text-red-500">*</span>
					</span>
					<input name="email" type="email" required placeholder="abc@abc.com" value="{{ old('email') }}" class="peer mt-1 block w-full px-3 py-2 bg-slate-300 focus:bg-white border border-slate-300 rounded-md text-sm shadow-sm placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500 disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none">
					@error('email')
						<p class="mt-2 text-pink-600 text-sm">
							{{ $message }}
						</p>
					@enderror
				</label>

				<label class="block">
					<span class="block text-sm font-medium text-slate-400">
						Phone <span class="text-red-500">*</span>
					</span>
					<input name="phone" type="text" required placeholder="+62 812-3456-7890" value="{{ old('phone') }}" class="peer mt-1 block w-full px-3 py-2 bg-slate-300 focus:bg-white border border-slate-300 rounded-md text-sm shadow-sm placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500 disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none">
					@error('phone')
						<p class="mt-2 text-pink-600 text-sm">
							{{ $message }}
						</p>
					@enderror
				</label>

				<button type="submit" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 active:bg-blue-600 focus:outline-none focus:border-blue-700 focus:ring ring-blue-200 disabled:opacity-25 transition ease-in-out duration-150">
					Create Employee
			</form>
        </div>
    </div>
</x-app-layout>
