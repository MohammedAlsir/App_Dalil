@extends('layouts.main')
@section('content')


<div class="col-md-6 col-sm-6 col-xs-6">
    <div class="x_panel">
        <div class="x_title">
            <h2> الولايات السودانية
                {{-- <small>بيانات الفندق الاساسية</small> --}}
            </h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <br>
            <form method="POST" action="{{route('city.store')}}" data-parsley-validate=""
                class="form-horizontal form-label-left">
                @csrf
                <input type="hidden" name="type" value="state">

                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name_{{$localeCode}}">الولاية
                        <span class="required">*<i class="flag">{!! @Helper::languageName($localeCode) !!}</i></span>
                    </label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                        <input type="text" required id="name_{{$localeCode}}" name="state_name_{{$localeCode}}"
                            class="form-control col-md-7 col-xs-12">
                    </div>
                </div>
                @endforeach



                <div class="ln_solid"></div>
                <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3 text-left">
                        {{-- <button type="submit" class="btn btn-primary">انصراف</button> --}}
                        <button type="submit" class="btn btn-success">اضافة</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>


<div class="col-md-6 col-sm-6 col-xs-6">
    <div class="x_panel">
        <div class="x_title">
            <h2> مدن الولايات السودانية
                {{-- <small>بيانات الفندق الاساسية</small> --}}
            </h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <br>
            <form method="POST" action="{{route('city.store')}}" data-parsley-validate=""
                class="form-horizontal form-label-left">
                @csrf
                <input type="hidden" name="type" value="city">

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">الولاية
                        <span class="required">*</span>
                    </label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                        <select required name="state_id" class="form-control col-md-7 col-xs-12">
                            <option value="">اختر الولاية</option>
                            @foreach ($state as $item)
                            <option value="{{$item->id}}">{{$item->name_ar}} - {{$item->name_en}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name_{{$localeCode}}">المدينة
                        <span class="required">*<i class="flag">{!! @Helper::languageName($localeCode) !!}</i></span>
                    </label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                        <input type="text" required id="name_{{$localeCode}}" name="city_name_{{$localeCode}}"
                            class="form-control col-md-7 col-xs-12">
                    </div>
                </div>
                @endforeach



                <div class="ln_solid"></div>
                <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3 text-left">
                        {{-- <button type="submit" class="btn btn-primary">انصراف</button> --}}
                        <button type="submit" class="btn btn-success">اضافة</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

<!-- all data -->
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2> الولايات السودانية </h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card-box table-responsive">


                        <table id="datatable-responsive" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>الرقم</th>
                                    <th>الولاية</th>
                                    <th>عدد المدن</th>
                                    {{-- <th>تاريخ الاضافة</th> --}}
                                    <th>العمليات</th>
                                </tr>
                            </thead>


                            <tbody>
                                @foreach ($state as $item)
                                <tr>
                                    <td>{{$index_state ++}}</td>
                                    <td>{{$item->name_ar}} - {{$item->name_en}}</td>
                                    <td>{{$item->cities()->count()}}</td>
                                    <td>
                                        <form action="{{route('city.destroy',$item->id)}}" method="POST">
                                            {{ csrf_field()}}
                                            {{ method_field('delete') }}
                                            <input type="hidden" name="type" value="delete_state">

                                            <a  class="btn btn-success sm-btn-sm btn-sm" data-toggle="modal"
                                                data-target=".state_{{$item->id}}">
                                                <i class="fa fa-edit "></i>
                                            </a>
                                            <!-- Edit Model  -->

                                            <!-- Edit Model -->

                                            <button type="button"
                                                class="show_confirm  btn btn-danger sm-btn-sm btn-sm"><i
                                                    class="fa fa-remove "></i></button>

                                        </form>

                                    </td>
                                </tr>
                                <div class="modal fade state_{{$item->id}}" tabindex="-1" role="dialog"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-md">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"><span
                                                        aria-hidden="true">×</span>
                                                </button>
                                                <h4 class="modal-title" id="myModalLabel">{{$item->name_ar}} -
                                                    {{$item->name_en}}</h4>
                                            </div>
                                            <div class="modal-body row">
                                                <form method="POST" action="{{route('city.update',$item->id)}}"
                                                    data-parsley-validate="" class="form-horizontal form-label-left">
                                                    @csrf
                                                    @method('put')
                                                    <input type="hidden" name="type" value="state_edit">

                                                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode
                                                    => $properties)
                                                    <div class="form-group row">
                                                        <label class="control-label  col-md-3 col-sm-3 col-xs-12"
                                                            for="name_{{$localeCode}}">الولاية
                                                            <span class="required">*<i class="flag">{!!
                                                                    @Helper::languageName($localeCode) !!}</i></span>
                                                        </label>
                                                        <div class="col-md-7 col-sm-7 col-xs-12">
                                                            <input type="text" required id="name_{{$localeCode}}"
                                                                name="state_name_{{$localeCode}}"
                                                                value="{!!$item->{'name_'.$localeCode}!!}"
                                                                class="form-control col-md-7 col-xs-12">
                                                        </div>
                                                    </div>
                                                    @endforeach
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default"
                                                    data-dismiss="modal">اغلاق</button>
                                                <button type="submit" class="btn btn-primary">تعديل</button>
                                            </div>
                                            </form>


                                        </div>
                                    </div>
                                </div>
                                @endforeach


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2> المدن السودانية </h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card-box table-responsive">


                        <table id="datatable-keytable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>الرقم</th>
                                    <th>اسم المدينة</th>
                                    <th>الولاية</th>
                                    {{-- <th>تاريخ الاضافة</th> --}}
                                    <th>العمليات</th>
                                </tr>
                            </thead>


                            <tbody>
                                @foreach ($city as $item)
                                <tr>
                                    <td>{{$index_city ++}}</td>
                                    <td>{{$item->name_ar}} - {{$item->name_en}}</td>
                                    <td>{{$item->state->name_ar}} - {{$item->state->name_en}}</td>
                                    <td>
                                        <form action="{{route('city.destroy',$item->id)}}" method="POST">
                                            {{ csrf_field()}}
                                            {{ method_field('delete') }}
                                            <input type="hidden" name="type" value="delete_city">

                                            <a  class="btn btn-success sm-btn-sm btn-sm" data-toggle="modal"
                                                data-target=".city_{{$item->id}}">
                                                <i class="fa fa-edit "></i>
                                            </a>

                                            <button type="button"
                                                class="show_confirm  btn btn-danger sm-btn-sm btn-sm"><i
                                                    class="fa fa-remove "></i></button>

                                        </form>

                                    </td>
                                </tr>
                                <div class="modal fade city_{{$item->id}}" tabindex="-1" role="dialog"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-md">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"><span
                                                        aria-hidden="true">×</span>
                                                </button>
                                                <h4 class="modal-title" id="myModalLabel">{{$item->name_ar}} -
                                                    {{$item->name_en}}</h4>
                                            </div>
                                            <div class="modal-body row">
                                                <form method="POST" action="{{route('city.update',$item->id)}}"
                                                    data-parsley-validate="" class="form-horizontal form-label-left">
                                                    @csrf
                                                    @method('put')
                                                    <input type="hidden" name="type" value="city_edit">

                                                    <div class="form-group row">
                                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">الولاية
                                                            <span class="required">*</span>
                                                        </label>
                                                        <div class="col-md-7 col-sm-7 col-xs-12">
                                                            <select required name="state_id" class="form-control col-md-7 col-xs-12">
                                                                <option value="">اختر الولاية</option>
                                                                @foreach ($state as $single)
                                                                <option {{$single->id == $item->state_id ? "selected":""}}  value="{{$single->id}}">{{$single->name_ar}} - {{$single->name_en}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode
                                                    => $properties)
                                                    <div class="form-group row">
                                                        <label class="control-label  col-md-3 col-sm-3 col-xs-12"
                                                            for="name_{{$localeCode}}">المدينة
                                                            <span class="required">*<i class="flag">{!!
                                                                    @Helper::languageName($localeCode) !!}</i></span>
                                                        </label>
                                                        <div class="col-md-7 col-sm-7 col-xs-12">
                                                            <input type="text" required id="name_{{$localeCode}}"
                                                                name="city_name_{{$localeCode}}"
                                                                value="{!!$item->{'name_'.$localeCode}!!}"
                                                                class="form-control col-md-7 col-xs-12">
                                                        </div>
                                                    </div>
                                                    @endforeach
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default"
                                                    data-dismiss="modal">اغلاق</button>
                                                <button type="submit" class="btn btn-primary">تعديل</button>
                                            </div>
                                            </form>


                                        </div>
                                    </div>
                                </div>
                                @endforeach


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
