<x-app-layout>

    <div class="py-10">
        <div class="max-w-4xl mx-auto px-6">

            <div class="bg-white rounded-xl shadow p-8">

                <h1 class="text-3xl font-bold mb-8">
                    Record Expense
                </h1>

                <form method="POST"
                    action="{{ route('expenses.store') }}">

                    @csrf

                    <div class="mb-6">
                        <label class="block font-medium mb-2">
                            Expense Title
                        </label>

                        <input
                            type="text"
                            name="expense_title"
                            class="w-full rounded-lg border-gray-300"
                            required>
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

                            <option value="{{ $category->id }}">
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
                            class="w-full rounded-lg border-gray-300"
                            required>
                    </div>

                    <div class="mb-6">
                        <label class="block font-medium mb-2">
                            Payment Method
                        </label>

                        <select
                            name="payment_method"
                            class="w-full rounded-lg border-gray-300">

                            <option value="cash">
                                Cash
                            </option>

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
                            class="w-full rounded-lg border-gray-300">

                    </div>

                    <div class="mb-6">

                        <label class="block font-medium mb-2">
                            Description
                        </label>

                        <textarea
                            name="description"
                            rows="4"
                            class="w-full rounded-lg border-gray-300"></textarea>

                    </div>

                    <div class="mb-8">

                        <label class="block font-medium mb-2">
                            Expense Date
                        </label>

                        <input
                            type="date"
                            name="expense_date"
                            value="{{ now()->toDateString() }}"
                            class="w-full rounded-lg border-gray-300"
                            required>

                    </div>

                    <button
                        type="submit"
                        class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-lg">

                        Record Expense

                    </button>

                </form>

            </div>

        </div>
    </div>

</x-app-layout>