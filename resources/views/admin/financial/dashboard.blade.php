<x-app-layout>

    <div class="py-10">

        <div class="max-w-7xl mx-auto px-6">

            <h1 class="text-3xl font-bold mb-8">
                Financial Dashboard
            </h1>

            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

                <div class="bg-white rounded-2xl shadow p-6">
                    <div class="text-gray-500">
                        Total Income
                    </div>

                    <div class="text-3xl font-bold text-green-600 mt-3">
                        ₦{{ number_format($totalIncome, 2) }}
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow p-6">
                    <div class="text-gray-500">
                        Total Expenses
                    </div>

                    <div class="text-3xl font-bold text-red-600 mt-3">
                        ₦{{ number_format($totalExpenses, 2) }}
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow p-6">
                    <div class="text-gray-500">
                        Current Balance
                    </div>

                    <div class="
                        text-3xl font-bold mt-3
                        {{ $currentBalance >= 0 ? 'text-blue-600' : 'text-red-600' }}
                    ">
                        ₦{{ number_format($currentBalance, 2) }}
                    </div>
                    @if ($currentBalance < 0)
                        <p class="text-red-500 text-sm mt-2">
                        Church spending exceeds income.
                        </p>
                        @endif
                </div>

                <div class="bg-white rounded-2xl shadow p-6">
                    <div class="text-gray-500">
                        This Month Giving
                    </div>

                    <div class="text-3xl font-bold text-yellow-600 mt-3">
                        ₦{{ number_format($thisMonthGiving, 2) }}
                    </div>
                </div>
            </div>
            <div class="mt-10 grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div class="bg-white rounded-2xl shadow p-6 lg:col-span-2">

                    <h2 class="text-xl font-bold mb-4">
                        Recent Transactions
                    </h2>

                    <div class="overflow-x-auto w-full">

                        <table class="w-full">

                            <thead class="border-b">

                                <tr>
                                    <th class="text-left p-3">Date</th>
                                    <th class="text-left p-3">Description</th>
                                    <th class="text-left p-3">Type</th>
                                    <th class="text-left p-3">Amount</th>
                                </tr>

                            </thead>

                            <tbody>

                                @forelse ($recentTransactions as $transaction)

                                <tr class="border-b">

                                    <td class="p-3">
                                        {{ $transaction->transaction_date->format('M d, Y') }}
                                    </td>

                                    <td class="p-3">
                                        {{ $transaction->description }}
                                    </td>

                                    <td class="p-3">

                                        @if ($transaction->transaction_type === 'income')

                                        <span class="text-green-600 font-medium">
                                            Income
                                        </span>

                                        @else

                                        <span class="text-red-600 font-medium">
                                            Expense
                                        </span>

                                        @endif

                                    </td>

                                    <td class="p-3">
                                        ₦{{ number_format($transaction->amount, 2) }}
                                    </td>

                                </tr>

                                @empty

                                <tr>
                                    <td colspan="4" class="p-4 text-center">
                                        No transactions found.
                                    </td>
                                </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                </div>
                <div class="bg-white rounded-2xl shadow p-6">

                    <h2 class="text-xl font-bold mb-4">
                        Recent Donations
                    </h2>

                    <ul class="space-y-3">

                        @forelse ($recentDonations as $donation)

                        <li class="flex justify-between border-b pb-2">

                            <span>
                                {{ $donation->donor_name }}
                            </span>

                            <span class="font-medium text-green-600">
                                ₦{{ number_format($donation->amount, 2) }}
                            </span>

                        </li>

                        @empty

                        <li>No donations recorded.</li>

                        @endforelse

                    </ul>

                </div>
                <div class="bg-white rounded-2xl shadow p-6">

                    <h2 class="text-xl font-bold mb-4">
                        Recent Expenses
                    </h2>
                    <ul class="space-y-3">

                        @forelse ($recentExpenses as $expense)

                        <li class="flex justify-between border-b pb-2">

                            <span>
                                {{ $expense->expense_title }}
                            </span>

                            <span class="font-medium text-red-600">
                                ₦{{ number_format($expense->amount, 2) }}
                            </span>

                        </li>

                        @empty

                        <li>No expenses recorded.</li>

                        @endforelse

                    </ul>

                </div>
                <div class="bg-white rounded-2xl shadow p-6">
                    <h2 class="text-xl font-bold mb-4">
                        Expenses by Category
                    </h2>

                    <ul class="space-y-3">

                        @forelse ($expenseByCategory as $item)

                        <li class="flex justify-between border-b pb-2">

                            <span>
                                {{ $item->fundCategory?->name ?? 'Unknown' }}
                            </span>

                            <span class="font-medium text-red-600">
                                ₦{{ number_format($item->total, 2) }}
                            </span>

                        </li>

                        @empty

                        <li>No expenses recorded.</li>

                        @endforelse

                    </ul>
                </div>

                <div class="bg-white rounded-2xl shadow p-6">
                    <h2 class="text-xl font-bold mb-4">
                        Income by Category
                    </h2>

                    <ul class="space-y-3">

                        @forelse ($incomeByCategory as $item)

                        <li class="flex justify-between border-b pb-2">

                            <span>
                                {{ $item->fundCategory?->name ?? 'Unknown' }}
                            </span>

                            <span class="font-medium text-green-600">
                                ₦{{ number_format($item->total, 2) }}
                            </span>

                        </li>

                        @empty

                        <li>No income recorded.</li>

                        @endforelse

                    </ul>
                </div>
            </div>

        </div>

    </div>

    </div>

</x-app-layout>