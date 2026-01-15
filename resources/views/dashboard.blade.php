<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">

        {{-- Date Filter --}}
        <form method="GET" class="mb-6 bg-white p-4 rounded shadow flex gap-4">
            <input type="date" name="from_date" value="{{ $fromDate }}" class="border p-2">
            <input type="date" name="to_date" value="{{ $toDate }}" class="border p-2">
            <button class="bg-blue-600 text-white px-4 py-2 rounded">
                Apply
            </button>
        </form>

        {{-- Total Leads --}}
        <div class="mb-6 bg-white p-6 rounded shadow">
            <h3 class="text-lg font-semibold">Total Leads</h3>
            <p class="text-3xl font-bold text-blue-600">{{ $totalLeads }}</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            {{-- Country-wise --}}
            <div class="bg-white p-6 rounded shadow">
                <h3 class="text-lg font-semibold mb-4">Leads by Country</h3>
                <table class="w-full border">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border p-2">Country</th>
                            <th class="border p-2">Count</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($countryCounts as $row)
                            <tr>
                                <td class="border p-2">{{ $row->country ?? 'Unknown' }}</td>
                                <td class="border p-2">{{ $row->total }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Service-wise --}}
            <div class="bg-white p-6 rounded shadow">
                <h3 class="text-lg font-semibold mb-4">Leads by Service</h3>
                <table class="w-full border">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border p-2">Service</th>
                            <th class="border p-2">Count</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($serviceCounts as $row)
                            <tr>
                                <td class="border p-2">{{ $row->service ?? 'Unknown' }}</td>
                                <td class="border p-2">{{ $row->total }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>

