<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Resource;
use App\Models\ResourceCategory;
use Illuminate\Http\Request;

class ResourceBrowseController extends Controller
{
    public function index(Request $request)
    {
        $filters = [
            'q'           => trim((string) $request->get('q', '')),
            'category_id' => $request->get('category_id'),
        ];

        $categories = ResourceCategory::orderBy('name')->get();

        $resources = Resource::with('category')
            ->where('is_active', true)
            ->when($filters['q'], function ($q) use ($filters) {
                $term = $filters['q'];
                $q->where(function ($qq) use ($term) {
                    $qq->where('name', 'like', "%{$term}%");
                });
            })
            ->when($filters['category_id'], fn($q) => $q->where('resource_category_id', $filters['category_id']))
            ->orderBy('name')
            ->paginate(12)
            ->withQueryString();

        return view('resources.index', compact('resources','categories','filters'));
    }

    public function show(Resource $resource)
    {
        abort_if(!$resource->is_active, 404);
        $resource->load('category');

        return view('resources.show', compact('resource'));
    }
}
