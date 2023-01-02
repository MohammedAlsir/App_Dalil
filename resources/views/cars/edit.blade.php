@extends('layouts.main')
@section('content')
{{-- @section('css')
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
    tinymce.init({
        selector: '#mytextarea',
        plugins: [
        'a11ychecker','advlist','advcode','advtable','autolink','checklist','export',
        'lists','link','image','charmap','preview','anchor','searchreplace','visualblocks',
        'powerpaste','fullscreen','formatpainter','insertdatetime','media','table','help','wordcount'
        ],
        toolbar: 'undo redo | formatpainter casechange blocks | bold italic backcolor | ' +
        'alignleft aligncenter alignright alignjustify | ' +
        'bullist numlist checklist outdent indent | removeformat | a11ycheck code table help'
    });
    </script>
@endsection --}}


<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2> تعديل بيانات السيارة
                <small>بيانات السيارة الاساسية</small>
            </h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <br>
            <form  method="POST" action="{{route('cars.update',$car->id)}}" id="demo-form2" data-parsley-validate="" enctype="multipart/form-data" class="form-horizontal form-label-left" >
                @csrf
                @method('put')

                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name_{{$localeCode}}">الاسم
                        <span class="required"><i class="flag">{!! @Helper::languageName($localeCode) !!}</i></span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" value="{!!$car->{'name_'.$localeCode}!!}" required id="name_{{$localeCode}}" name="name_{{$localeCode}}"
                            class="form-control col-md-7 col-xs-12">
                    </div>
                </div>
                @endforeach

               {{-- @livewire('select-state') --}}

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="type">
                        نوع السيارة
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select id="type" name="type" required  class="form-control col-md-7 col-xs-12">
                            <option value="">اختر نوع السيارة </option>
                            <option {{$car->type == 1 ? "selected":"" }} value="1">صغيرة - small</option>
                            <option {{$car->type == 2 ? "selected":"" }} value="2">متوسطة - Medium</option>
                            <option {{$car->type == 3 ? "selected":"" }} value="3">كبيرة - Big</option>
                            <option {{$car->type == 4 ? "selected":"" }} value="4">فاخرة - Deluxe</option>
                            <option {{$car->type == 5 ? "selected":"" }} value="5">عائلية - Familial</option>
                            <option {{$car->type == 6 ? "selected":"" }} value="6">مراسم - Ceremony</option>
                        </select>
                    </div>
                </div>

                 <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="motion_vector">
                        نوع ناقل الحركة
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select id="motion_vector" name="motion_vector" required  class="form-control col-md-7 col-xs-12">
                            <option value="">اختر نوع ناقل الحركة </option>
                            <option {{$car->motion_vector == 1 ? "selected":"" }} value="1">اوتوماتيك - Automatic</option>
                            <option {{$car->motion_vector == 2 ? "selected":"" }} value="2">عادي - Normal</option>
                        </select>
                    </div>
                </div>


                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number_of_passengers">عدد الركاب
                        <span class="required"><i class="flag"></i></span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="number" value="{{$car->number_of_passengers}}" required id="number_of_passengers" name="number_of_passengers"
                            class="form-control col-md-7 col-xs-12">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number_of_doors">عدد الابواب
                        <span class="required"><i class="flag"></i></span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="number" value="{{$car->number_of_doors}}" required id="number_of_doors" name="number_of_doors"
                            class="form-control col-md-7 col-xs-12">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="day_price">سعر اليوم الواحد
                        <span class="required"><i class="flag"></i></span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="number" value="{{$car->day_price}}" required id="day_price" name="day_price"
                            class="form-control col-md-7 col-xs-12">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="driver_price">سعر السائق لليوم الواحد
                        <span class="required"><i class="flag"></i></span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="number" value="{{$car->driver_price}}"  id="driver_price" name="driver_price"
                            class="form-control col-md-7 col-xs-12">
                    </div>
                </div>





                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Features_{{$localeCode}}">المميزات
                            <span class="required"><i class="flag">{!! @Helper::languageName($localeCode) !!}</i></span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <textarea id="mytextarea" rows="5" name="features_{{$localeCode}}"
                                class="form-control col-md-7 col-xs-12">{!!$car->{'features_'.$localeCode}!!}</textarea>
                        </div>
                    </div>
                @endforeach


                <div class="form-group">
                    <label class="col-md-3 control-label"></label>
                    <div class="col-md-4">
                        <img style="width: 150px; height: 150px; object-fit: cover;"  src="{{$car->image ?  asset('uploads/cars/'.$car->image->photo): ""}}" alt="لا يوجد صورة حاليا" srcset="">
                    </div>
                </div>



                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-12 col-xs-12" >الصور </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="file"  name="photo"
                            class="form-control col-md-7 col-xs-12"></input>

                    </div>
                </div>


                <div class="ln_solid" style="margin-top:85px "></div>
                <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3 text-left">
                        {{-- <button type="submit" class="btn btn-primary">انصراف</button> --}}
                        <button form="demo-form2" type="submit" class="btn btn-success">تعديل</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>


@endsection
