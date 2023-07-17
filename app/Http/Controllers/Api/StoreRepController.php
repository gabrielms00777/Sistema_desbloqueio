<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Rep;
use Illuminate\Http\Request;

class StoreRepController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $data = $request->validate([
            'serial_number' => 'required|string|max:50',
            'amount' => 'nullable|numeric|max:10',
        ]);
        $rep = Rep::query()->updateOrCreate(['serial_number' => $data['serial_number']], ['amount' => $data['amount'] ?? 0]);

        return response()->json($rep);
    }
}
