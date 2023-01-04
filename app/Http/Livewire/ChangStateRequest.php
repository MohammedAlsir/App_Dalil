<?php

namespace App\Http\Livewire;

use App\Models\CarRequest;
use Livewire\Component;

class ChangStateRequest extends Component
{
    public $selectStatus;
    public $request_id;
    public $type;

    public function render()
    {
        return view('livewire.chang-state-request');
    }

    // type
    // 1 = car
    public function mount($request_id, $type)
    {
        $this->request_id = $request_id;
        $this->type = $type;
        if ($type == 1) {
            $this->selectStatus = CarRequest::find($request_id)->status;
        }
    }

    public function updatedSelectStatus($status)
    {
        if ($this->type == 1) {
            $request = CarRequest::find($this->request_id);
        }
        $request->status = $status;
        $request->save();
    }
}