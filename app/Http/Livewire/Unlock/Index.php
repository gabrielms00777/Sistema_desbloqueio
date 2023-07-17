<?php

namespace App\Http\Livewire\Unlock;

use App\Models\Unlock;
use Carbon\Carbon;
use Livewire\Component;

class Index extends Component
{
    public string $search = '';
    public bool $emergency = false;
    public bool $not_emergency = false;

    public function teste()
    {
        dd($this->emergency, $this->not_emergency);
    }

    public function render()
    {
        return view('livewire.unlock.index',[
            'unlocks' => Unlock::query()->with('rep')
                                        ->where('emergency', false)
                                        ->when($this->emergency, function($q){
                                            $q->where('emergency', $this->emergency);
                                        })
                                        ->when($this->not_emergency, function($q){
                                            $q->where('emergency', $this->not_emergency);
                                        })
                                        ->when($this->search, function($q){
                                            $q->where('company', 'like', '%'. $this->search . '%')
                                            ->orWhere('cnpj', 'like', '%'. $this->search . '%')
                                            ->orWhere('client_name', 'like', '%'. $this->search . '%')
                                            ->orWhere('responsible', 'like', '%'. $this->search . '%');
                                        })
                                        ->latest()
                                        ->paginate()
        ]);
    }
}
