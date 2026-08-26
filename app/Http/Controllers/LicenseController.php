<?php

namespace App\Http\Controllers;

use App\Models\License;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LicenseController extends Controller
{
    public function index()
    {
        $license = License::latest('id')->first();

        return view('license.index', compact('license'));
    }

    // GET /license/edit -> ম্যানুয়ালি license data বসানোর ফর্ম
    public function edit()
    {
        $license = License::latest('id')->first() ?? new License();

        return view('license.edit', compact('license'));
    }

    // POST /license -> license data save/update
    public function update(Request $request)
    {
        $request->validate([
            'item_id'        => 'nullable|string|max:255',
            'item_name'      => 'nullable|string|max:255',
            'buyer'          => 'nullable|string|max:255',
            'purchase_code'  => 'nullable|string|max:255',
            'license_type'   => 'nullable|string|max:255',
            'purchase_date'  => 'nullable|string|max:255',
        ]);

        $license = License::latest('id')->first();

        if ($license) {
            $license->update($request->all());
        } else {
            License::create($request->all());
        }

        return redirect()->route('license.index')->with('success', 'License information saved!');
    }

    public function revoke()
    {
        License::query()->delete();

        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Your License has been revoked.');
    }
}
