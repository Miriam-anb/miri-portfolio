<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    public function index()
    {
        return view('admin.projects.index', ['projects' => Project::orderBy('position')->get()]);
    }

    public function create()
    {
        return view('admin.projects.edit', ['project' => new Project()]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['slug'] = $data['slug'] ?: Str::slug($data['title']);
        $data['workflow_steps'] = $this->parseSteps($request->input('workflow_steps_raw', ''));

        if ($request->hasFile('image')) {
            $data['image'] = '/storage/' . $request->file('image')->store('uploads', 'public');
        }

        Project::create($data);

        return redirect()->route('admin.projects.index')->with('status', 'Projet ajouté.');
    }

    public function edit(Project $project)
    {
        return view('admin.projects.edit', ['project' => $project]);
    }

    public function update(Request $request, Project $project)
    {
        $data = $this->validated($request);
        $data['slug'] = $data['slug'] ?: Str::slug($data['title']);
        $data['workflow_steps'] = $this->parseSteps($request->input('workflow_steps_raw', ''));

        if ($request->hasFile('image')) {
            $data['image'] = '/storage/' . $request->file('image')->store('uploads', 'public');
        }

        $project->update($data);

        return redirect()->route('admin.projects.index')->with('status', 'Projet mis à jour.');
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return back()->with('status', 'Projet supprimé.');
    }

    protected function validated(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'summary' => ['required', 'string', 'max:500'],
            'description' => ['nullable', 'string'],
            'tech_stack' => ['nullable', 'string', 'max:255'],
            'featured' => ['nullable', 'boolean'],
            'position' => ['nullable', 'integer'],
        ]);
    }

    protected function parseSteps(string $raw): ?array
    {
        $lines = array_filter(array_map('trim', explode("\n", $raw)));
        return count($lines) ? array_values($lines) : null;
    }
}
