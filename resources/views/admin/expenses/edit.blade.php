<x-app-layout>

    <div class="py-10">
        <div class="max-w-3xl mx-auto px-6">

            <div class="bg-white rounded-2xl shadow p-8">

                <h1 class="text-3xl font-bold mb-8">
                    Edit Expense
                </h1>

                <form
                    method="POST"
                    action="{{ route('expenses.update', $expense) }}">

                    @csrf
                    @method('PUT')

                    <div class="mb-6">

                        <label class="block font-medium mb-2">
                            Expense Title
                        </label>

                        <input
                            type="text"
                            name="expense_title"
                            value="{{ old('expense_title', $expense->expense_title) }}"
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

                            @foreach ($categories as $category)

                            <option
                                value="{{ $category->id }}"
                                @selected(old('fund_category_id', $expense->fund_category_id) == $category->id)>

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
                            value="{{ old('amount', $expense->amount) }}"
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

                            <option value="cash"
                                @selected(old('payment_method', $expense->payment_method) == 'cash')>
                                Cash
                            </option>

                            <option value="bank_transfer"
                                @selected(old('payment_method', $expense->payment_method) == 'bank_transfer')>
                                Bank Transfer
                            </option>

                            <option value="pos"
                                @selected(old('payment_method', $expense->payment_method) == 'pos')>
                                POS
                            </option>

                            <option value="online"
                                @selected(old('payment_method', $expense->payment_method) == 'online')>
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
                            value="{{ old('reference', $expense->reference) }}"
                            class="w-full rounded-lg border-gray-300">

                    </div>

                    <div class="mb-6">

                        <label class="block font-medium mb-2">
                            Description
                        </label>

                        <textarea
                            name="description"
                            rows="5"
                            class="w-full rounded-lg border-gray-300">{{ old('description', $expense->description) }}</textarea>

                    </div>

                    <div class="mb-8">

                        <label class="block font-medium mb-2">
                            Expense Date
                        </label>

                        <input
                            type="date"
                            name="expense_date"
                            value="{{ old('expense_date', $expense->expense_date->format('Y-m-d')) }}"
                            class="w-full rounded-lg border-gray-300"
                            required>

                    </div>

                    <div class="flex justify-end gap-4">

                        <a
                            href="{{ route('expenses.index') }}"
                            class="px-6 py-2 border rounded-lg">

                            Cancel

                        </a>

                        <button
                            type="submit"
                            class="bg-red-600 text-white px-6 py-2 rounded-lg">

                            Update Expense

                        </button>

                    </div>

                </form>

            </div>

        </div>
    </div>

</x-app-layout>