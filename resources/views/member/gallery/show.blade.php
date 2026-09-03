<x-app-layout>

    <div class="py-10">

        <div class="max-w-5xl mx-auto px-4">

            <!-- Back Button -->

            <a
                href="{{ route('member.gallery.index') }}"
                class="inline-flex items-center text-blue-600 hover:text-blue-800 mb-6">

                ← Back to Gallery

            </a>

            <!-- Media -->

            <div class="bg-white rounded-2xl shadow overflow-hidden">

                @if($gallery->media_type === 'image')

                <img
                    src="{{ asset('storage/'.$gallery->file_path) }}"
                    alt="{{ $gallery->title }}"
                    class="w-full max-h-[650px] object-contain bg-black">

                @else

                <video
                    controls
                    class="w-full bg-black">

                    <source
                        src="{{ asset('storage/'.$gallery->file_path) }}">

                </video>

                @endif

            </div>

            <!-- Information -->

            <div class="bg-white rounded-2xl shadow mt-6 p-8">

                <h1 class="text-3xl font-bold">

                    {{ $gallery->title }}

                </h1>

                <div class="mt-3 flex flex-wrap gap-3">

                    @if($gallery->is_featured)

                    <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs">

                        ⭐ Featured

                    </span>

                    @endif

                    @if($gallery->media_type === 'image')

                    <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs">

                        📷 Image

                    </span>

                    @else

                    <span class="bg-purple-100 text-purple-700 px-3 py-1 rounded-full text-xs">

                        🎥 Video

                    </span>

                    @endif

                </div>

                @if($gallery->album)

                <p class="text-blue-600 mt-2">

                    📁 {{ $gallery->album }}

                </p>

                @endif

                @if($gallery->description)

                <p class="mt-6 text-gray-700 leading-8">

                    {{ $gallery->description }}

                </p>

                @endif

            </div>

            <!-- Details -->

            <div class="grid md:grid-cols-3 gap-6 mt-8">

                <div class="bg-white rounded-xl shadow p-5">

                    <p class="text-sm text-gray-500">

                        Uploaded On

                    </p>

                    <p class="font-semibold mt-2">

                        {{ $gallery->created_at->format('F d, Y') }}

                    </p>

                </div>

                <div class="bg-white rounded-xl shadow p-5">

                    <p class="text-sm text-gray-500">

                        Album

                    </p>

                    <p class="font-semibold mt-2">

                        {{ $gallery->album ?? 'General' }}

                    </p>

                </div>

            </div>

            <!-- Previous / Next -->

            <div class="flex justify-between mt-10">

                @if($previous)

                <a
                    href="{{ route('member.gallery.show', $previous) }}"
                    class="px-4 py-2 rounded-lg border hover:bg-gray-100">

                    ← Previous

                </a>

                @else

                <div></div>

                @endif

                @if($next)

                <a
                    href="{{ route('member.gallery.show', $next) }}"
                    class="px-4 py-2 rounded-lg border hover:bg-gray-100">

                    Next →

                </a>

                @endif

            </div>

        </div>

    </div>

</x-app-layout>