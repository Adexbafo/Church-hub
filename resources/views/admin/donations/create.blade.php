<x-app-layout>

    <div class="py-10">

        <div class="max-w-4xl mx-auto px-6">

            <div class="bg-white rounded-2xl shadow p-8">

                <h1 class="text-3xl font-bold mb-8">
                    Record Donation
                </h1>

                <form method="POST"
                    action="{{ route('admin.donations.store') }}">

                    @csrf

                    <div class="mb-6">

                        <label class="block font-medium mb-2">
                            Donor Name
                        </label>

                        <input
                            type="text"
                            name="donor_name"
                            value="{{ old('donor_name') }}"
                            class="w-full rounded-lg border-gray-300">

                    </div>
                    <div class="mb-6">

                        <label class="block font-medium mb-2">
                            Fund Category
                        </label>

                        <select
                            name="fund_category_id"
                            class="w-full rounded-lg border-gray-300"
                            required>

                            <option value="">
                                Select Category
                            </option>

                            @foreach ($categories as $category)

                            <option
                                value="{{ $category->id }}"
                                @selected(old('fund_category_id')==$category->id)>

                                {{ $category->name }}

                            </option>

                            @endforeach

                        </select>

                    </div>
                    <div class="mb-6">

                        <label class="block font-medium mb-2">
                            Amount
                        </label>

                        <input
                            type="number"
                            step="0.01"
                            name="amount"
                            value="{{ old('amount') }}"
                            class="w-full rounded-lg border-gray-300"
                            required>

                    </div>
                    <div class="mb-6">

                        <label class="block font-medium mb-2">
                            Payment Method
                        </label>

                        <select
                            name="payment_method"
                            class="w-full rounded-lg border-gray-300"
                            required>

                            <option value="cash">Cash</option>

                            <option value="bank_transfer">
                                Bank Transfer
                            </option>

                            <option value="pos">
                                POS
                            </option>

                            <option value="online">
                                Online
                            </option>

                        </select>

                    </div>
                    <div class="mb-6">

                        <label class="block font-medium mb-2">
                            Reference
                        </label>

                        <input
                            type="text"
                            name="reference"
                            value="{{ old('reference') }}"
                            class="w-full rounded-lg border-gray-300">

                    </div>
                    <div class="mb-6">

                        <label class="block font-medium mb-2">
                            Donation Date
                        </label>

                        <input
                            type="date"
                            name="donation_date"
                            value="{{ old('donation_date', now()->format('Y-m-d')) }}"
                            class="w-full rounded-lg border-gray-300"
                            required>

                    </div>
                    <div class="mb-6">

                        <label class="block font-medium mb-2">
                            Notes
                        </label>

                        <textarea
                            name="notes"
                            rows="4"
                            class="w-full rounded-lg border-gray-300">{{ old('notes') }}</textarea>

                    </div>
                    <div class="flex justify-end gap-4">

                        <a
                            href="{{ route('admin.donations.index') }}"
                            class="px-6 py-2 border rounded-lg">

                            Cancel

                        </a>

                        <button
                            type="submit"
                            class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg">

                            Record Donation

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>