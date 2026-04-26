@extends('layouts.frontend')

@section('content')

<section class="py-24 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-6">

        {{-- ================= HEADER ================= --}}
        <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-6 mb-12">

            <div>
                <h2 class="text-3xl font-bold text-gray-900">
                    Manage Projects
                </h2>
                <p class="text-gray-500 mt-2">
                    Create, edit and manage your portfolio projects.
                </p>
            </div>

            @auth
                <a href="{{ route('admin.projects.create') }}"
                   class="inline-flex items-center gap-2 px-6 py-3
                          bg-indigo-600 text-white rounded-xl
                          hover:bg-indigo-700 transition shadow-md font-medium">
                    ➕ Add New Project
                </a>
            @endauth
        </div>

        {{-- ================= PROJECT GRID ================= --}}
        @if($projects->count())

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">

                @foreach($projects as $project)

                    <div class="group bg-white rounded-2xl shadow-sm hover:shadow-xl
                                transition duration-300 overflow-hidden border border-gray-100">

                        {{-- ================= IMAGE ================= --}}
                        <div class="overflow-hidden relative">

                            @if(!empty($project->image))
                                <img 
                                    src="{{ $project->image }}" 
                                    alt="{{ $project->title }}"
                                    class="w-full h-56 object-cover group-hover:scale-110 transition duration-500"
                                >
                            @else
                                <div class="w-full h-56 bg-gray-100 flex items-center justify-center text-gray-400">
                                    No Image
                                </div>
                            @endif

                            {{-- ================= OVERLAY ================= --}}
                            <div class="absolute inset-0 bg-black/40 opacity-0
                                        group-hover:opacity-100 transition duration-300
                                        flex items-center justify-center gap-4">

                                <a href="{{ route('admin.projects.edit', $project) }}"
                                   class="px-4 py-2 bg-white text-gray-900 rounded-lg text-sm font-medium hover:bg-gray-100 transition">
                                    ✏ Edit
                                </a>

                                <form action="{{ route('admin.projects.destroy', $project) }}"
                                      method="POST"
                                      onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="px-4 py-2 bg-red-600 text-white rounded-lg text-sm font-medium hover:bg-red-700 transition">
                                        🗑 Delete
                                    </button>
                                </form>

                            </div>
                        </div>

                        {{-- ================= CONTENT ================= --}}
                        <div class="p-6">

                            <h3 class="text-lg font-semibold text-gray-900 mb-2 group-hover:text-indigo-600 transition">
                                {{ $project->title }}
                            </h3>

                            <p class="text-gray-500 text-sm leading-relaxed">
                                {{ \Illuminate\Support\Str::limit($project->description, 90) }}
                            </p>

                        </div>

                    </div>

                @endforeach

            </div>

            {{-- ================= PAGINATION ================= --}}
            <div class="mt-12">
                {{ $projects->links() }}
            </div>

        @else

            {{-- ================= EMPTY STATE ================= --}}
            <div class="bg-white rounded-2xl shadow-sm p-16 text-center border border-gray-100">

                <h3 class="text-xl font-semibold text-gray-700 mb-3">
                    No Projects Found
                </h3>

                <p class="text-gray-500 mb-8">
                    Start by creating your first project to showcase your work.
                </p>

                @auth
                    <a href="{{ route('admin.projects.create') }}"
                       class="inline-flex items-center gap-2 px-6 py-3
                              bg-indigo-600 text-white rounded-xl
                              hover:bg-indigo-700 transition shadow-md font-medium">
                        ➕ Add First Project
                    </a>
                @endauth

            </div>

        @endif

    </div>
</section>

@endsection