<x-app-layout>

    <div class="py-10">
        <div class="max-w-7xl mx-auto px-6">

            <div class="bg-white rounded-xl shadow p-8">

                <h1 class="text-3xl font-bold mb-8">
                    Admin Dashboard
                </h1>

                <div class="overflow-x-auto">

                    <table class="w-full border-collapse">

                        <thead>
                            <tr class="bg-gray-100">
                                <th class="p-3 text-left">Name</th>
                                <th class="p-3 text-left">Phone</th>
                                <th class="p-3 text-left">Occupation</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($members as $member)

                                <tr class="border-b">

                                    <td class="p-3">
                                        {{ $member->full_name }}
                                    </td>

                                    <td class="p-3">
                                        {{ $member->phone }}
                                    </td>

                                    <td class="p-3">
                                        {{ $member->occupation }}
                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

                <div class="mt-6">
                    {{ $members->links() }}
                </div>

            </div>

        </div>
    </div>

</x-app-layout>