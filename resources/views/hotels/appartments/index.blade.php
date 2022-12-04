@extends('layouts.main')
@section('content')

<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2> الشقق الفندقية </h2>
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
                                    <th>اسم الغرفة</th>
                                    <th>اسم الفندق</th>
                                    {{-- <th>النوع</th> --}}
                                    {{-- <th>سعر الليلة</th> --}}
                                    {{-- <th>تاريخ الاضافة</th> --}}
                                    <th>العمليات</th>
                                </tr>
                            </thead>


                            <tbody>
                                @foreach ($hotel_appartment as $item)
                                <tr>
                                    <td>{{$index ++}}</td>
                                    <td>{{$item->name_ar}} - {{$item->name_en}}</td>
                                    <td>{{$item->hotel->name_ar}} - {{$item->hotel->name_en}}</td>
                                    {{-- <td>{{$item->type_appartment->name_ar}} - {{$item->type_appartment->name_en}}
                                    </td> --}}
                                    {{-- <td>{{$item->night_price}}</td> --}}


                                    {{-- <td>{{$item->created_at}}</td> --}}
                                    <td>
                                        <form action="{{route('appartment.destroy',$item->id)}}" method="POST">
                                            {{ csrf_field()}}
                                            {{ method_field('delete') }}
                                            <button type="button" class="btn btn-primary sm-btn-sm btn-sm"
                                                data-toggle="modal" data-target="#show-{{$item->id}}"><i
                                                    class="fa fa-eye"></i>
                                            </button>
                                            <a href="{{route('appartment.edit',$item->id)}}"
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
                                                <h4 class="modal-title" id="myModalLabel">بيانات الشقة الفندقية</h4>
                                            </div>
                                            <div class="modal-body">
                                                <ul class="list-unstyled msg_list">
                                                    <li>
                                                        <a>
                                                            <span>
                                                                <span>اسم الشقة الفندقية</span>
                                                            </span>
                                                            <span class="message">
                                                                {{$item->name_ar}} - {{$item->name_en}}
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a>
                                                            <span>
                                                                <span>الفندق</span>
                                                            </span>
                                                            <span class="message">
                                                                {{$item->hotel->name_ar}} - {{$item->hotel->name_en}}
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a>
                                                            <span>
                                                                <span>الجناح</span>
                                                            </span>
                                                            <span class="message">
                                                                {{-- @if ($item->type_appartment->name_ar && $item->type_appartment->name_en) --}}
                                                                    {{$item->type_appartment->name_ar}} -{{$item->type_appartment->name_en}}
                                                                {{-- @else --}}
                                                                    {{-- لا يوجد --}}
                                                                {{-- @endif --}}
                                                            </span>
                                                        </a>
                                                    </li>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
