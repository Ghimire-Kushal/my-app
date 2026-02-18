<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | FRONTEND - Show All Projects
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $projects = Project::latest()->paginate(9); // Better than get()

        return view('projects.index', compact('projects'));
    }

    /*
    |--------------------------------------------------------------------------
    | FRONTEND - Show Single Project (Slug Based)
    |--------------------------------------------------------------------------
    */

    public function show(Project $project)
    {
        $relatedProjects = Project::where('id', '!=', $project->id)
            ->latest()
            ->take(3)
            ->get();

        return view('projects.show', compact('project', 'relatedProjects'));
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN - List Projects
    |--------------------------------------------------------------------------
    */

    public function adminIndex()
    {
        $projects = Project::latest()->paginate(10);

        return view('admin.projects.index', compact('projects'));
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN - Create Form
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        return view('admin.projects.create');
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN - Store Project
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255|unique:projects,title',
            'description' => 'required|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Generate unique slug
        $validated['slug'] = Str::slug($validated['title']);

        // If slug exists, make it unique
        if (Project::where('slug', $validated['slug'])->exists()) {
            $validated['slug'] .= '-' . time();
        }

        // Upload image
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')
                ->store('projects', 'public');
        }

        Project::create($validated);

        return redirect()
            ->route('admin.projects.index')
            ->with('success', 'Project created successfully!');
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN - Edit Form
    |--------------------------------------------------------------------------
    */

    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN - Update Project
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255|unique:projects,title,' . $project->id,
            'description' => 'required|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Only regenerate slug if title changed
        if ($project->title !== $validated['title']) {

            $slug = Str::slug($validated['title']);

            if (Project::where('slug', $slug)
                ->where('id', '!=', $project->id)
                ->exists()) {
                $slug .= '-' . time();
            }

            $validated['slug'] = $slug;
        }

        // Replace image if uploaded
        if ($request->hasFile('image')) {

            // Delete old image
            if ($project->image && Storage::disk('public')->exists($project->image)) {
                Storage::disk('public')->delete($project->image);
            }

            $validated['image'] = $request->file('image')
                ->store('projects', 'public');
        }

        $project->update($validated);

        return redirect()
            ->route('admin.projects.index')
            ->with('success', 'Project updated successfully!');
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN - Delete Project
    |--------------------------------------------------------------------------
    */

    public function destroy(Project $project)
    {
        if ($project->image && Storage::disk('public')->exists($project->image)) {
            Storage::disk('public')->delete($project->image);
        }

        $project->delete();

        return redirect()
            ->route('admin.projects.index')
            ->with('success', 'Project deleted successfully!');
    }
}