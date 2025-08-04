<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add Companies') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <form class="flex flex-col gap-5" action="{{ route('companies.store') }}" method="POST" enctype="multipart/form-data">
				@csrf

				<div class="">
					<div class="flex items-center space-x-6">
						<div class="shrink-0">
							<img class="h-16 w-16 object-cover rounded-full" src="https://ui-avatars.com/api/?name=Company&background=random&color=fff" alt="Company logo" >
						</div>
						<label class="block w-full">
							<input name="logo" type="file" accept="image/*" class="block w-full text-sm text-slate-500
							file:mr-4 file:py-2 file:px-4
							file:rounded-full file:border-0
							file:text-sm file:font-semibold
							file:bg-violet-50 file:text-violet-700
							hover:file:bg-violet-100
							">
						</label>
					</div>
					@error('logo')
						<p class="mt-2 text-pink-600 text-sm">
							{{ $message }}
						</p>
					@enderror
				</div>
				
				<label class="block">
					<span class="block text-sm font-medium text-slate-400">Name <span class="text-red-500">*</span></span>
					<input name="name" type="text" required placeholder="Company Name" value="{{ old('name') }}" class="peer mt-1 block w-full px-3 py-2 bg-slate-300 focus:bg-white border border-slate-300 rounded-md text-sm shadow-sm placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500 disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none">
					@error('name')
						<p class="mt-2 text-pink-600 text-sm">
							{{ $message }}
						</p>
					@enderror
				</label>

				<label class="block">
					<span class="block text-sm font-medium text-slate-400">Email <span class="text-red-500">*</span></span>
					<input name="email" type="email" required placeholder="abc@abc.com" value="{{ old('email') }}" class="peer mt-1 block w-full px-3 py-2 bg-slate-300 focus:bg-white border border-slate-300 rounded-md text-sm shadow-sm placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500 disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none">
					@error('email')
						<p class="mt-2 text-pink-600 text-sm">
							{{ $message }}
						</p>
					@enderror
				</label>

				<label class="block">
					<span class="block text-sm font-medium text-slate-400">Description</span>
					<textarea rows="3" name="description" class="peer mt-1 block w-full px-3 py-2 bg-slate-300 focus:bg-white border border-slate-300 rounded-md text-sm shadow-sm placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500 disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none ">{{ old('description') }}</textarea>
					@error('description')
						<p class="mt-2 text-pink-600 text-sm">
							{{ $message }}
						</p>
					@enderror
				</label>

				<button type="submit" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 active:bg-blue-600 focus:outline-none focus:border-blue-700 focus:ring ring-blue-200 disabled:opacity-25 transition ease-in-out duration-150">
					Create Company
			</form>
        </div>
    </div>
</x-app-layout>
