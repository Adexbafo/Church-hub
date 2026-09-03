<x-app-layout>

    <div class="py-10">
        <div class="max-w-7xl mx-auto px-6">

            <h1 class="text-3xl font-bold mb-6">
                Audit Logs
            </h1>

            <div class="bg-white rounded-2xl shadow p-6 mb-6">

                <form method="GET">

                    <div class="grid md:grid-cols-4 gap-4">

                        <div>
                            <label class="block text-sm font-medium mb-2">
                                User
                            </label>

                            <input
                                type="text"
                                name="user"
                                value="{{ request('user') }}"
                                class="w-full rounded-lg border-gray-300"
                                placeholder="Search user">
                        </div>

                        <div>

                            <label class="block text-sm font-medium mb-2">
                                Action
                            </label>

                            <select
                                name="action"
                                class="w-full rounded-lg border-gray-300">

                                <option value="">All</option>

                                <option
                                    value="create"
                                    @selected(request('action')=='create' )>
                                    Create
                                </option>

                                <option
                                    value="update"
                                    @selected(request('action')=='update' )>
                                    Update
                                </option>

                                <option
                                    value="delete"
                                    @selected(request('action')=='delete' )>
                                    Delete
                                </option>

                            </select>

                        </div>

                        <div>

                            <label class="block text-sm font-medium mb-2">
                                From
                            </label>

                            <input
                                type="date"
                                name="from"
                                value="{{ request('from') }}"
                                class="w-full rounded-lg border-gray-300">

                        </div>

                        <div>

                            <label class="block text-sm font-medium mb-2">
                                To
                            </label>

                            <input
                                type="date"
                                name="to"
                                value="{{ request('to') }}"
                                class="w-full rounded-lg border-gray-300">

                        </div>

                    </div>

                    <div class="mt-4 flex gap-3">

                        <button
                            class="bg-blue-600 text-white px-5 py-2 rounded-lg">

                            Filter

                        </button>

                        <a
                            href="{{ route('admin.audit-logs.index') }}"
                            class="px-5 py-2 border rounded-lg">

                            Reset

                        </a>

                    </div>

                </form>

            </div>

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
                                <span class="
                                    px-3 py-1 rounded-full text-xs font-semibold

                                    @if($log->action === 'create')
                                        bg-green-100 text-green-700
                                    @elseif($log->action === 'update')
                                        bg-blue-100 text-blue-700
                                    @elseif($log->action === 'delete')
                                        bg-red-100 text-red-700
                                    @else
                                        bg-gray-100 text-gray-700
                                    @endif">
                                    {{ ucfirst($log->action) }}
                                </span>
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