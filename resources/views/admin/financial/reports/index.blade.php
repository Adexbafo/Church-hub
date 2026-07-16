<x-app-layout>

    <div class="py-10">

        <div class="max-w-7xl mx-auto px-6">

            <h1 class="text-3xl font-bold mb-8">
                Financial Reports
            </h1>

            <form
                method="GET"
                class="bg-white shadow rounded-2xl p-6 mb-8">

                <div class="grid md:grid-cols-3 gap-4">

                    <div>
                        <label class="block mb-2 font-medium">
                            From
                        </label>

                        <input
                            type="date"
                            name="from"
                            value="{{ $from->format('Y-m-d') }}"
                            class="w-full rounded-lg border-gray-300">
                    </div>

                    <div>
                        <label class="block mb-2 font-medium">
                            To
                        </label>

                        <input
                            type="date"
                            name="to"
                            value="{{ $to->format('Y-m-d') }}"
                            class="w-full rounded-lg border-gray-300">
                    </div>

                    <div class="flex items-end">

                        <button
                            class="bg-blue-600 text-white px-6 py-2 rounded-lg">

                            Generate Report

                        </button>

                        <a
                            href="{{ route('admin.financial-reports.export.csv', [
                                'from' => request('from'),
                                'to' => request('to'),
                            ]) }}"
                            class="bg-green-600 text-white px-5 py-3 rounded-lg">

                            Export CSV

                        </a>
                        <a
                            href="{{ route(
        'admin.financial-reports.export.pdf',
        [
            'from' => request('from'),
                            'to' => request('to'),
                        ]
                    ) }}"
                            class="bg-red-600 text-white px-4 py-2 rounded-lg">
                            Export PDF
                        </a>

                    </div>

                </div>

            </form>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

                <div class="bg-white rounded-2xl shadow p-6">

                    <div class="text-gray-500">
                        Income
                    </div>

                    <div class="text-3xl font-bold text-green-600 mt-3">
                        ₦{{ number_format($income, 2) }}
                    </div>

                </div>

                <div class="bg-white rounded-2xl shadow p-6">

                    <div class="text-gray-500">
                        Expenses
                    </div>

                    <div class="text-3xl font-bold text-red-600 mt-3">
                        ₦{{ number_format($expenses, 2) }}
                    </div>

                </div>

                <div class="bg-white rounded-2xl shadow p-6">

                    <div class="text-gray-500">
                        Balance
                    </div>

                    <div class="text-3xl font-bold mt-3
                        {{ $balance >= 0
                            ? 'text-blue-600'
                            : 'text-red-600' }}">

                        ₦{{ number_format($balance, 2) }}

                    </div>

                </div>
            </div>

            <div class="bg-white rounded-2xl shadow p-6">

                <h2 class="text-xl font-bold mb-6">
                    Transactions
                </h2>

                <div class="overflow-x-auto">

                    <table class="w-full">

                        <thead class="border-b">

                            <tr>
                                <th class="text-left p-3">Date</th>
                                <th class="text-left p-3">Description</th>
                                <th class="text-left p-3">Category</th>
                                <th class="text-left p-3">Type</th>
                                <th class="text-left p-3">Amount</th>
                            </tr>

                        </thead>

                        <tbody>

                            @forelse ($transactions as $transaction)

                            <tr class="border-b">

                                <td class="p-3">
                                    {{ $transaction->transaction_date->format('M d, Y') }}
                                </td>

                                <td class="p-3">
                                    {{ $transaction->description }}
                                </td>

                                <td class="p-3">
                                    {{ $transaction->fundCategory?->name ?? 'N/A' }}
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

                                    @if ($transaction->transaction_type === 'income')

                                    <span class="text-green-600">
                                        ₦{{ number_format($transaction->amount, 2) }}
                                    </span>

                                    @else

                                    <span class="text-red-600">
                                        ₦{{ number_format($transaction->amount, 2) }}
                                    </span>

                                    @endif

                                </td>

                            </tr>

                            @empty

                            <tr>

                                <td colspan="5" class="p-6 text-center">
                                    No transactions found.
                                </td>

                            </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

                <div class="mt-6">
                    {{ $transactions->links() }}
                </div>

            </div>

            <div class="bg-white rounded-2xl shadow p-6 mt-6">

                <h2 class="text-xl font-bold mb-4">
                    Fund Category Report
                </h2>

                <div class="overflow-x-auto">

                    <table class="w-full">

                        <thead class="border-b">
                            <tr>
                                <th class="text-left p-3">
                                    Category
                                </th>

                                <th class="text-left p-3">
                                    Income
                                </th>

                                <th class="text-left p-3">
                                    Expenses
                                </th>

                                <th class="text-left p-3">
                                    Balance
                                </th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse ($categoryReports as $category)

                            @php
                            $incomeTotal = $category->income_total ?? 0;
                            $expenseTotal = $category->expense_total ?? 0;
                            $balanceTotal = $incomeTotal - $expenseTotal;
                            @endphp

                            <tr class="border-b">

                                <td class="p-3">
                                    {{ $category->name }}
                                </td>

                                <td class="p-3 text-green-600">
                                    ₦{{ number_format($incomeTotal, 2) }}
                                </td>

                                <td class="p-3 text-red-600">
                                    ₦{{ number_format($expenseTotal, 2) }}
                                </td>

                                <td class="p-3 font-medium
                            {{ $balanceTotal < 0
                                ? 'text-red-600'
                                : 'text-green-600' }}">
                                    ₦{{ number_format($balanceTotal, 2) }}
                                </td>

                            </tr>

                            @empty

                            <tr>
                                <td colspan="4" class="p-4 text-center">
                                    No category data available.
                                </td>
                            </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

            <div class="bg-white rounded-2xl shadow p-6 mt-6">
                <h2 class="text-xl font-bold mb-4">
                    Income vs Expenses
                </h2>

                <div style="height: 400px;">
                    <canvas id="incomeExpenseChart"></canvas>
                </div>
            </div>

        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('incomeExpenseChart');

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Income', 'Expenses'],
                    datasets: [{
                        label: 'Amount (₦)',
                        data: [
                            Number("{{ $chartData['income'] }}"),
                            Number("{{ $chartData['expenses'] }}")
                        ],
                        backgroundColor: [
                            '#16a34a',
                            '#dc2626'
                        ]
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,

                    plugins: {
                        title: {
                            display: true,
                            text: 'Income vs Expenses Analysis'
                        },
                        legend: {
                            display: false
                        }
                    },

                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return '₦' + value.toLocaleString();
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
</x-app-layout>