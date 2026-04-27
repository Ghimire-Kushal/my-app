<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class ProjectController extends Controller
{
    /* ================= FRONTEND ================= */

    public function index()
    {
        $projects = Project::latest()->paginate(9);
        return view('projects.index', compact('projects'));
    }

    public function show(Project $project)
    {
        $relatedProjects = Project::where('id', '!=', $project->id)
            ->latest()
            ->take(3)
            ->get();

        return view('projects.show', compact('project', 'relatedProjects'));
    }

    /* ================= ADMIN ================= */

    public function adminIndex()
    {
        $projects = Project::latest()->paginate(10);
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.projects.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255|unique:projects,title',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        // ✅ Generate slug
        $slug = Str::slug($validated['title']);
        if (Project::where('slug', $slug)->exists()) {
            $slug .= '-' . time();
        }
        $validated['slug'] = $slug;

        // ✅ Upload image to Cloudinary
        if ($request->hasFile('image')) {

            $upload = Cloudinary::upload(
                $request->file('image')->getRealPath()
            );

            $validated['image'] = $upload->getSecurePath(); // ✅ FIXED
        }

        Project::create($validated);

        return redirect()
            ->route('admin.projects.index')
            ->with('success', 'Project created successfully!');
    }

    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255|unique:projects,title,' . $project->id,
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        // ✅ Update slug if title changed
        if ($project->title !== $validated['title']) {
            $slug = Str::slug($validated['title']);

            if (Project::where('slug', $slug)
                ->where('id', '!=', $project->id)
                ->exists()) {
                $slug .= '-' . time();
            }

            $validated['slug'] = $slug;
        }

        // ✅ Upload new image (ONLY if new file selected)
        if ($request->hasFile('image')) {

            $upload = Cloudinary::upload(
                $request->file('image')->getRealPath()
            );

            $validated['image'] = $upload->getSecurePath(); // ✅ FIXED
        }

        $project->update($validated);

        return redirect()
            ->route('admin.projects.index')
            ->with('success', 'Project updated successfully!');
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()
            ->route('admin.projects.index')
            ->with('success', 'Project deleted successfully!');
    }
}