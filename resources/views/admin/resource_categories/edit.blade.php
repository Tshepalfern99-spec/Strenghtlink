@include('admin.resource_categories._form', ['title' => 'Edit Category', 'action' => route('admin.resource-categories.update', $category), 'method' => 'PUT', 'category' => $category])
`