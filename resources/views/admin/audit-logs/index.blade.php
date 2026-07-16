<x-app-layout>

    <div class="py-10">
        <div class="max-w-7xl mx-auto px-6">

            <h1 class="text-3xl font-bold mb-6">
                Audit Logs
            </h1>

            <div class="bg-white rounded-2xl shadow overflow-hidden">

                <table class="w-full">

                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-4 text-left">
                                Date
                            </th>

                            <th class="p-4 text-left">
                                User
                            </th>

                            <th class="p-4 text-left">
                                Action
                            </th>

                            <th class="p-4 text-left">
                                Description
                            </th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse ($logs as $log)

                        <tr class="border-t">

                            <td class="p-4">
                                {{ $log->created_at->format('M d, Y H:i') }}
                            </td>

                            <td class="p-4">
                                {{ $log->user?->name ?? 'System' }}
                            </td>

                            <td class="p-4">
                                {{ ucfirst($log->action) }}
                            </td>

                            <td class="p-4">
                                {{ $log->description }}
                            </td>

                        </tr>

                        @empty

                        <tr>
                            <td colspan="4"
                                class="p-6 text-center">

                                No audit logs found.

                            </td>
                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            <div class="mt-6">
                {{ $logs->links() }}
            </div>

        </div>
    </div>

</x-app-layout>