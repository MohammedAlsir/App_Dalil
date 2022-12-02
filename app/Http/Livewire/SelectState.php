<?php

namespace App\Http\Livewire;

use App\Models\City;
use App\Models\State;
use Livewire\Component;
use SebastianBergmann\Type\NullType;

class SelectState extends Component
{
    public $city;
    public $selectedState = Null;


    public function render()
    {
        $all_states = State::all();

        return view('livewire.select-state', compact('all_states'));
    }

    public function mount()
    {
        $this->city = collect();
    }

    public function updatedSelectedState($id)
    {
        if (!is_null($id)) {
            $this->city = City::where('state_id', $id)->get();
        }
    }
}