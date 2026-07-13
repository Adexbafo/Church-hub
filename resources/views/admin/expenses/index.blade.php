<x-app-layout>

    <div class="py-10">
        <div class="max-w-7xl mx-auto px-6">

            <div class="flex justify-between mb-6">

                <h1 class="text-3xl font-bold">
                    Expenses
                </h1>

                <a
                    href="{{ route('expenses.create') }}"
                    class="bg-red-600 text-white px-5 py-2 rounded-lg">

                    Add Expense

                </a>

            </div>

            <div class="bg-white shadow rounded-xl overflow-hidden">

                <table class="w-full">

                    <thead class="bg-gray-100">

                        <tr>
                            <th class="p-4 text-left">Title</th>
                            <th class="p-4 text-left">Category</th>
                            <th class="p-4 text-left">Amount</th>
                            <th class="p-4 text-left">Date</th>
                            <th class="p-4 text-left">Actions</th>
                        </tr>

                    </thead>

                    <tbody>

                        @forelse ($expenses as $expense)

                        <tr class="border-t">

                            <td class="p-4">
                                {{ $expense->expense_title }}
                            </td>

                            <td class="p-4">
                                {{ $expense->fundCategory?->name }}
                            </td>

                            <td class="p-4">
                                ₦{{ number_format($expense->amount, 2) }}
                            </td>

                            <td class="p-4">
                                {{ $expense->expense_date->format('M d, Y') }}
                            </td>
                            <td class="p-4">

                                <div class="flex gap-3">

                                    <a
                                        href="{{ route('expenses.show', $expense) }}"
                                        class="text-blue-600">

                                        View

                                    </a>

                                    <a
                                        href="{{ route('expenses.edit', $expense) }}"
                                        class="text-green-600">

                                        Edit

                                    </a>

                                    <form
                                        action="{{ route('expenses.destroy', $expense) }}"
                                        method="POST">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="text-red-600"
                                            onclick="return confirm('Delete this expense?')">

                                            Delete

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td
                                colspan="4"
                                class="p-6 text-center">

                                No expenses recorded.

                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>
    </div>

</x-app-layout>