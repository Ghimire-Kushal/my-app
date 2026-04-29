@extends('layouts.frontend')

@section('content')

@php
    use Illuminate\Support\Str;
@endphp

<section class="py-24 bg-gray-50 min-h-screen">
    <div class="max-w-3xl mx-auto px-6">

        <div class="bg-white rounded-2xl shadow-xl p-8">

            <h2 class="text-2xl font-bold text-gray-900 mb-6">
                Edit Project
            </h2>

            <form action="{{ route('admin.projects.update', $project->id) }}" 
                  method="POST"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- CURRENT IMAGE --}}
                @if(!empty($project->image))
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Current Image
                        </label>

                        @if(Str::startsWith($project->image, ['http://', 'https://']))
                            {{-- Cloudinary --}}
                            <img 
                                src="{{ $project->image }}"
                                class="w-full h-56 object-cover rounded-lg border"
                            >
                        @else
                            {{-- Local --}}
                            <img 
                                src="{{ asset('storage/'.$project->image) }}"
                                class="w-full h-56 object-cover rounded-lg border"
                            >
                        @endif
                    </div>
                @endif

                {{-- CHANGE IMAGE --}}
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Change Image
                    </label>

                    <input type="file" 
                           name="image"
                           class="w-full px-4 py-2 border rounded-lg">
                </div>

                {{-- TITLE --}}
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Project Title
                    </label>

                    <input type="text" 
                           name="title"
                           value="{{ old('title', $project->title) }}"
                           class="w-full px-4 py-3 border rounded-lg 
                                  focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                           required>
                </div>

                {{-- DESCRIPTION --}}
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Description
                    </label>

                    <textarea name="description"
                              rows="4"
                              class="w-full px-4 py-3 border rounded-lg 
                                     focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                              required>{{ old('description', $project->description) }}</textarea>
                </div>

                {{-- BUTTONS --}}
                <div class="flex gap-4">
                    <button type="submit"
                            class="px-6 py-3 bg-indigo-600 text-white rounded-lg
                                   hover:bg-indigo-700 transition">
                        Update Project
                    </button>

                    <a href="{{ route('admin.projects.index') }}"
                       class="px-6 py-3 bg-gray-200 text-gray-700 rounded-lg
                              hover:bg-gray-300 transition">
                        Cancel
                    </a>
                </div>

            </form>

        </div>

    </div>
</section>

@endsection