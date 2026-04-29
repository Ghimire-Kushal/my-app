@extends('layouts.frontend')

@section('content')

@php
    use Illuminate\Support\Str;
@endphp

<div class="bg-gray-100 py-20 px-6">

    <div class="max-w-6xl mx-auto">

        <!-- Back -->
        <a href="{{ route('projects.index') }}"
           class="text-indigo-600 hover:text-indigo-800 text-sm mb-8 inline-block">
            ← Back to Projects
        </a>

        <!-- Title -->
        <div class="text-center mb-16">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900">
                {{ $project->title }}
            </h1>
            <div class="w-24 h-1 bg-indigo-600 mx-auto mt-4 rounded-full"></div>
        </div>

        <!-- Card -->
        <div class="bg-white rounded-3xl shadow-xl p-8 md:p-12">

            <div class="grid md:grid-cols-2 gap-12 items-center">

                <!-- ✅ FINAL IMAGE FIX -->
                <div class="overflow-hidden rounded-2xl shadow-lg">

                    @if(!empty($project->image))

                        @if(Str::startsWith($project->image, ['http://', 'https://']))
                            {{-- Cloudinary --}}
                            <img 
                                src="{{ $project->image }}"
                                alt="{{ $project->title }}"
                                class="w-full h-[400px] object-cover hover:scale-105 transition duration-500"
                            >
                        @else
                            {{-- Local storage --}}
                            <img 
                                src="{{ asset('storage/'.$project->image) }}"
                                alt="{{ $project->title }}"
                                class="w-full h-[400px] object-cover hover:scale-105 transition duration-500"
                            >
                        @endif

                    @else
                        {{-- No image --}}
                        <div class="w-full h-[400px] flex items-center justify-center bg-gray-200">
                            <span class="text-gray-400">No Image Available</span>
                        </div>
                    @endif

                </div>

                <!-- Content -->
                <div>

                    <h2 class="text-2xl font-semibold text-gray-800 mb-6">
                        Project Overview
                    </h2>

                    <p class="text-gray-600 leading-relaxed text-lg mb-8">
                        {{ $project->description }}
                    </p>

                    @if($project->link)
                        <a href="{{ $project->link }}"
                           target="_blank"
                           class="inline-block px-8 py-3 bg-indigo-600 text-white rounded-xl shadow-md hover:bg-indigo-700 transition transform hover:scale-105">
                            Visit Live Project →
                        </a>
                    @endif

                </div>

            </div>

        </div>

    </div>

</div>

@endsection