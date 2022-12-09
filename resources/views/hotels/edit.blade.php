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
            <h2> تعديل بيانات الفندق
                <small>بيانات الفندق الاساسية</small>
            </h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <br>
            <form  method="POST" action="{{route('hotels.update',$hotel->id)}}" id="demo-form2" data-parsley-validate="" enctype="multipart/form-data" class="form-horizontal form-label-left" >
                @csrf
                @method('put')

                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name_{{$localeCode}}">الاسم
                        <span class="required"><i class="flag">{!! @Helper::languageName($localeCode) !!}</i></span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" value="{!!$hotel->{'name_'.$localeCode}!!}" required id="name_{{$localeCode}}" name="name_{{$localeCode}}"
                            class="form-control col-md-7 col-xs-12">
                    </div>
                </div>
                @endforeach

               @livewire('edit-select-state',['id'=>$hotel->id])

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="stars">
                        النجوم
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select id="stars" name="stars" required  class="form-control col-md-7 col-xs-12">
                            <option value="">اختر عدد النجوم</option>
                            <option  {{$hotel->stars == 1 ? "selected":""}} value="1">1</option>
                            <option  {{$hotel->stars == 2 ? "selected":""}} value="2">2</option>
                            <option  {{$hotel->stars == 3 ? "selected":""}} value="3">3</option>
                            <option  {{$hotel->stars == 4 ? "selected":""}} value="4">4</option>
                            <option  {{$hotel->stars == 5 ? "selected":""}} value="5">5</option>
                        </select>
                    </div>
                </div>


                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="location_{{$localeCode}}">الموقع
                        <span class="required"><i class="flag">{!! @Helper::languageName($localeCode) !!}</i></span>

                            <span class="required">
                                <span style="color: red">موقع الفندق بالتحديد</span>
                                {{-- <a target="_blank" style="color: red" href="https://www.google.com/maps">عرض خرائط قوقل</a> --}}
                            </span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="location_{{$localeCode}}" value="{!!$hotel->{'location_'.$localeCode}!!}" name="location_{{$localeCode}}"
                                class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>

                @endforeach

                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Features_{{$localeCode}}">المميزات
                            <span class="required"><i class="flag">{!! @Helper::languageName($localeCode) !!}</i></span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <textarea id="mytextarea" rows="5" name="features_{{$localeCode}}"
                                class="form-control col-md-7 col-xs-12">{!!$hotel->{'features_'.$localeCode}!!}</textarea>
                        </div>
                    </div>
                @endforeach


                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" >الصور </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                            {{-- <form action=""> --}}

                        @foreach ($hotel->images as $item)
                            <img style="width: 150px; height: 150px; margin: 1px" src="{{ asset('uploads/hotels/'.$item->photo) }}" alt="" class="form-control col-md-7 col-xs-12">
                        @endforeach
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" >الصور </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="file" multiple  name="photo[]"
                            class="form-control col-md-7 col-xs-12"></input>
                    <p>الحد الاقصى للصور 3 صور </p>

                    </div>
                </div>


                <div class="ln_solid"></div>
                <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3 text-left">
                        {{-- <button type="submit" class="btn btn-primary">انصراف</button> --}}
                        <button type="submit" class="btn btn-success">تعديل</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>


@endsection
