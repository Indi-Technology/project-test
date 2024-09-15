<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Label') }}
        </h2>
        <x-breadcrumb :items="[['url' => route('dashboard'), 'label' => 'Dashboard'], ['url' => '#', 'label' => 'Labels']]" />
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-end mb-4">
                <a href="{{ route('labels.create') }}"
                    class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-500">
                    Create Label
                </a>
            </div>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                <span class="sr-only">Edit</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($labels as $label)
                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $label->name }}
                                </th>
                                <td class="px-6 py-4 text-right">
                                    <a href="{{ route('labels.edit', $label) }}"
                                        class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                    <a href="{{ route('labels.destroy', $label) }}"
                                        class="font-medium text-blue-600 dark:text-blue-500 hover:underline"
                                        onclick="event.preventDefault(); document.getElementById('delete-label-{{ $label->id }}').submit();">Delete</a>
                                </td>
                            </tr>
                            <form action="{{ route('labels.destroy', $label->id) }}" method="POST"
                                id="delete-label-{{ $label->id }}">
                                @csrf
                                @method('DELETE')
                            </form>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $labels->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
