@extends('layouts.main')
@section('content')
<style>
.checked {
  color: orange;
}
</style>
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2> بيانات الوحدة السكنية </h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                <div class="profile_img">
                    {{-- <div id="crop-avatar">
                        <!-- Current avatar -->
                        <img class="img-responsive avatar-view"
                            src="https://www.gravatar.com/avatar/c7a79167b6d736630e3a64e206e22a5a/?s=220" alt="Avatar"
                            title="Change the avatar">
                    </div> --}}
                </div>
                <h3>{{$unit->name_ar}}</h3>
                <h3>{{$unit->name_en}}</h3>

                <ul class="list-unstyled user_data">
                    <li><i class="fa fa-map-marker user-profile-icon"></i>
                        {{$unit->city->state->name_ar}} - {{$unit->city->name_ar}}
                    </li>
                    <li><i class="fa fa-map-marker user-profile-icon"></i>
                        {{$unit->city->state->name_en}} - {{$unit->city->name_en}}

                    </li>


                    <li> {{$unit->location_ar}}</li>
                    <li> {{$unit->location_en}}</li>

                    {{-- <li class="m-top-xs">
                        <i class="fa fa-external-link user-profile-icon"></i>
                        <a href="https://morteza-karimi.ir/" target="_blank">morteza-karimi.ir</a>
                    </li> --}}
                </ul>

                {{-- <a class="btn btn-success"><i class="fa fa-edit m-right-xs"></i>&nbsp; پروفایل</a> --}}
                <a href="{{route('units.edit',$unit->id)}}" class="btn btn-success"><i class="fa fa-edit m-right-xs"></i>&nbsp;تعديل بيانات الوحدة السكنية</a>

                <br>

            </div>
            <div class="col-md-9 col-sm-9 col-xs-12">

                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class=""><a href="#features" id="home-tab" role="tab"
                                data-toggle="tab" aria-expanded="false">مميزات الوحدة السكنية</a>
                        </li>
                        <li role="presentation" class="active"><a href="#appartment" role="tab" id="profile-tab"
                                data-toggle="tab" aria-expanded="true">الشقق</a>
                        </li>
                    </ul>
                    <div id="myTabContent" class="tab-content">
                        <div role="tabpanel" class="tab-pane fade" id="features" aria-labelledby="home-tab">

                            <!-- start recent activity -->
                            <ul class="messages">
                                <li>
                                    <div class="message_wrapper">
                                        <p class="message">{{$unit->features_ar}} </p>
                                    </div>
                                </li>
                                <li>
                                    <div class="message_wrapper">
                                        <p class="message">{{$unit->features_en}}</p>
                                    </div>
                                </li>
                            </ul>
                            <!-- end recent activity -->

                        </div>
                        <div role="tabpanel" class="tab-pane fade active in" id="appartment"
                            aria-labelledby="profile-tab">

                            <!-- start user projects -->

                            <table class="data table table-striped">
                            <thead>
                                <tr>
                                    <th>الرقم</th>
                                    <th>اسم الغرفة</th>
                                    <th>عدد الغرف</th>
                                    {{-- <th>النوع</th> --}}
                                    {{-- <th>سعر الليلة</th> --}}
                                    {{-- <th>تاريخ الاضافة</th> --}}
                                    <th>العمليات</th>
                                </tr>
                            </thead>


                            <tbody>
                                @foreach ($unit->appartment as $item)
                                <tr>
                                    <td>{{$index ++}}</td>
                                    <td>{{$item->name_ar}} - {{$item->name_ar}}</td>
                                    <td>{{$item->number_of_rooms}}</td>
                                    {{-- <td>{{$item->type_appartment->name_ar}} - {{$item->type_appartment->name_en}}
                                    </td> --}}
                                    {{-- <td>{{$item->night_price}}</td> --}}


                                    {{-- <td>{{$item->created_at}}</td> --}}
                                    <td>
                                        <form action="{{route('appartments.destroy',$item->id)}}" method="POST">
                                            {{ csrf_field()}}
                                            {{ method_field('delete') }}
                                            <button type="button" class="btn btn-primary sm-btn-sm btn-sm"
                                                data-toggle="modal" data-target="#show-{{$item->id}}"><i
                                                    class="fa fa-eye"></i>
                                            </button>
                                            <a href="{{route('appartments.edit',$item->id)}}"
                                                class="btn btn-success sm-btn-sm btn-sm"><i class="fa fa-edit "></i></a>
                                            <button type="button"
                                                class="show_confirm  btn btn-danger sm-btn-sm btn-sm"><i
                                                    class="fa fa-remove "></i></button>

                                        </form>

                                    </td>
                                </tr>
                                <!-- Model Show -->
                                <!-- Modal -->


                                <!-- Modal -->
                                <div class="modal fade" id="show-{{$item->id}}" tabindex="-1" role="dialog"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-md">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"><span
                                                        aria-hidden="true">×</span>
                                                </button>
                                                <h4 class="modal-title" id="myModalLabel">بيانات الشقة السكنية</h4>
                                            </div>
                                            <div class="modal-body">
                                                <ul class="list-unstyled msg_list">
                                                    <li>
                                                        <a>
                                                            <span>
                                                                <span>اسم الشقة السكنية</span>
                                                            </span>
                                                            <span class="message">
                                                                {{$item->name_ar}} - {{$item->name_en}}
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a>
                                                            <span>
                                                                <span>الوحدة السكنية</span>
                                                            </span>
                                                            <span class="message">
                                                                {{$item->hotel->name_ar}} - {{$item->hotel->name_en}}
                                                            </span>
                                                        </a>
                                                    </li>
                                                    {{-- <li>
                                                        <a>
                                                            <span>
                                                                <span>الجناح</span>
                                                            </span>
                                                            <span class="message">
                                                                    {{$item->type_appartment->name_ar}} -{{$item->type_appartment->name_en}}
                                                            </span>
                                                        </a>
                                                    </li> --}}
                                                    <li>
                                                        <a>
                                                            <span>
                                                                <span>الطابق</span>
                                                            </span>
                                                            <span class="message">
                                                                @if ($item->floor_ar || $item->floor_en)
                                                                    {{$item->floor_ar}} -{{$item->floor_en}}
                                                                @else
                                                                    لا يوجد
                                                                @endif
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a>
                                                            <span>
                                                                <span>عدد الغرف</span>
                                                            </span>
                                                            <span class="message">
                                                                @if ($item->number_of_rooms)
                                                                    {{$item->number_of_rooms}}
                                                                @else
                                                                    لا يوجد
                                                                @endif
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a>
                                                            <span>
                                                                <span>المميزات</span>
                                                            </span>
                                                            <span class="message">
                                                                @if ($item->features_ar || $item->features_en)
                                                                    {{$item->features_ar}} - {{$item->features_en}}
                                                                @else
                                                                    لا يوجد
                                                                @endif

                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a>
                                                            <span>
                                                                <span>سعر الليلة</span>
                                                            </span>
                                                            <span class="message">
                                                                {{$item->night_price}}
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a>
                                                            <span>
                                                                <span>التخفيض</span>
                                                            </span>
                                                            <span class="message">
                                                                @if ($item->discount)
                                                                    {{$item->discount}}
                                                                @else
                                                                    لا يوجد
                                                                @endif

                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a>
                                                            <span>
                                                                <span>تاريخ الاضافة</span>
                                                            </span>
                                                            <span class="message">
                                                                {{$item->created_at}}
                                                            </span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default"
                                                    data-dismiss="modal">اغلاق</button>
                                                {{-- <button type="button" class="btn btn-primary">ذخیره
                                                    تغییرات</button> --}}
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                @endforeach


                            </tbody>
                        </table>
                            <!-- end user projects -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
