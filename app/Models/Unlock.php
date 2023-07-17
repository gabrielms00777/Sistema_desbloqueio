<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use function Pest\Laravel\get;

class Unlock extends Model
{
    use HasFactory;

    protected $fillable = [
        'rep_id',
        'company',
        'cnpj',
        'client_name',
        'responsible',
        'emergency',
        'observation',
        'amount',
    ];

    protected $casts = [
        'emergency' => 'boolean'
    ];

    public function rep(): BelongsTo
    {
        return $this->belongsTo(Rep::class);
    }
}
