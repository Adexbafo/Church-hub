<x-app-layout>

    <div class="max-w-4xl mx-auto py-10 px-6">

        <div class="bg-white rounded-xl shadow p-8">

            <h1 class="text-3xl font-bold">

                {{ $notification->title }}

            </h1>

            <div class="text-gray-500 mt-2">

                {{ optional($notification->published_at)->format('F d, Y') }}

            </div>

            <hr class="my-6">

            <div class="prose max-w-none">

                {!! nl2br(e($notification->message)) !!}

            </div>

        </div>

    </div>

</x-app-layout>