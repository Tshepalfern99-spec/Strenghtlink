<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Comment</h2>
            <a href="{{ route('forum.show', $post) }}" class="text-sm text-indigo-700 hover:underline">← Back to post</a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('forum.comments.update', [$post, $comment]) }}"
                  class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
                @csrf @method('PUT')
                <label class="mb-1 block text-sm font-medium text-gray-700">Comment</label>
                <textarea name="body" rows="5" required
                          class="w-full rounded-md border-gray-300 focus:ring-indigo-500 focus:border-indigo-500">{{ old('body', $comment->body) }}</textarea>
                @error('body') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror

                <div class="mt-4 flex items-center gap-3">
                    <button class="inline-flex items-center gap-2 rounded-md bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-700">
                        Save
                    </button>
                    <a href="{{ route('forum.show', $post) }}" class="text-sm text-gray-600 hover:text-gray-800">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
