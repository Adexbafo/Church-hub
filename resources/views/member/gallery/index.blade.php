<x-app-layout>

    <div class="py-10">

        <div class="max-w-7xl mx-auto px-4">

            <h1 class="text-3xl font-bold">
                Church Gallery
            </h1>

            <p class="text-gray-500 mt-2 mb-8">
                Browse photos and videos from church programmes.
            </p>

            @if($galleries->isNotEmpty())

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                @foreach($galleries as $gallery)

                <div class="bg-white rounded-2xl shadow overflow-hidden">

                    @if($gallery->media_type === 'image')

                    <a
                        href="{{ route('member.gallery.show', $gallery) }}"
                        class="block">

                        <img
                            src="{{ asset('storage/'.$gallery->file_path) }}"
                            alt="{{ $gallery->title }}"
                            class="w-full h-56 object-cover">

                    </a>

                    @else

                    <a
                        href="{{ route('member.gallery.show', $gallery) }}"
                        class="block">

                        <video
                            muted
                            preload="metadata"
                            playsinline
                            class="w-full h-56 object-cover">

                            <source
                                src="{{ asset('storage/'.$gallery->file_path) }}">

                        </video>

                    </a>

                    @endif

                    <div class="p-5">

                        <div class="flex justify-between items-start gap-4">

                            <h2 class="text-lg font-semibold">

                                <a
                                    href="{{ route('member.gallery.show', $gallery) }}"
                                    class="hover:text-blue-600">

                                    {{ $gallery->title }}

                                </a>

                            </h2>

                            @if($gallery->is_featured)

                            <span class="text-xs px-2 py-1 rounded-full bg-yellow-100 text-yellow-700">
                                ⭐ Featured
                            </span>

                            @endif

                        </div>

                        @if($gallery->album)

                        <p class="text-sm text-blue-600 mt-2">
                            📁 {{ $gallery->album }}
                        </p>

                        @endif

                        <p class="text-gray-600 mt-3 line-clamp-2">
                            {{ $gallery->description }}
                        </p>

                        <a
                            href="{{ route('member.gallery.show', $gallery) }}"
                            class="inline-flex mt-5 rounded-lg bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">

                            View Media

                        </a>

                    </div>

                </div>

                @endforeach

            </div>

            <div class="mt-8">

                {{ $galleries->links() }}

            </div>

            @else

            <div class="bg-white rounded-2xl shadow p-12 text-center">

                <div class="text-6xl mb-4">
                    🖼️
                </div>

                <h2 class="text-2xl font-bold">
                    No Gallery Media
                </h2>

                <p class="mt-2 text-gray-500">
                    Church media will appear here once uploaded.
                </p>

            </div>

            @endif

        </div>

    </div>

</x-app-layout>