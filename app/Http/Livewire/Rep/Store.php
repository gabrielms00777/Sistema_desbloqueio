<?php

namespace App\Http\Livewire\Rep;

use App\Models\Rep;
use Livewire\Component;

class Store extends Component
{
    public string $serial_number = '';
    public string $unlocks = '';

    protected $rules = [
        'serial_number' => 'required|string|max:40',
        'unlocks' => 'nullable|string|max:40',
    ];

    public function save()
    {
        $data = $this->validate();

        Rep::query()->create($data);

        $this->dispatchBrowserEvent('close-modal');

        $this->emit('rep::created');
    }

    public function render()
    {
        return view('livewire.rep.store');
    }
}
