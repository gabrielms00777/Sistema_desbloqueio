<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Rep;
use Illuminate\Http\Request;

class StoreUnlockController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $data = $request->validate([
            'serial_number' => 'required|string',
            'company' => 'required|string',
            'cnpj' => 'nullable|string',
            'client_name' => 'required|string',
            'responsible' => 'required|string',
            'emergency' => 'nullable|boolean',
            'observation' => 'nullable|string|max:255',
        ]);
        $rep = Rep::query()->with('unlocks')->firstOrCreate(['serial_number'=> $data['serial_number']]);
        $rep->update(['amount' => $rep->amount + 1]);
        $data['amount'] = $rep->amount;
        // dd($rep, $data);
        $rep->unlocks()->create($data);
        return response()->json($rep);
    }
}
