@extends('layouts.main')
@section('content')

<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2> طلبات الشقق الفندقية </h2>
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
                                    <th>من تاريخ</th>
                                    <th>الي تاريخ</th>
                                    <th>حالة الطلب</th>
                                    <th>العمليات</th>
                                </tr>
                            </thead>


                            <tbody>
                                @foreach ($apprtment_request as $item)
                                <tr>
                                    <td>{{$index ++}}</td>
                                    <td>{{$item->appartment->name_ar}} - {{$item->appartment->name_en}}</td>
                                    <td>{{$item->appartment->hotel->name_ar}} - {{$item->appartment->hotel->name_en}}</td>
                                    <td>{{$item->from}}</td>
                                    <td>{{$item->to}}</td>
                                    <td>@livewire('change-state-appartmen-request', ['request_id' => $item->id], key($item->id))</td>


                                    <td>
                                        <form action="{{route('appartment.destroy',$item->id)}}" method="POST">
                                            {{ csrf_field()}}
                                            {{ method_field('delete') }}
                                            <!-- Data Of user -->
                                            <button type="button" class="btn btn-primary sm-btn-sm btn-sm"
                                                data-toggle="modal" data-target="#user-{{$item->id}}"><i
                                                    class="fa fa-user"></i>
                                            </button>
                                            <!-- Data Of request -->
                                            <button type="button" class="btn btn-primary sm-btn-sm btn-sm"
                                                data-toggle="modal" data-target="#show-{{$item->id}}"><i
                                                    class="fa fa-eye"></i>
                                            </button>
                                            {{-- <button type="button"
                                                class="show_confirm  btn btn-danger sm-btn-sm btn-sm"><i
                                                    class="fa fa-remove "></i></button> --}}

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
                                                <h4 class="modal-title" id="myModalLabel">تفاصيل طلب الشقة الفندقية</h4>
                                            </div>
                                            <div class="modal-body">
                                                <ul class="list-unstyled msg_list">
                                                    <li>
                                                        <a>
                                                            <span>
                                                                <span>اسم الشقة الفندقية</span>
                                                            </span>
                                                            <span class="message">
                                                                {{$item->appartment->name_ar}} - {{$item->appartment->name_en}}
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a>
                                                            <span>
                                                                <span>الفندق</span>
                                                            </span>
                                                            <span class="message">
                                                                {{$item->appartment->hotel->name_ar}} - {{$item->appartment->hotel->name_en}}
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a>
                                                            <span>
                                                                <span>نوع الغرفة</span>
                                                            </span>
                                                            <span class="message">
                                                                    {{$item->appartment->type_appartment->name_ar}} -{{$item->appartment->type_appartment->name_en}}
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
                                                                <span>تاريخ القدوم</span>
                                                            </span>
                                                            <span class="message">
                                                                {{$item->from}}
                                                            </span>
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a>
                                                            <span>
                                                                <span>تاريخ المغادرة</span>
                                                            </span>
                                                            <span class="message">
                                                                {{$item->to}}
                                                            </span>
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a>
                                                            <span>
                                                                <span>عدد الايام</span>
                                                            </span>
                                                            <span class="message">
                                                                {{$item->days}}
                                                            </span>
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a>
                                                            <span>
                                                                <span>تاريخ الطلب</span>
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
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!-- data of user -->
                                <div class="modal fade" id="user-{{$item->id}}" tabindex="-1" role="dialog"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-md">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"><span
                                                        aria-hidden="true">×</span>
                                                </button>
                                                <h4 class="modal-title" id="myModalLabel">تفاصيل صاحب الطلب و بيانات الدفع </h4>
                                            </div>
                                            <div class="modal-body">
                                                <ul class="list-unstyled msg_list">
                                                    <li>
                                                        <a>
                                                            <span>
                                                                <span> الاسم </span>
                                                            </span>
                                                            <span class="message">
                                                                {{$item->user->name}}
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a>
                                                            <span>
                                                                <span>البريد الالكتروني</span>
                                                            </span>
                                                            <span class="message">
                                                                {{$item->user->email}}
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a>
                                                            <span>
                                                                <span>رقم الهاتف </span>
                                                            </span>
                                                            <span class="message">
                                                                    {{$item->user->phone}}
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a>
                                                            <span>
                                                                <span>الاثبات / الهوية</span>
                                                            </span>
                                                            <span class="message">
                                                                {{$item->user->identification}}
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a>
                                                            <span>
                                                                <span>صورة الاثبات / الهوية</span>
                                                            </span>
                                                            <span class="message">
                                                                @if ($item->user->identification_photo !='')
                                                                    <a href="{{ url('/uploads/identification/'.$item->user->identification_photo)}}" target="_blank">اضغط هنا  </a>
                                                                @else
                                                                    لا يوجد صورة حاليا
                                                                @endif

                                                            </span>
                                                        </a>
                                                    </li>


                                                    <li>
                                                        <a>
                                                            <span>
                                                                <span>تاريخ الانضمام</span>
                                                            </span>
                                                            <span class="message">
                                                                {{$item->user->created_at}}
                                                            </span>
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a>
                                                            <span>
                                                                <span>صورة الاشعار </span>
                                                            </span>
                                                            <span class="message">
                                                                @if ($item->notice_photo !='')
                                                                    <a href="{{ url('/uploads/notice_photo/'.$item->notice_photo)}}" target="_blank">اضغط هنا  </a>
                                                                @else
                                                                    لا يوجد اشعار حاليا
                                                                @endif

                                                            </span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default"
                                                    data-dismiss="modal">اغلاق</button>
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
