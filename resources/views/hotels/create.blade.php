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
            <h2> إضافة فندق جديد
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
            <form  method="POST" action="{{route('hotels.store')}}" id="demo-form2" data-parsley-validate="" enctype="multipart/form-data" class="form-horizontal form-label-left" >
                @csrf

                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name_{{$localeCode}}">الاسم
                        <span class="required"><i class="flag">{!! @Helper::languageName($localeCode) !!}</i></span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" required id="name_{{$localeCode}}" name="name_{{$localeCode}}"
                            class="form-control col-md-7 col-xs-12">
                    </div>
                </div>
                @endforeach

               @livewire('select-state')

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="stars">
                        النجوم
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select id="stars" name="stars" required  class="form-control col-md-7 col-xs-12">
                            <option value="">اختر عدد النجوم</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
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
                            <input type="text" id="location_{{$localeCode}}" name="location_{{$localeCode}}"
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
                                class="form-control col-md-7 col-xs-12"></textarea>
                        </div>
                    </div>
                @endforeach

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" >الصور </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="file" multiple  name="photo[]"
                            class="form-control col-md-7 col-xs-12"></input>
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
