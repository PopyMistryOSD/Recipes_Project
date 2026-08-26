@extends('layouts.app')
@section('title', 'Edit License')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Edit License Info</h1>

    <form method="POST" action="{{ route('license.update') }}" class="bg-white p-6 rounded shadow max-w-2xl space-y-4">
        @csrf

        <div>
            <label class="block text-sm mb-1">Item ID</label>
            <input type="text" name="item_id" value="{{ old('item_id', $license->item_id) }}"
                class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block text-sm mb-1">Item Name</label>
            <input type="text" name="item_name" value="{{ old('item_name', $license->item_name) }}"
                class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block text-sm mb-1">Buyer</label>
            <input type="text" name="buyer" value="{{ old('buyer', $license->buyer) }}"
                class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block text-sm mb-1">Purchase Code</label>
            <input type="text" name="purchase_code" value="{{ old('purchase_code', $license->purchase_code) }}"
                class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block text-sm mb-1">License Type</label>
            <input type="text" name="license_type" value="{{ old('license_type', $license->license_type) }}"
                class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block text-sm mb-1">Purchase Date</label>
            <input type="text" name="purchase_date" value="{{ old('purchase_date', $license->purchase_date) }}"
                placeholder="e.g. 2026-08-20" class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                SAVE
            </button>
            <a href="{{ route('license.index') }}"
                class="ml-2 bg-gray-200 text-gray-700 px-6 py-2 rounded hover:bg-gray-300 inline-block transition">
                Cancel
            </a>
        </div>
    </form>
@endsection
