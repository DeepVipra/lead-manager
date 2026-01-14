<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Upload Leads
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow rounded">

                @if (session('success'))
                    <div class="mb-4 text-green-700 bg-green-100 p-3 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-4 text-red-700 bg-red-100 p-3 rounded">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('leads.upload') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <label class="block font-medium mb-2">Select Excel File</label>
                        <input type="file" name="file" class="border p-2 w-full" required>
                    </div>

                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                        Upload Leads
                    </button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
