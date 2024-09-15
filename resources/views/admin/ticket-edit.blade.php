@extends('admin.layouts.app')

@section('content')
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Ticket
        </h2>

        <!-- General elements -->
        <h4 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
            Edit Ticket
        </h4>
        <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
            <label class="block text-sm">
                <span class="text-gray-700 dark:text-gray-400">Title</span>
                <input
                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                    placeholder="Jane Doe" />
            </label>

            <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">Text Description</span>
                <textarea
                    class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                    rows="3" placeholder="Enter some long form content."></textarea>
            </label>


            <label class="block mt-4 text-sm"></label>
            <span class="text-gray-700 dark:text-gray-400">Labels</span>
            <div class="mt-1 flex space-x-4">
                <div>
                    <input id="default-checkbox" type="checkbox" value=""
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="default-checkbox"
                        class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Bug</label>
                </div>
                <div>
                    <input checked id="checked-checkbox" type="checkbox" value=""
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="checked-checkbox"
                        class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Question</label>
                </div>
                <div>
                    <input checked id="checked-checkbox" type="checkbox" value=""
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="checked-checkbox"
                        class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Enhancement</label>
                </div>
            </div>

            <label class="block mt-4 text-sm"></label>
            <span class="text-gray-700 dark:text-gray-400">Categories</span>
            <div class="mt-1 flex space-x-4">
                <div>
                    <input id="default-checkbox" type="checkbox" value=""
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="default-checkbox"
                        class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Uncategorized</label>
                </div>
                <div>
                    <input checked id="checked-checkbox" type="checkbox" value=""
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="checked-checkbox"
                        class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Payments</label>
                </div>
                <div>
                    <input checked id="checked-checkbox" type="checkbox" value=""
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="checked-checkbox"
                        class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Technical question</label>
                </div>
            </div>

            <div x-data="{ isPriorityMenuOpen: false }">
                <label class="block mt-4 text-sm"></label>
                <span class="text-gray-700 dark:text-gray-400">Priority</span>
                <div class="mt-1">
                    <button
                        class="inline-flex items-center justify-between w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                        @click="isPriorityMenuOpen = !isPriorityMenuOpen" aria-haspopup="true">
                        <span class="inline-flex items-center">
                            <span class="ml-2">Priority</span>
                        </span>
                        <svg class="w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>

                    <div x-show="isPriorityMenuOpen" x-transition:enter="transition-all ease-in-out duration-300"
                        x-transition:leave="transition-all ease-in-out duration-300"
                        class="p-2 mt-2 space-y-2 overflow-hidden text-sm font-medium text-gray-500 rounded-md shadow-inner bg-gray-50 dark:text-gray-400 dark:bg-gray-900"
                        aria-label="submenu">
                        <ul>
                            <li
                                class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                                <a class="w-full" href="#">Low</a>
                            </li>
                            <li
                                class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                                <a class="w-full" href="#">Medium</a>
                            </li>
                            <li
                                class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                                <a class="w-full" href="#">High</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>



            <div x-data="{ isAgentMenuOpen: false }">
                <label class="block mt-4 text-sm"></label>
                <span class="text-gray-700 dark:text-gray-400">Agent</span>
                <div class="mt-1">
                    <button
                        class="inline-flex items-center justify-between w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                        @click="isAgentMenuOpen = !isAgentMenuOpen" aria-haspopup="true">
                        <span class="inline-flex items-center">
                            <span class="ml-2">Agent</span>
                        </span>
                        <svg class="w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>

                    <div x-show="isAgentMenuOpen" x-transition:enter="transition-all ease-in-out duration-300"
                        x-transition:leave="transition-all ease-in-out duration-300"
                        class="p-2 mt-2 space-y-2 overflow-hidden text-sm font-medium text-gray-500 rounded-md shadow-inner bg-gray-50 dark:text-gray-400 dark:bg-gray-900"
                        aria-label="submenu">
                        <ul>
                            <li
                                class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                                <a class="w-full" href="#">Dian</a>
                            </li>
                            <li
                                class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                                <a class="w-full" href="#">Dina</a>
                            </li>
                            <li
                                class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                                <a class="w-full" href="#">Dani</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="flex justify-between mt-4">
                <div>
                    <button class="bg-blue-500 hover:bg-blue-400 text-white text-sm font-semibold px-4 py-2 rounded">
                        Cancel
                    </button>
                </div>
                <div>
                    <button class="bg-blue-500 hover:bg-blue-700 text-white text-sm font-semibold px-4 py-2 rounded">
                        Update
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
