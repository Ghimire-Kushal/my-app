@extends('layouts.frontend')

@section('content')

<section class="py-28 bg-gray-50 min-h-screen">
    <div class="max-w-6xl mx-auto px-6">

        {{-- Page Title --}}
        <div class="text-center mb-16">
            <h1 class="text-4xl font-bold text-gray-900">
                My Projects
            </h1>
            <p class="text-gray-500 mt-4 text-lg">
                A collection of my recent work
            </p>
        </div>

        {{-- Project Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">

            @forelse($projects as $project)
                <div class="group bg-white rounded-2xl border border-gray-100
                            shadow-sm hover:shadow-2xl hover:-translate-y-1
                            transition duration-500 overflow-hidden">

                    {{-- Project Image --}}

@if(!empty($project->image) && filter_var($project->image, FILTER_VALIDATE_URL))
    <img 
        src="{{ $project->image }}" 
        alt="{{ $project->title }}"
        class="w-full h-52 object-cover rounded-t-xl"
    >
@else
    <div class="w-full h-52 bg-gray-200 flex items-center justify-center">
        <span class="text-gray-400">No Image</span>
    </div>
@endif

                    <div class="p-6">

                        {{-- Title --}}
                        <h3 class="text-xl font-semibold text-gray-900">
                            {{ $project->title }}
                        </h3>

                        {{-- Description --}}
                        <p class="text-gray-600 text-sm mt-3 leading-relaxed">
                            {{ \Illuminate\Support\Str::limit($project->description, 120) }}
                        </p>

                        {{-- Button --}}
                        <a href="{{ route('projects.show', $project->slug) }}"
                           class="inline-block mt-6 text-indigo-600 font-medium group-hover:underline">
                            View Details →
                        </a>

                    </div>
                </div>

            @empty
                <div class="col-span-full text-center text-gray-500 text-lg">
                    No projects available yet.
                </div>
            @endforelse

        </div>

        {{-- Pagination --}}
        @if(method_exists($projects, 'links'))
            <div class="mt-16 flex justify-center">
                {{ $projects->links() }}
            </div>
        @endif

    </div>
</section>

@endsection