@extends('layouts.admin')


@section('content')

<h1 class="text-3xl font-bold mb-6">
    Dashboard
</h1>

<div class="grid md:grid-cols-3 gap-6">

    <div class="bg-white p-6 rounded-lg shadow">
        <p class="text-gray-500 text-sm">Total Projects</p>
        <p class="text-2xl font-bold mt-2">
            {{ \App\Models\Project::count() }}
        </p>
    </div>

</div>

@endsection