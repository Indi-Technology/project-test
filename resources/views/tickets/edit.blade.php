<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create New Ticket') }}
        </h2>
        <x-breadcrumb :items="[
            ['url' => route('dashboard'), 'label' => 'Dashboard'],
            ['url' => route('tickets.index'), 'label' => 'Tickets'],
            ['url' => '#', 'label' => 'Update Ticket'],
        ]" />
    </x-slot>



    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('tickets.update', $ticket->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Title -->
                <div>
                    <x-input-label for="title" :value="__('Title')" />
                    <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')"
                        autofocus autocomplete="title" value="{{ $ticket->title }}" />
                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                </div>

                <!-- Description -->
                <div class="mt-4">
                    <x-input-label for="description" :value="__('Message Description')" />
                    <x-text-area id="description" id="description" class="block mt-1 w-full" name="description" />
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>

                {{-- Labels --}}
                <div class="mt-4">
                    <x-input-label for="labels" :value="__('Labels')" />
                    <div class="flex flex-wrap">
                        @foreach ($labels as $label)
                            <div class="flex items-center me-4">
                                <input id="label-{{ $label->id }}" type="checkbox" name="labels[]"
                                    value="{{ $label->id }}" @if (in_array($label->id, $ticket->labels->pluck('id')->toArray())) checked @endif
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="label-{{ $label->id }}"
                                    class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                    {{ $label->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                    <x-input-error :messages="$errors->get('labels')" class="mt-2" />
                </div>

                {{-- Categories --}}
                <div class="mt-4">
                    <x-input-label for="categories" :value="__('Categories')" />
                    <div class="flex flex-wrap">
                        @foreach ($categories as $category)
                            <div class="flex items-center me-4">
                                <input id="category-{{ $category->id }}" type="checkbox" name="categories[]"
                                    value="{{ $category->id }}" @if (in_array($category->id, $ticket->categories->pluck('id')->toArray())) checked @endif
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="category-{{ $category->id }}"
                                    class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                    {{ $category->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                    <x-input-error :messages="$errors->get('categories')" class="mt-2" />
                </div>

                {{-- Priority --}}
                <div class="mt-4">
                    <x-input-label for="priority" :value="__('Priority')" />
                    <select id="priority" name="priority"
                        class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                        <option value="low" @if (old('priority', $ticket->priority) == 'low') selected @endif>Low</option>
                        <option value="medium" @if (old('priority', $ticket->priority) == 'medium') selected @endif>Medium</option>
                        <option value="high" @if (old('priority', $ticket->priority) == 'high') selected @endif>High</option>
                    </select>
                    <x-input-error :messages="$errors->get('priority')" class="mt-2" />
                </div>

                {{-- Status --}}
                <div class="mt-4">
                    <x-input-label for="status" :value="__('Status')" />
                    <select id="status" name="status"
                        class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                        <option value="open" @if (old('status', $ticket->status) == 'open') selected @endif>Open</option>
                        <option value="closed" @if (old('status', $ticket->status) == 'closed') selected @endif>Closed</option>
                    </select>
                    <x-input-error :messages="$errors->get('status')" class="mt-2" />

                    {{-- Attchment Multi File --}}
                    <div class="mt-4">
                        <x-input-label for="attachments" :value="__('Attachments')" />
                        <input id="attachments" type="file" name="attachments[]" multiple
                            class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">

                        <small class="text-gray-600">Maximum file size 2mb, you can upload multiple files at
                            once</small>
                        <x-input-error :messages="$errors->get('attachments')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-primary-button class="ms-4">
                            {{ __('Update Ticket') }}
                        </x-primary-button>
                    </div>
            </form>
            @if ($ticket->attachments->count() > 0)
                <div>
                    <x-input-label for="attachments" :value="__('Existing Attachments')" />
                    @foreach ($ticket->attachments as $file)
                        <x-attachment route="{{ route('attachments.download', $file->id) }}"
                            name="{{ $file->original_name }}" size="{{ $file->formatted_size }}"
                            extension="{{ $file->extension }}"
                            delete="{{ route('attachments.destroy', $file->id) }}" />
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    @push('styles')
        <link rel="stylesheet" type="text/css"
            href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/3.2.6/css/froala_editor.pkgd.min.css">
    @endpush
    @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/3.2.6/js/froala_editor.pkgd.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                new FroalaEditor('#description', {
                    toolbarButtons: [
                        'bold', 'italic', 'underline', 'fontSize', '|', 'formatUL',
                        '-', 'insertLink', '|', 'specialCharacters', 'insertHR',
                        'selectAll', '|', 'html', '|', 'undo', 'redo'
                    ],
                    imageUpload: false,
                    fileUpload: false,
                    videoUpload: false,
                    quickInsertEnabled: false,
                    events: {
                        'initialized': function() {
                            this.html.set(@json(old('description', $ticket->description)));
                        }
                    }
                });
            });
        </script>
    @endpush
</x-app-layout>
