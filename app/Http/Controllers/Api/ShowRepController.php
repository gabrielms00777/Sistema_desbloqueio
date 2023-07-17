<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShowRepRequest;
use App\Models\Rep;

class ShowRepController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(ShowRepRequest $request)
    {
        $data = $request->validated();
        $rep = Rep::query()->with('unlocks')->whereSerialNumber($data['serial_number'])->first();
        return response()->json($rep);
    }
}
