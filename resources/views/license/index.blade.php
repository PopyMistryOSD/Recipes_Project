@extends('layouts.app')
@section('title', 'License')

@section('content')
    <h1 class="text-2xl font-bold mb-4">License</h1>

    <form method="POST" action="{{ route('license.revoke') }}">
        @csrf
        <div class="bg-white p-6 rounded shadow max-w-2xl">
            <table class="w-full text-sm">
                <tr class="border-b">
                    <td class="py-2 text-gray-500 w-40">Item ID</td>
                    <td class="py-2">{{ $license->item_id ?? '-' }}</td>
                </tr>
                <tr class="border-b">
                    <td class="py-2 text-gray-500">Item Name</td>
                    <td class="py-2">{{ $license->item_name ?? '-' }}</td>
                </tr>
                <tr class="border-b">
                    <td class="py-2 text-gray-500">Buyer</td>
                    <td class="py-2">{{ $license->buyer ?? '-' }}</td>
                </tr>
                <tr class="border-b">
                    <td class="py-2 text-gray-500">Purchase Code</td>
                    <td class="py-2">{{ $license->purchase_code ?? '-' }}</td>
                </tr>
                <tr class="border-b">
                    <td class="py-2 text-gray-500">License Type</td>
                    <td class="py-2">{{ $license->license_type ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="py-2 text-gray-500">Purchase Date</td>
                    <td class="py-2">{{ $license->purchase_date ?? '-' }}</td>
                </tr>
            </table>

            <div class="mt-4 flex justify-end gap-2">
                <a href="{{ route('license.edit') }}"
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 text-sm">
                    Edit License Info
                </a>
                <button type="submit" onclick="return confirm('Are you sure want to revoke this license?')"
                    class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 text-sm">
                    REVOKE LICENSE
                </button>
            </div>
        </div>
    </form>
@endsection
