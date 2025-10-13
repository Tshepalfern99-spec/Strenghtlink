<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Resource;
use App\Models\ResourceCategory;
use Illuminate\Http\Request;

class ResourceController extends Controller
{
    public function index(Request $request)
    {
        $filters = $request->only(['q','category_id','city','province']);

        $categories = ResourceCategory::orderBy('name')->get();
        $resources = Resource::with('category')
            ->filter($filters)
            ->orderBy('name')
            ->paginate(15)
            ->withQueryString();

        return view('admin.resources.index', compact('resources','categories','filters'));
    }

    public function create()
    {
        $categories = ResourceCategory::orderBy('name')->get();
        return view('admin.resources.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'resource_category_id' => ['required','exists:resource_categories,id'],
            'name'         => ['required','string','max:160'],
            'phone'        => ['nullable','string','max:40'],
            'email'        => ['nullable','email','max:160'],
            'website'      => ['nullable','string','max:255'],
            'address'      => ['nullable','string','max:255'],
            'city'         => ['nullable','string','max:120'],
            'province'     => ['nullable','string','max:120'],
            'postal_code'  => ['nullable','string','max:20'],
            'is_active'    => ['sometimes','boolean'],
        ]);
        $data['is_active'] = (bool) ($data['is_active'] ?? true);

        Resource::create($data);

        return redirect()->route('admin.resources.index')->with('status','Resource created.');
    }

    public function show(Resource $resource)
    {
        return view('admin.resources.show', compact('resource'));
    }

    public function edit(Resource $resource)
    {
        $categories = ResourceCategory::orderBy('name')->get();
        return view('admin.resources.edit', compact('resource','categories'));
    }

    public function update(Request $request, Resource $resource)
    {
        $data = $request->validate([
            'resource_category_id' => ['required','exists:resource_categories,id'],
            'name'         => ['required','string','max:160'],
            'phone'        => ['nullable','string','max:40'],
            'email'        => ['nullable','email','max:160'],
            'website'      => ['nullable','string','max:255'],
            'address'      => ['nullable','string','max:255'],
            'city'         => ['nullable','string','max:120'],
            'province'     => ['nullable','string','max:120'],
            'postal_code'  => ['nullable','string','max:20'],
            'is_active'    => ['sometimes','boolean'],
        ]);
        $data['is_active'] = (bool) ($data['is_active'] ?? false);

        $resource->update($data);

        return redirect()->route('admin.resources.index')->with('status','Resource updated.');
    }

    public function destroy(Resource $resource)
    {
        $resource->delete();
        return redirect()->route('admin.resources.index')->with('status','Resource deleted.');
    }
}
