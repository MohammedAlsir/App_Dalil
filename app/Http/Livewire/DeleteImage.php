<?php

namespace App\Http\Livewire;

use App\Models\Hotel;
use App\Models\Image;
use Livewire\Component;

class DeleteImage extends Component
{
    public $image_id;
    public $hotel_id;
    public $hotel;
    public function render()
    {
        return view('livewire.delete-image');
    }

    public function mount($id)
    {
        $this->hotel_id = $id;
        $this->hotel = Hotel::find($id);
    }

    public function delete_image($id)
    {
        Image::find($id)->delete();
        $this->hotel = Hotel::find($this->hotel_id);
    }
}