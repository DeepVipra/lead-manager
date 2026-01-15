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

            {{-- Country-wise Bar Chart --}}
            <div class="bg-white p-6 rounded shadow">
                <h3 class="text-lg font-semibold mb-4">Leads by Country</h3>
                <canvas id="countryChart"></canvas>
            </div>

            {{-- Service-wise Bar Chart --}}
            <div class="bg-white p-6 rounded shadow">
                <h3 class="text-lg font-semibold mb-4">Leads by Service</h3>
                <canvas id="serviceChart"></canvas>
            </div>

        </div>
    </div>

    {{-- Chart.js CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // ---------------- COUNTRY BAR CHART ----------------
        const countryLabels = @json($countryCounts->pluck('country'));
        const countryData   = @json($countryCounts->pluck('total'));

        new Chart(document.getElementById('countryChart'), {
            type: 'bar',
            data: {
                labels: countryLabels,
                datasets: [{
                    label: 'Leads',
                    data: countryData,
                    backgroundColor: '#3b82f6'
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { precision: 0 }
                    }
                }
            }
        });

        // ---------------- SERVICE BAR CHART ----------------
        const serviceLabels = @json($serviceCounts->pluck('service'));
        const serviceData   = @json($serviceCounts->pluck('total'));

        new Chart(document.getElementById('serviceChart'), {
            type: 'bar',
            data: {
                labels: serviceLabels,
                datasets: [{
                    label: 'Leads',
                    data: serviceData,
                    backgroundColor: '#10b981'
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { precision: 0 }
                    }
                }
            }
        });
    </script>
</x-app-layout>
