@php
use Illuminate\Support\Str;
@endphp
<x-app-layout>

    <div class="py-10">

        <div class="max-w-4xl mx-auto px-6">

            <!-- Header -->
            <div class="flex items-center justify-between mb-8">

                <h1 class="text-3xl font-bold">
                    Donation Details
                </h1>

                <div class="flex gap-3">

                    <a
                        href="{{ route('admin.donations.index') }}"
                        class="px-4 py-2 border rounded-lg hover:bg-gray-100">

                        Back

                    </a>

                    <a
                        href="{{ route('admin.donations.edit', $donation) }}"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">

                        Edit Donation

                    </a>

                </div>

            </div>

            <!-- Donation Information -->
            <div class="bg-white rounded-2xl shadow p-8 mb-8">

                <h2 class="text-xl font-semibold mb-6">
                    Donation Information
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div>

                        <p class="text-sm text-gray-500">
                            Donor Name
                        </p>

                        <p class="font-semibold">
                            {{ $donation->donor_name }}
                        </p>

                    </div>

                    <div>

                        <p class="text-sm text-gray-500">
                            Fund Category
                        </p>

                        <p class="font-semibold">
                            {{ $donation->fundCategory?->name ?? 'N/A' }}
                        </p>

                    </div>

                    <div>

                        <p class="text-sm text-gray-500">
                            Amount
                        </p>

                        <p class="font-semibold text-green-700">
                            ₦{{ number_format($donation->amount, 2) }}
                        </p>

                    </div>

                    <div>

                        <p class="text-sm text-gray-500">
                            Payment Method
                        </p>

                        <p class="font-semibold">
                            {{ Str::headline($donation->payment_method) }}
                        </p>

                    </div>

                    <div>

                        <p class="text-sm text-gray-500">
                            Donation Date
                        </p>

                        <p class="font-semibold">
                            {{ $donation->donation_date->format('d M Y') }}
                        </p>

                    </div>

                    <div>

                        <p class="text-sm text-gray-500">
                            Receipt Number
                        </p>

                        <p class="font-semibold">
                            {{ $donation->receipt_number }}
                        </p>

                    </div>

                    <div class="md:col-span-2">

                        <p class="text-sm text-gray-500">
                            Reference
                        </p>

                        <p class="font-semibold">
                            {{ $donation->reference }}
                        </p>

                    </div>

                </div>

                @if($donation->notes)

                <div class="mt-8 border-t pt-6">

                    <h3 class="text-lg font-semibold mb-3">
                        Notes
                    </h3>

                    <p class="text-gray-700 whitespace-pre-line">
                        {{ $donation->notes }}
                    </p>

                </div>

                @endif

            </div>

            <!-- Audit Information -->
            <div class="bg-white rounded-2xl shadow p-8">

                <h2 class="text-xl font-semibold mb-6">
                    Audit Information
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div>

                        <p class="text-sm text-gray-500">
                            Recorded By
                        </p>

                        <p class="font-semibold">
                            {{ $donation->user?->name ?? 'System' }}
                        </p>

                    </div>

                    <div>

                        <p class="text-sm text-gray-500">
                            Created At
                        </p>

                        <p class="font-semibold">
                            {{ $donation->created_at->format('d M Y h:i A') }}
                        </p>

                    </div>

                    <div>

                        <p class="text-sm text-gray-500">
                            Last Updated
                        </p>

                        <p class="font-semibold">
                            {{ $donation->updated_at->format('d M Y h:i A') }}
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>