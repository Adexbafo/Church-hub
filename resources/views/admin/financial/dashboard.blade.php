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

                    <div class="text-3xl font-bold text-blue-600 mt-3">
                        ₦{{ number_format($currentBalance, 2) }}
                    </div>
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

        </div>

    </div>

</x-app-layout>