@extends('layouts.frontend')

@section('content')

<div class="bg-gray-100 py-12 px-4">

    <div class="max-w-4xl mx-auto">

        <!-- Card -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-8">

            <!-- Header -->
            <div class="mb-8 text-center">
                <h1 class="text-2xl font-bold text-gray-800">
                    Add New Project
                </h1>
                <p class="text-gray-500 mt-2 text-sm">
                    Create and manage your portfolio projects.
                </p>
            </div>

            <form action="{{ route('admin.projects.store') }}"
                  method="POST"
                  enctype="multipart/form-data"
                  class="space-y-6">
                @csrf

                <!-- Title -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Project Title
                    </label>
                    <input type="text"
                           name="title"
                           value="{{ old('title') }}"
                           placeholder="Enter project title"
                           class="w-full px-4 py-3 rounded-lg border border-gray-300 
                                  focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 
                                  outline-none transition duration-200">
                </div>

                <!-- Description -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Description
                    </label>
                    <textarea name="description"
                              rows="4"
                              placeholder="Write project description..."
                              class="w-full px-4 py-3 rounded-lg border border-gray-300 
                                     focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 
                                     outline-none transition duration-200 resize-none">{{ old('description') }}</textarea>
                </div>

                <!-- Upload -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-3">
                        Project Image
                    </label>

                    <label class="flex flex-col items-center justify-center w-full h-32 
                                  border-2 border-dashed border-gray-300 rounded-xl 
                                  hover:border-indigo-500 hover:bg-indigo-50 
                                  transition duration-200 cursor-pointer text-center">

                        <span class="text-gray-500 text-sm">
                            Click to upload or drag and drop
                        </span>
                        <span class="text-xs text-gray-400 mt-1">
                            PNG, JPG up to 2MB
                        </span>

                        <input type="file" name="image" class="hidden">
                    </label>
                </div>

                <!-- Buttons -->
                <div class="flex justify-between items-center pt-6 border-t border-gray-100">

                    <a href="{{ route('admin.projects.index') }}"
                       class="text-gray-500 hover:text-gray-700 text-sm transition">
                        Cancel
                    </a>

                    <button type="submit"
                            class="px-6 py-2.5 bg-indigo-600 text-white rounded-lg 
                                   shadow-md hover:bg-indigo-700 
                                   transition duration-200 transform hover:scale-105">
                        Save Project
                    </button>

                </div>

            </form>
        </div>

    </div>

</div>

@endsection