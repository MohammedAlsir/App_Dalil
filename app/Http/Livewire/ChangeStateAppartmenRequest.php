<?php

namespace App\Http\Livewire;

use App\Models\Hotel_apartment_requests;
use Livewire\Component;

class ChangeStateAppartmenRequest extends Component
{
    public $selectStatus;
    public $request_id;
    public function render()
    {
        return view('livewire.change-state-appartmen-request');
    }

    public function mount($request_id)
    {
        $this->request_id = $request_id;
        $this->selectStatus = Hotel_apartment_requests::find($request_id)->status;
    }

    public function updatedSelectStatus($status)
    {
        $request = Hotel_apartment_requests::find($this->request_id);
        $request->status = $status;
        $request->save();
    }
}
