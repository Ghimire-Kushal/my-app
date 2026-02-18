@extends('layouts.frontend')

@section('content')

{{-- ================= HERO ================= --}}
<section class="relative overflow-hidden bg-white">

    {{-- Background --}}
    <div class="absolute inset-0 -z-10 pointer-events-none">
        <div class="absolute inset-0 opacity-40
            bg-[linear-gradient(to_right,#f3f4f6_1px,transparent_1px),
            linear-gradient(to_bottom,#f3f4f6_1px,transparent_1px)]
            bg-[size:40px_40px]">
        </div>

        <div class="absolute -top-40 left-1/2 -translate-x-1/2
            w-[800px] h-[500px]
            bg-gradient-to-r from-indigo-500/20 via-purple-500/20 to-blue-500/20
            blur-3xl rounded-full">
        </div>
    </div>

    <div class="relative z-10 max-w-5xl mx-auto px-6 pt-40 pb-32 text-center">

        <div class="inline-flex items-center px-4 py-2
            rounded-full bg-white border border-gray-200
            shadow-sm text-sm text-indigo-600 font-medium">
            🚀 Building Premium Web Experiences
        </div>

        <h1 class="mt-8 text-5xl md:text-6xl font-extrabold text-gray-900">
            Kushal Ghimire
        </h1>

        <h2 class="text-3xl md:text-4xl font-semibold mt-2
            bg-gradient-to-r from-indigo-600 via-purple-600 to-blue-500
            bg-clip-text text-transparent">
            Laravel Developer
        </h2>

        <p class="mt-6 text-lg md:text-xl text-gray-600 max-w-3xl mx-auto">
            I design and build scalable, high-performance web applications
            with clean architecture and modern UI experiences.
        </p>

        <div class="mt-10 flex justify-center gap-6 flex-wrap">

            <a href="#projects"
               class="px-8 py-3 rounded-xl bg-indigo-600 text-white font-semibold shadow-lg hover:bg-indigo-700 transition">
                View My Work →
            </a>

            <a href="{{ route('resume.download') }}"
               class="px-8 py-3 rounded-xl border border-gray-300
                      text-gray-700 font-medium
                      hover:border-indigo-600 hover:text-indigo-600
                      transition duration-300">
                Download Resume
            </a>

        </div>
    </div>

</section>


{{-- ================= PROJECTS SECTION ================= --}}
<section id="projects" class="py-24 bg-gray-50">
    <div class="max-w-6xl mx-auto px-6">

        <div class="text-center mb-14">
            <h2 class="text-3xl font-bold text-gray-900">
                Featured Projects
            </h2>
            <p class="text-gray-500 mt-3">
                A selection of my recent work
            </p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">

            @forelse($projects as $project)

                <div data-aos="fade-up"
                     class="bg-white rounded-2xl shadow-md 
                            hover:shadow-2xl transition duration-500 
                            overflow-hidden flex flex-col group">

                    {{-- ⭐ Featured Badge --}}
                    @if($loop->first)
                        <div class="absolute bg-indigo-600 text-white text-xs px-3 py-1 rounded-br-xl">
                            ⭐ Featured
                        </div>
                    @endif

                    {{-- Image with Hover Zoom --}}
                    @if($project->image)
                        <div class="h-48 overflow-hidden">
                            <img src="{{ asset('storage/'.$project->image) }}"
                                 class="w-full h-full object-cover 
                                        transition duration-500 
                                        group-hover:scale-110">
                        </div>
                    @else
                        <div class="h-48 bg-gray-200 flex items-center justify-center text-gray-400">
                            No Image
                        </div>
                    @endif

                    {{-- Content --}}
                    <div class="p-6 flex flex-col flex-1">

                        <h3 class="text-xl font-semibold text-gray-900 mb-3">
                            {{ $project->title }}
                        </h3>

                        <p class="text-gray-600 text-sm flex-1">
                            {{ \Illuminate\Support\Str::limit($project->description, 100) }}
                        </p>

                        {{-- 🔗 Single Project Page --}}
                        <a href="{{ route('projects.show', $project->slug)}}"
   class="mt-6 inline-flex items-center text-indigo-600 font-medium hover:underline">
    View Details →
</a>

                    </div>

                </div>

            @empty
                <div class="col-span-3 text-center text-gray-500">
                    No projects added yet.
                </div>
            @endforelse

        </div>

    </div>
</section>


{{-- ================= TECH STACK ================= --}}
<section class="py-28 bg-white">
    <div class="max-w-5xl mx-auto px-6 text-center">

        <h2 class="text-4xl font-bold text-gray-900">
            Tech Stack
        </h2>

        <div class="mt-16 grid grid-cols-2 md:grid-cols-4 gap-8">
            @foreach (['Laravel', 'PHP', 'JavaScript', 'MySQL'] as $skill)
                <div class="bg-gray-50 border border-gray-200 rounded-2xl py-8
                            font-medium text-gray-700
                            hover:bg-white hover:shadow-lg hover:border-indigo-400
                            transition duration-300">
                    {{ $skill }}
                </div>
            @endforeach
        </div>

    </div>
</section>


{{-- ================= CTA ================= --}}
<section class="py-24 bg-gradient-to-r from-indigo-600 to-purple-600">
    <div class="max-w-4xl mx-auto px-6 text-center text-white">

        <h2 class="text-4xl font-bold">
            Ready to Build Something Amazing?
        </h2>

        <a href="/contact"
           class="inline-flex items-center justify-center mt-10
                  px-10 py-4 bg-white text-indigo-600
                  rounded-xl font-semibold
                  shadow-xl hover:shadow-2xl hover:scale-105
                  transition duration-300">
            Let’s Talk
        </a>

    </div>
</section>


{{-- ================= FOOTER ================= --}}
<footer class="bg-gray-900 text-gray-400 py-10 text-center text-sm">
    © {{ date('Y') }} Kushal Ghimire. All rights reserved.
</footer>

@endsection