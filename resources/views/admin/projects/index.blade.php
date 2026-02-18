@extends('layouts.frontend')

@section('content')

<section class="py-24 bg-gray-50 min-h-screen">
    <div class="max-w-6xl mx-auto px-6">

        <!-- ================= HEADER ================= -->
        <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-6 mb-12">
            <h2 class="text-3xl font-bold text-gray-900">
                Manage Projects
            </h2>

            @auth
                <a href="{{ route('admin.projects.create') }}"
                   class="inline-flex items-center gap-2 px-6 py-3
                          bg-indigo-600 text-white rounded-xl
                          hover:bg-indigo-700 transition shadow-md font-medium">
                    ➕ Add New Project
                </a>
            @endauth
        </div>

        <!-- ================= CARD CONTAINER ================= -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100">

            @if($projects->count())

                <div class="overflow-x-auto">
                    <table class="w-full text-left">

                        <!-- TABLE HEAD -->
                        <thead class="bg-gray-100 border-b text-sm uppercase tracking-wide">
                            <tr>
                                <th class="p-5 font-semibold text-gray-600">Title</th>
                                <th class="p-5 font-semibold text-gray-600">Description</th>
                                <th class="p-5 font-semibold text-gray-600 w-56 text-center">
                                    Actions
                                </th>
                            </tr>
                        </thead>

                        <!-- TABLE BODY -->
                        <tbody class="divide-y divide-gray-100">

                            @foreach($projects as $project)
                                <tr class="hover:bg-gray-50 transition duration-200">

                                    <!-- TITLE -->
                                    <td class="p-5 font-semibold text-gray-900">
                                        {{ $project->title }}
                                    </td>

                                    <!-- DESCRIPTION -->
                                    <td class="p-5 text-gray-600">
                                        {{ \Illuminate\Support\Str::limit($project->description, 100) }}
                                    </td>

                                    <!-- ACTIONS -->
                                    <td class="p-5">
                                        @auth
                                            <div class="flex justify-center items-center gap-3">

                                                <!-- EDIT BUTTON -->
                                                <a href="{{ route('admin.projects.edit', $project->id) }}"
                                                   class="inline-flex items-center gap-2 px-4 py-2
                                                          bg-amber-100 text-amber-700
                                                          rounded-lg text-sm font-medium
                                                          hover:bg-amber-200 transition duration-200">

                                                    ✏ Edit
                                                </a>

                                                <!-- DELETE BUTTON -->
                                                <form action="{{ route('admin.projects.destroy', $project->id) }}"
                                                      method="POST">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit"
                                                            onclick="return confirm('Are you sure you want to delete this project?')"
                                                            class="inline-flex items-center gap-2 px-4 py-2
                                                                   bg-red-100 text-red-600
                                                                   rounded-lg text-sm font-medium
                                                                   hover:bg-red-200 transition duration-200">

                                                        🗑 Delete
                                                    </button>
                                                </form>

                                            </div>
                                        @endauth
                                    </td>

                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>

            @else

                <!-- ================= EMPTY STATE ================= -->
                <div class="p-16 text-center">

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

    </div>
</section>

@endsection