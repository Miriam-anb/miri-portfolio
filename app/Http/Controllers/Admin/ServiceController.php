<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        return view('admin.services.index', ['services' => Service::orderBy('position')->get()]);
    }

    public function create()
    {
        return view('admin.services.edit', ['service' => new Service()]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        Service::create($data);

        return redirect()->route('admin.services.index')->with('status', 'Service ajouté.');
    }

    public function edit(Service $service)
    {
        return view('admin.services.edit', ['service' => $service]);
    }

    public function update(Request $request, Service $service)
    {
        $service->update($this->validated($request));

        return redirect()->route('admin.services.index')->with('status', 'Service mis à jour.');
    }

    public function destroy(Service $service)
    {
        $service->delete();

        return back()->with('status', 'Service supprimé.');
    }

    protected function validated(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'icon' => ['nullable', 'string', 'max:100'],
            'position' => ['nullable', 'integer'],
        ]);
    }
}
