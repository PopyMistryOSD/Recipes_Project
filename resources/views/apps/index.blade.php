@extends('layouts.app')
@section('title', 'Manage Apps')

@section('content')
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Manage Apps</h1>
        <a href="{{ route('apps.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 text-sm">
            + ADD NEW APP
        </a>
    </div>

    <form method="GET" class="mb-4 flex gap-2">
        <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="Search..."
            class="border rounded px-3 py-2 flex-1">
        <a href="{{ route('apps.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded text-sm">RESET</a>
        <button class="bg-blue-600 text-white px-4 py-2 rounded text-sm">Search</button>
    </form>

    @if ($apps->isEmpty())
        <p class="text-center text-gray-500 py-10">No app created, add new app to get your Server Key and manage redirect.
        </p>
    @else
        <div class="space-y-4">
            @foreach ($apps as $app)
                <div class="bg-white rounded shadow p-5">
                    <table class="w-full text-sm">
                        <tr class="border-b">
                            <td class="py-2 text-gray-500 w-1/4">applicationId (Package Name)</td>
                            <td class="py-2 break-all">{{ $app->package_name }}</td>
                        </tr>
                        <tr class="border-b">
                            <td class="py-2 text-gray-500">Server Key</td>
                            <td class="py-2 break-all">
                                {{ \App\Http\Controllers\AppConfigController::generateServerKey($app->package_name) }}</td>
                        </tr>
                        <tr class="border-b">
                            <td class="py-2 text-gray-500">Rest API Key</td>
                            <td class="py-2 break-all">{{ $apiKey ?? '-' }}</td>
                        </tr>
                        <tr class="border-b">
                            <td class="py-2 text-gray-500">Status</td>
                            <td class="py-2">
                                @if ($app->status)
                                    <span class="bg-blue-500 text-white text-xs px-2 py-1 rounded-full">ACTIVE</span>
                                @else
                                    <span class="bg-gray-400 text-white text-xs px-2 py-1 rounded-full">INACTIVE</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="py-2 text-gray-500">Redirect Url</td>
                            <td class="py-2 break-all">{{ $app->redirect_url ?: '-' }}</td>
                        </tr>
                    </table>

                    <div class="mt-3 flex justify-end gap-2">
                        <a href="{{ route('apps.edit', $app->id) }}"
                            class="bg-blue-600 text-white text-sm px-3 py-1.5 rounded hover:bg-blue-700 transition inline-flex items-center gap-1">
                            <span class="material-icons text-sm">mode_edit</span> Edit
                        </a>
                        <a href="{{ route('apps.destroy', $app->id) }}"
                            onclick="return confirm('Are you sure want to delete this app?')"
                            class="bg-red-600 text-white text-sm px-3 py-1.5 rounded hover:bg-red-700 transition inline-flex items-center gap-1">
                            <span class="material-icons text-sm">delete</span> Delete
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-4">{{ $apps->appends(request()->query())->links() }}</div>
    @endif
@endsection
