@extends('layouts.frontend')

@section('content')

{{-- ================= HERO ================= --}}
<section class="relative overflow-hidden bg-white py-28">

    <div class="max-w-5xl mx-auto px-6 text-center">

        {{-- Badge --}}
        <div class="inline-flex items-center px-5 py-2 rounded-full 
            bg-indigo-50 text-indigo-600 text-sm font-medium shadow-sm">
            🚀 Building Scalable Web Applications
        </div>

        {{-- Name --}}
        <h1 class="mt-8 text-5xl md:text-6xl font-extrabold text-gray-900 tracking-tight">
            Kushal Ghimire
        </h1>

        {{-- Title --}}
        <h2 class="mt-4 text-xl md:text-2xl text-indigo-600 font-semibold">
            Laravel Developer | Backend Specialist
        </h2>

        {{-- Description --}}
        <p class="mt-6 text-lg text-gray-600 max-w-3xl mx-auto leading-relaxed">
            I design and develop high-performance Laravel applications with
            clean architecture, secure authentication systems, and modern UI.
        </p>

        {{-- Main Buttons --}}
        <div class="mt-10 flex justify-center gap-6 flex-wrap">

            <a href="#projects"
               class="px-8 py-3 rounded-xl 
                      bg-indigo-600 text-white font-semibold 
                      shadow-lg hover:bg-indigo-700 
                      hover:shadow-xl transition duration-300">
                View My Work →
            </a>

            <a href="{{ route('resume.download') }}"
               class="px-8 py-3 rounded-xl 
                      border border-gray-300 
                      text-gray-800 font-medium
                      hover:border-indigo-600 hover:text-indigo-600
                      transition duration-300">
                Download Resume
            </a>

        </div>

        {{-- Social Icons --}}
        <div class="mt-8 flex justify-center gap-8">

            {{-- GitHub --}}
            <a href="https://github.com/Ghimire-Kushal"
               target="_blank"
               class="text-gray-700 hover:text-indigo-600 transition transform hover:scale-110">
                <svg xmlns="http://www.w3.org/2000/svg" 
                     class="w-7 h-7" 
                     fill="currentColor" 
                     viewBox="0 0 24 24">
                    <path d="M12 0C5.37 0 0 5.37 0 12c0 5.3 3.438 9.8 8.205 11.385.6.113.82-.258.82-.577 
                    0-.285-.01-1.04-.015-2.04-3.338.725-4.042-1.61-4.042-1.61-.546-1.387-1.333-1.756-1.333-1.756
                    -1.087-.744.083-.729.083-.729 1.205.084 1.84 1.237 1.84 1.237
                    1.07 1.835 2.807 1.305 3.492.998.108-.775.418-1.305.76-1.605
                    -2.665-.3-5.467-1.335-5.467-5.93
                    0-1.31.47-2.382 1.235-3.222-.135-.303-.54-1.523.105-3.176
                    0 0 1.005-.322 3.3 1.23.96-.267 1.98-.399 3-.405
                    1.02.006 2.04.138 3 .405
                    2.28-1.552 3.285-1.23 3.285-1.23.645 1.653.24 2.873.12 3.176
                    .765.84 1.23 1.912 1.23 3.222
                    0 4.61-2.805 5.625-5.475 5.92
                    .435.375.81 1.102.81 2.222
                    0 1.606-.015 2.896-.015 3.286
                    0 .315.21.69.825.57C20.565 21.795 24 17.295 24 12
                    24 5.37 18.63 0 12 0z"/>
                </svg>
            </a>

            {{-- LinkedIn --}}
            {{-- LinkedIn --}}
<a href="https://www.linkedin.com/in/kushal-ghimire-9448093b1/"
   target="_blank"
   class="text-gray-700 hover:text-indigo-600 transition transform hover:scale-110">

    <svg xmlns="http://www.w3.org/2000/svg"
         viewBox="0 0 24 24"
         fill="currentColor"
         class="w-7 h-7">

        <path d="M19 0h-14C2.239 0 0 2.239 0 5v14c0 
        2.761 2.239 5 5 5h14c2.761 0 5-2.239 
        5-5V5c0-2.761-2.239-5-5-5zM7.12 
        20.452H3.56V9h3.56v11.452zM5.34 
        7.433a2.063 2.063 0 1 1 0-4.125 
        2.063 2.063 0 0 1 0 4.125zM20.452 
        20.452h-3.56v-5.605c0-1.337-.027-3.057-1.863-3.057
        -1.864 0-2.15 1.454-2.15 2.957v5.705h-3.56V9h3.418v1.561h.049
        c.476-.9 1.637-1.863 3.37-1.863
        3.602 0 4.268 2.37 4.268 5.455v6.299z"/>

    </svg>

</a>

            {{-- Email --}}
            <a href="mailto:kushal.81318@apollointcollege.edu.np"
               class="text-gray-700 hover:text-indigo-600 transition transform hover:scale-110">
                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-7 h-7"
                     fill="currentColor"
                     viewBox="0 0 24 24">
                    <path d="M12 13.065l-11.985-7.065h23.97l-11.985 7.065zm0 2.435l-12-7v14h24v-14l-12 7z"/>
                </svg>
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

                    {{-- Image --}}
                   @if(!empty($project->image))
    <img 
        src="{{ asset('storage/' . $project->image) }}" 
        alt="{{ $project->title }}" 
        class="card-img-top"
        style="height:200px; width:100%; object-fit:cover;"
    >
@else
    <img 
        src="{{ asset('images/default.png') }}" 
        alt="No Image" 
        class="card-img-top"
        style="height:200px; width:100%; object-fit:cover;"
    >
@endif



                    <div class="p-6 flex flex-col flex-1">

                        {{-- Title --}}
                        <h3 class="text-xl font-semibold text-gray-900">
                            {{ $project->title }}
                        </h3>

                        {{-- Description --}}
                        <p class="text-gray-600 text-sm mt-3 flex-1">
                            {{ \Illuminate\Support\Str::limit($project->description, 110) }}
                        </p>

                        {{-- Tech Stack --}}
                        <div class="mt-4 flex flex-wrap gap-2 text-xs font-medium">
                            <span class="bg-indigo-100 text-indigo-600 px-3 py-1 rounded-full">Laravel</span>
                            <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full">MySQL</span>
                            <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full">Tailwind</span>
                        </div>

                        {{-- Buttons --}}
                        <div class="mt-6 flex gap-4">

                            <a href="{{ route('projects.show', $project->slug) }}"
                               class="text-indigo-600 font-medium hover:underline">
                                Details →
                            </a>

                            <a href="#"
                               class="text-gray-600 font-medium hover:text-indigo-600 transition">
                                GitHub
                            </a>

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