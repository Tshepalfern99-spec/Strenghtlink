<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ResourceCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ResourceCategoryController extends Controller
{
    public function index()
    {
        $categories = ResourceCategory::withCount('resources')
            ->orderBy('name')->paginate(15);

        return view('admin.resource_categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.resource_categories.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required','string','max:80'],
        ]);
        $data['slug'] = Str::slug($data['name']);

        ResourceCategory::create($data);

        return redirect()->route('admin.resource-categories.index')->with('status','Category created.');
    }

    public function edit(ResourceCategory $resource_category)
    {
        return view('admin.resource_categories.edit', ['category' => $resource_category]);
    }

    public function update(Request $request, ResourceCategory $resource_category)
    {
        $data = $request->validate([
            'name' => ['required','string','max:80'],
        ]);
        $data['slug'] = Str::slug($data['name']);

        $resource_category->update($data);

        return redirect()->route('admin.resource-categories.index')->with('status','Category updated.');
    }

    public function destroy(ResourceCategory $resource_category)
    {
        $resource_category->delete(); // cascades to resources via FK if set
        return redirect()->route('admin.resource-categories.index')->with('status','Category deleted.');
    }
}
