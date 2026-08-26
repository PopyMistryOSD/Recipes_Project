@extends('layouts.app')
@section('title', 'Change API Key')

@section('content')
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Change API Key</h1>
        <a href="{{ route('settings.api-key.generate') }}"
            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 text-sm">
            GENERATE
        </a>
    </div>

    <div class="bg-white p-6 rounded shadow max-w-xl">
        @if (isset($generatedKey))
            <form method="POST" action="{{ route('settings.api-key.update') }}">
                @csrf
                <label class="block text-sm mb-1">Generated API Key</label>
                <input type="text" name="api_key" value="{{ $generatedKey }}" class="w-full border rounded px-3 py-2 mb-4"
                    required>

                <button type="submit" onclick="return confirm('Are you sure want to update API Key?')"
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 text-sm">
                    UPDATE API KEY
                </button>
            </form>
        @else
            <p class="text-gray-500">Click "GENERATE" to create a new random API key.</p>
        @endif
    </div>
@endsection
