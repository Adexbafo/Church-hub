<x-app-layout>

    <div class="py-10">

        <div class="max-w-7xl mx-auto px-6">

            <div class="flex justify-between items-center mb-8">

                <div>
                    <h1 class="text-3xl font-bold">
                        Donations
                    </h1>

                    <p class="text-gray-500 mt-2">
                        Manage church donations and offerings.
                    </p>
                </div>

                <a href="{{ route('admin.donations.create') }}"
                    class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-lg">

                    + Record Donation

                </a>

            </div>

            <div class="bg-white rounded-2xl shadow overflow-hidden">

                <table class="min-w-full">

                    <thead class="bg-gray-50">

                        <tr>
                            <th class="px-6 py-4 text-left">Date</th>
                            <th class="px-6 py-4 text-left">Donor</th>
                            <th class="px-6 py-4 text-left">Category</th>
                            <th class="px-6 py-4 text-left">Amount</th>
                            <th class="px-6 py-4 text-left">Actions</th>
                        </tr>

                    </thead>

                    <tbody>

                        @forelse ($donations as $donation)

                        <tr class="border-t">

                            <td class="px-6 py-4">
                                {{ $donation->created_at->format('M d, Y') }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $donation->donor_name }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $donation->fundCategory->name ?? '-' }}
                            </td>

                            <td class="px-6 py-4 font-semibold text-green-600">
                                ₦{{ number_format($donation->amount, 2) }}
                            </td>

                            <td class="px-6 py-4">

                                <a
                                    href="{{ route('admin.donations.show', $donation) }}"
                                    class="text-blue-600 mr-3">
                                    View
                                </a>

                                <a
                                    href="{{ route('admin.donations.edit', $donation) }}"
                                    class="text-green-600 mr-3">
                                    Edit
                                </a>

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="5"
                                class="px-6 py-10 text-center text-gray-500">

                                No donations recorded yet.

                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</x-app-layout>