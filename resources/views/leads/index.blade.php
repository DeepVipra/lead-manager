<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Leads
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">

        <form method="GET" class="mb-4 bg-white p-4 rounded shadow grid grid-cols-6 gap-4">

            <input type="text" name="search"
                   value="{{ request('search') }}"
                   placeholder="Search email, client name, website"
                   class="border p-2 col-span-2">

            <select name="country" class="border p-2">
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
                   class="border p-2">

            <input type="text" name="reply"
                   placeholder="Reply"
                   value="{{ request('reply') }}"
                   class="border p-2">

            <input type="text" name="month"
                   placeholder="Month"
                   value="{{ request('month') }}"
                   class="border p-2">

            <input type="date" name="from_date"
                   value="{{ request('from_date') }}"
                   class="border p-2">

            <input type="date" name="to_date"
                   value="{{ request('to_date') }}"
                   class="border p-2">

            <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded col-span-6">
                Apply Filters
            </button>
        </form>

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
