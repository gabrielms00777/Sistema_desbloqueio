<?php

namespace App\Http\Livewire\Rep;

use App\Models\Rep;
use Livewire\Component;

class Index extends Component
{
    protected $listeners = ['rep::created' => '$refresh'];

    public string $search = '';

    public function render()
    {
        return view('livewire.rep.index', [
            'reps' => Rep::query()
                                ->when($this->search, function($q){
                                    $q->where('serial_number', 'like', '%'. $this->search . '%');
                                })
                                ->latest()
                                ->paginate()
        ]);
    }
}
