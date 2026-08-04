@php
use Illuminate\Support\Str;
@endphp
<x-app-layout>

    <div class="py-10">

        <div class="max-w-7xl mx-auto px-4">

            <div class="flex items-center justify-between mb-8">

                <div>

                    <h1 class="text-3xl font-bold">
                        Gallery Management
                    </h1>

                    <p class="text-gray-500 mt-2">
                        Manage church photos and videos.
                    </p>

                </div>

                <a
                    href="{{ route('admin.galleries.create') }}"
                    class="rounded-lg bg-blue-600 px-5 py-2 text-white hover:bg-blue-700">

                    Upload Media

                </a>

            </div>

            @if(session('success'))

            <div class="mb-6 rounded-lg bg-green-100 border border-green-300 p-4 text-green-700">
                {{ session('success') }}
            </div>

            @endif

            <div class="bg-white rounded-xl shadow p-6 mb-8">

                <h2 class="text-gray-500 text-sm">
                    Total Media
                </h2>

                <p class="text-4xl font-bold text-blue-600 mt-2">
                    {{ $totalMedia }}
                </p>

            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">

                @forelse($galleries as $gallery)

                <div class="bg-white rounded-xl shadow overflow-hidden">

                    @if($gallery->media_type === 'image')

                    <img
                        src="{{ asset('storage/'.$gallery->file_path) }}"
                        alt="{{ $gallery->title }}"
                        class="w-full h-56 object-cover">

                    @else

                    <video
                        controls
                        class="w-full h-56 object-cover">

                        <source
                            src="{{ asset('storage/'.$gallery->file_path) }}">

                    </video>

                    @endif

                    <div class="p-5">

                        <h3 class="text-lg font-semibold">
                            {{ $gallery->title }}
                        </h3>

                        @if($gallery->album)

                        <p class="text-sm text-blue-600 mt-1">
                            📁 {{ $gallery->album }}
                        </p>

                        @endif

                        <p class="text-gray-600 text-sm mt-3">
                            {{ Str::limit($gallery->description, 100) }}
                        </p>

                        <div class="flex justify-between mt-6">

                            <a
                                href="{{ route('admin.galleries.edit', $gallery) }}"
                                class="px-4 py-2 rounded-lg bg-yellow-500 text-white hover:bg-yellow-600">

                                Edit

                            </a>

                            <form
                                action="{{ route('admin.galleries.destroy', $gallery) }}"
                                method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this media?');">

                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="px-4 py-2 rounded-lg bg-red-600 text-white hover:bg-red-700">

                                    Delete

                                </button>

                            </form>

                        </div>
                    </div>

                </div>

                @empty

                <div class="col-span-full">

                    <div class="rounded-xl bg-white shadow p-12 text-center">

                        <div class="text-6xl mb-4">
                            🖼️
                        </div>

                        <h2 class="text-2xl font-bold">
                            No Media Yet
                        </h2>

                        <p class="text-gray-500 mt-2">
                            Upload your first gallery photo or video.
                        </p>

                    </div>

                </div>

                @endforelse

            </div>

            @if($galleries->hasPages())

            <div class="mt-8">

                {{ $galleries->links() }}

            </div>

            @endif

        </div>

    </div>

</x-app-layout>