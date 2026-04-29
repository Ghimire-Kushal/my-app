@extends('layouts.frontend')

@section('content')

{{-- ================= HERO ================= --}}
<section class="relative overflow-hidden bg-white py-28">

    <div class="max-w-5xl mx-auto px-6 text-center">

        <div class="inline-flex items-center px-5 py-2 rounded-full 
            bg-indigo-50 text-indigo-600 text-sm font-medium shadow-sm">
            🚀 Building Scalable Web Applications
        </div>

        <h1 class="mt-8 text-5xl md:text-6xl font-extrabold text-gray-900 tracking-tight">
            Kushal Ghimire
        </h1>

        <h2 class="mt-4 text-xl md:text-2xl text-indigo-600 font-semibold">
            Laravel Developer | Backend Specialist
        </h2>

        <p class="mt-6 text-lg text-gray-600 max-w-3xl mx-auto leading-relaxed">
            I design and develop high-performance Laravel applications with
            clean architecture, secure authentication systems, and modern UI.
        </p>

        <div class="mt-10 flex justify-center gap-6 flex-wrap">

            <a href="#projects"
               class="px-8 py-3 rounded-xl bg-indigo-600 text-white font-semibold 
                      shadow-lg hover:bg-indigo-700 hover:shadow-xl transition duration-300">
                View My Work →
            </a>

            <a href="{{ route('resume.download') }}"
               class="px-8 py-3 rounded-xl border border-gray-300 text-gray-800 font-medium
                      hover:border-indigo-600 hover:text-indigo-600 transition duration-300">
                Download Resume
            </a>

        </div>

    </div>
</section>


{{-- ================= PROJECTS ================= --}}
<section id="projects" class="py-24 bg-gray-50">

    <div class="max-w-6xl mx-auto px-6">

        <div class="text-center mb-14">
            <h2 class="text-3xl font-bold text-gray-900">
                Featured Projects
            </h2>
            <p class="text-gray-500 mt-3">
                Real-world applications built with Laravel
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">

            @forelse($projects as $project)

                <div class="bg-white rounded-2xl shadow-md hover:shadow-xl 
                            hover:-translate-y-1 transition duration-300 
                            overflow-hidden flex flex-col">

                    {{-- ✅ FIXED IMAGE --}}
                    @php
                        use Illuminate\Support\Str;
                    @endphp

                    @if(!empty($project->image))

                        @if(Str::startsWith($project->image, ['http://', 'https://']))
                            {{-- Cloudinary --}}
                            <img 
                                src="{{ $project->image }}"
                                alt="{{ $project->title }}"
                                class="w-full h-52 object-cover"
                            >
                        @else
                            {{-- Local --}}
                            <img 
                                src="{{ asset('storage/'.$project->image) }}"
                                alt="{{ $project->title }}"
                                class="w-full h-52 object-cover"
                            >
                        @endif

                    @else
                        {{-- Fallback --}}
                        <div class="w-full h-52 bg-gray-200 flex items-center justify-center">
                            <span class="text-gray-400">No Image</span>
                        </div>
                    @endif


                    <div class="p-6 flex flex-col flex-1">

                        <h3 class="text-xl font-semibold text-gray-900">
                            {{ $project->title }}
                        </h3>

                        <p class="text-gray-600 text-sm mt-3 flex-1">
                            {{ \Illuminate\Support\Str::limit($project->description, 110) }}
                        </p>

                        <div class="mt-4 flex flex-wrap gap-2 text-xs font-medium">
                            <span class="bg-indigo-100 text-indigo-600 px-3 py-1 rounded-full">Laravel</span>
                            <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full">MySQL</span>
                            <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full">Tailwind</span>
                        </div>

                        <div class="mt-6 flex gap-4">

                            <a href="{{ route('projects.show', $project->slug) }}"
                               class="text-indigo-600 font-medium hover:underline">
                                Details →
                            </a>

                            @if($project->github_link)
                                <a href="{{ $project->github_link }}"
                                   target="_blank"
                                   class="text-gray-600 font-medium hover:text-indigo-600 transition">
                                    GitHub
                                </a>
                            @endif

                        </div>

                    </div>
                </div>

            @empty
                <div class="col-span-full text-center text-gray-500">
                    No projects added yet.
                </div>
            @endforelse

        </div>
    </div>
</section>


{{-- ================= FOOTER ================= --}}
<footer class="bg-gray-900 text-gray-400 py-10 text-center text-sm">
    © {{ date('Y') }} Kushal Ghimire. All rights reserved.
</footer>

@endsection