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
            <h2> تعديل بيانات الشقة الفندقية
                <small>بيانات الشقة الفندقية الاساسية</small>
            </h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <br>
            <form  method="POST" action="{{route('appartment.update',$appartment->id)}}" id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left" >
                @csrf
                @method('put')

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="hotel">
                        الفندق
                        <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select id="hotel" name="hotel" required  class="select_2 form-control col-md-7 col-xs-12">
                            <option value="">اختر الفندق </option>
                            @foreach ($hotels as $hotel)
                                <option  {{$appartment->hotel_id == $hotel->id?  "selected":""}} value="{{$hotel->id}}">{{$hotel->name_ar}} - {{$hotel->name_en}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name_{{$localeCode}}">اسم الشقة
                            <span class="required"><i class="flag">{!! @Helper::languageName($localeCode) !!}</i></span>
                            <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" required value="{!! $appartment->{'name_'.$localeCode} !!}" id="name_{{$localeCode}}" name="name_{{$localeCode}}"
                                class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                @endforeach


                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="type">
                        نوع الغرفة / الجناح
                        <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select id="type" name="type" required  class="select_2 form-control col-md-7 col-xs-12">
                            <option value="">اختر النوع</option>
                            @foreach ($types as $type)
                                <option {{$appartment->type_appartment_id == $type->id?  "selected":""}} value="{{$type->id}}">{{$type->name_ar}} - {{$type->name_en}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="floor_{{$localeCode}}">الطابق
                            <span class="required"><i class="flag">{!! @Helper::languageName($localeCode) !!}</i></span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" value="{!! $appartment->{'floor_'.$localeCode} !!}" id="floor_{{$localeCode}}" name="floor_{{$localeCode}}"
                                class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                @endforeach

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number_of_rooms">عدد الغرف
                        <span class="required">
                        </span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input value="{{ $appartment->number_of_rooms }}" type="number" id="number_of_rooms" name="number_of_rooms"
                            class="form-control col-md-7 col-xs-12">
                    </div>
                </div>

                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="features_{{$localeCode}}">المميزات
                            <span class="required"><i class="flag">{!! @Helper::languageName($localeCode) !!}</i></span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <textarea id="mytextarea" rows="5" name="features_{{$localeCode}}"
                                class="form-control col-md-7 col-xs-12">{!! $appartment->{'features_'.$localeCode} !!}</textarea>
                        </div>
                    </div>
                @endforeach

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="night_price"> سعر الليلة
                        <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input value="{{$appartment->night_price}}" type="number" required id="night_price" name="night_price"
                            class="form-control col-md-7 col-xs-12">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="discount">التخفيض
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input value="{{$appartment->discount}}" type="number" id="discount" name="discount"
                            class="form-control col-md-7 col-xs-12">
                    </div>
                </div>


                <div class="ln_solid"></div>
                <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3 text-left">
                        {{-- <button type="submit" class="btn btn-primary">انصراف</button> --}}
                        <button type="submit" class="btn btn-success">حفظ</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>


@endsection
