<div>
    @if ($hotel)
        @foreach ($hotel->images as $item)
            <div class="col-sm-4">
                <br>
                <img style="width: 140px; height: 130px; margin: 1px ; padding: 0 !important; object-fit: cover" src="{{ asset('uploads/hotels/'.$item->photo) }}" alt="" class="form-control col-md-7 col-xs-12">
                <div>
                    <button wire:click="delete_image({{$item->id}})" type="button" class="btn btn-sm btn-default">حذف</button>
                </div>
            </div>
        @endforeach
    @elseif($appartment)
        @foreach ($appartment->images as $item)
            <div class="col-sm-4">
                <br>
                <img style="width: 140px; height: 130px; margin: 1px; padding: 0 !important; object-fit: cover" src="{{ asset('uploads/hotels/appartments/'.$item->photo) }}" alt="" class="form-control col-md-7 col-xs-12">
                <div>
                    <button wire:click="delete_image({{$item->id}})" type="button" class="btn btn-sm btn-default">حذف</button>
                </div>
            </div>
        @endforeach
    @endif
</div>
