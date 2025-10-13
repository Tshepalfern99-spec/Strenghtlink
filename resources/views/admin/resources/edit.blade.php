@include('admin.resources._form', ['title' => 'Edit Resource', 'action' => route('admin.resources.update', $resource), 'method' => 'PUT', 'resource' => $resource])
