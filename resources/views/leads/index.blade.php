<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Leads
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">

        {{-- FILTERS --}}
        <form method="GET" style="background:#fff;padding:16px;border-radius:6px;margin-bottom:16px;">

            <div style="display:flex;flex-wrap:wrap;gap:12px;align-items:end;">

                <input type="text" name="search"
                       value="{{ request('search') }}"
                       placeholder="Search"
                       style="padding:8px;border:1px solid #ccc;border-radius:4px;width:220px;">

                <select name="country" style="padding:8px;border:1px solid #ccc;border-radius:4px;">
                    <option value="">Country</option>
                    @foreach (['US','Canada','UK','UAE','Others'] as $country)
                        <option value="{{ $country }}"
                            @selected(request('country') === $country)>
                            {{ $country }}
                        </option>
                    @endforeach
                </select>

                <input type="text" name="service"
                       placeholder="Service"
                       value="{{ request('service') }}"
                       style="padding:8px;border:1px solid #ccc;border-radius:4px;">

                <input type="date" name="from_date"
                       value="{{ request('from_date') }}"
                       style="padding:8px;border:1px solid #ccc;border-radius:4px;">

                <input type="date" name="to_date"
                       value="{{ request('to_date') }}"
                       style="padding:8px;border:1px solid #ccc;border-radius:4px;">

                <button type="submit"
                        style="padding:8px 14px;background:#2563eb;color:#fff;border-radius:4px;border:none;">
                    Apply Filters
                </button>

            </div>
        </form>

        {{-- 🔥 EXPORT BUTTON (FORCED VISIBILITY) --}}
        <div style="margin-bottom:16px;text-align:right;">
            <a href="{{ route('leads.export', request()->query()) }}"
               style="display:inline-block;padding:10px 16px;background:#16a34a;color:#fff;
                      border-radius:4px;text-decoration:none;font-weight:600;">
                Export to Excel
            </a>
        </div>

        {{-- LEADS TABLE --}}
        <div class="bg-white shadow rounded overflow-x-auto">
            <table class="min-w-full border-collapse">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border p-2">Date</th>
                        <th class="border p-2">Client</th>
                        <th class="border p-2">Email</th>
                        <th class="border p-2">Country</th>
                        <th class="border p-2">Service</th>
                        <th class="border p-2">Reply</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($leads as $lead)
                        <tr>
                            <td class="border p-2">{{ $lead->lead_date }}</td>
                            <td class="border p-2">{{ $lead->client_name }}</td>
                            <td class="border p-2">{{ $lead->email }}</td>
                            <td class="border p-2">{{ $lead->country }}</td>
                            <td class="border p-2">{{ $lead->service }}</td>
                            <td class="border p-2">{{ $lead->reply }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-4 text-center">
                                No leads found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $leads->links() }}
        </div>

    </div>
</x-app-layout>
