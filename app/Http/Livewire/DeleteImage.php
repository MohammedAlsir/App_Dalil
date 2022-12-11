<?php

namespace App\Http\Livewire;

use App\Models\Hotel;
use App\Models\HotelAppartment;
use App\Models\Image;
use Illuminate\Support\Facades\File;
use Livewire\Component;

class DeleteImage extends Component
{
    public $image_id;
    public $hotel_id;
    public $appartment_id;
    public $hotel;
    public $appartment;
    public function render()
    {
        return view('livewire.delete-image');
    }

    public function mount($hotel_id, $appartment_id)
    {
        $this->hotel_id = $hotel_id;
        $this->appartment_id = $appartment_id;

        if ($this->hotel_id != 0)
            $this->hotel = Hotel::find($hotel_id);


        if ($this->appartment_id != 0)
            $this->appartment = HotelAppartment::find($appartment_id);
    }

    public function delete_image($id)
    {
        if ($this->hotel_id != 0) {
            $this->hotel = Hotel::find($this->hotel_id);
            $image_hotel = Image::find($id);
            File::delete("uploads/hotels/" . $image_hotel->photo);
            $image_hotel->delete();
        }


        if ($this->appartment_id != 0) {
            $this->appartment = HotelAppartment::find($this->appartment_id);
            $image_apartment = Image::find($id);
            File::delete("uploads/hotels/appartments/" . $image_apartment->photo);
            $image_apartment->delete();
        }
    }
}