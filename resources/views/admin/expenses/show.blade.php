<x-app-layout>

    <div class="py-10">
        <div class="max-w-4xl mx-auto px-6">

            <div class="bg-white rounded-xl shadow p-8">

                <h1 class="text-3xl font-bold mb-8">
                    Expense Details
                </h1>

                <div class="space-y-4">

                    <p>
                        <strong>Title:</strong>
                        {{ $expense->expense_title }}
                    </p>

                    <p>
                        <strong>Category:</strong>
                        {{ $expense->fundCategory?->name }}
                    </p>

                    <p>
                        <strong>Amount:</strong>
                        ₦{{ number_format($expense->amount, 2) }}
                    </p>

                    <p>
                        <strong>Payment Method:</strong>
                        {{ ucfirst($expense->payment_method) }}
                    </p>

                    <p>
                        <strong>Reference:</strong>
                        {{ $expense->reference }}
                    </p>

                    <p>
                        <strong>Date:</strong>
                        {{ $expense->expense_date->format('F d, Y') }}
                    </p>

                    <p>
                        <strong>Description:</strong><br>
                        {{ $expense->description }}
                    </p>

                </div>

            </div>

        </div>
    </div>

</x-app-layout>