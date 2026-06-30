<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <title>ChurchHub Members</title>

    @vite(['resources/css/app.css'])

    <style>
        @media print {

            .no-print {
                display: none;
            }

        }
    </style>

</head>

<body class="bg-white p-10">

    <div class="max-w-7xl mx-auto">

        <div class="flex justify-between items-center mb-8">

            <div>

                <h1 class="text-3xl font-bold">

                    Victory District Church

                </h1>

                <p class="text-gray-500">

                    Church Membership Register

                </p>

            </div>

            <div class="text-right">

                <div>

                    Printed:

                </div>

                <div>

                    {{ now()->format('F d, Y h:i A') }}

                </div>

            </div>

        </div>

        <table class="w-full border-collapse">

            <thead>

                <tr class="bg-gray-200">

                    <th class="border p-3 text-left">Membership ID</th>

                    <th class="border p-3 text-left">Name</th>

                    <th class="border p-3 text-left">Phone</th>

                    <th class="border p-3 text-left">Gender</th>

                    <th class="border p-3 text-left">Bands</th>

                    <th class="border p-3 text-left">Status</th>

                </tr>

            </thead>

            <tbody>

                @foreach($members as $member)

                <tr>

                    <td class="border p-3">

                        {{ $member->membership_id }}

                    </td>

                    <td class="border p-3">

                        {{ $member->full_name }}

                    </td>

                    <td class="border p-3">

                        {{ $member->phone }}

                    </td>

                    <td class="border p-3">

                        {{ ucfirst($member->gender) }}

                    </td>

                    <td class="border p-3 whitespace-nowrap text-sm">

                        {{ collect([
                                $member->band_one,
                                $member->band_two,
                                $member->band_three
                            ])->filter()->implode(' | ') ?: '—' }}

                    </td>

                    <td class="border p-3">

                        {{ ucfirst($member->membership_status) }}

                    </td>

                </tr>

                @endforeach

            </tbody>

        </table>

        <div class="mt-8 no-print">

            <button
                onclick="window.print()"
                class="bg-blue-600 text-white px-6 py-3 rounded-lg">

                Print

            </button>

        </div>

    </div>
    <script>
        window.onload = () => window.print();
    </script>
</body>

</html>