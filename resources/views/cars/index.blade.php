@extends('layouts.main')
@section('content')

<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2> السيارات </h2>
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
                                    <th>اسم السيارة</th>
                                    <th>نوع السيارة</th>
                                    <th>عدد الركاب</th>
                                    <th>السعر</th>
                                    <th>العمليات</th>
                                </tr>
                            </thead>


                            <tbody>
                                @foreach ($cars as $item)
                                <tr>
                                    <td>{{$index ++}}</td>
                                    <td>{{$item->name_ar}} - {{$item->name_en}}</td>
                                    <td>
                                        @switch($item->type)
                                            @case(1)
                                                صغيرة - small
                                                @break
                                            @case(2)
                                                متوسطة - Medium
                                                @break
                                            @case(3)
                                                كبيرة - Big
                                                @break
                                            @case(4)
                                                فاخرة - Deluxe
                                                @break
                                            @case(5)
                                                عائلية - Familial
                                                @break
                                            @case(6)
                                                مراسم - Ceremony
                                                @break
                                        @endswitch
                                    </td>
                                    <td>{{$item->number_of_passengers}}</td>
                                    <td>{{number_format($item->day_price)}}</td>

                                    {{-- <td>{{$item->created_at}}</td> --}}
                                    <td>
                                        <form action="{{route('cars.destroy',$item->id)}}" method="POST">
                                            {{ csrf_field()}}
                                            {{ method_field('delete') }}
                                            <button type="button" class="btn btn-primary sm-btn-sm btn-sm"
                                                data-toggle="modal" data-target="#show-{{$item->id}}"><i
                                                    class="fa fa-eye"></i>
                                            </button>
                                            <a href="{{route('cars.edit',$item->id)}}" class="btn btn-success sm-btn-sm btn-sm"><i
                                                    class="fa fa-edit "></i></a>
                                            <button type="button" class="show_confirm  btn btn-danger sm-btn-sm btn-sm"><i
                                                    class="fa fa-remove "></i></button>

                                        </form>

                                    </td>
                                </tr>
                                <div class="modal fade" id="show-{{$item->id}}" tabindex="-1" role="dialog"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-md">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"><span
                                                        aria-hidden="true">×</span>
                                                </button>
                                                <h4 class="modal-title" id="myModalLabel">تفاصيل السيارة </h4>
                                            </div>
                                            <div class="modal-body">
                                                <ul class="list-unstyled msg_list">
                                                    <li>
                                                        <a>
                                                            <span>
                                                                <span> الاسم </span>
                                                            </span>
                                                            <span class="message">
                                                                {{$item->name_ar}} - {{$item->name_en}}
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a>
                                                            <span>
                                                                <span>النوع</span>
                                                            </span>
                                                            <span class="message">
                                                                @switch($item->type)
                                                                    @case(1)
                                                                        صغيرة - small
                                                                        @break
                                                                    @case(2)
                                                                        متوسطة - Medium
                                                                        @break
                                                                    @case(3)
                                                                        كبيرة - Big
                                                                        @break
                                                                    @case(4)
                                                                        فاخرة - Deluxe
                                                                        @break
                                                                    @case(5)
                                                                        عائلية - Familial
                                                                        @break
                                                                    @case(6)
                                                                        مراسم - Ceremony
                                                                        @break
                                                                @endswitch

                                                            </span>
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a>
                                                            <span>
                                                                <span>ناقل الحركة</span>
                                                            </span>
                                                            <span class="message">
                                                                @switch($item->motion_vector)
                                                                    @case(1)
                                                                        اوتوماتيك - Automatic
                                                                        @break
                                                                    @case(2)
                                                                        عادي - Normal
                                                                        @break
                                                                @endswitch
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a>
                                                            <span>
                                                                <span>عدد الركاب</span>
                                                            </span>
                                                            <span class="message">
                                                                    {{$item->number_of_passengers}}
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a>
                                                            <span>
                                                                <span>عدد الابواب</span>
                                                            </span>
                                                            <span class="message">
                                                                {{$item->number_of_doors}}
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a>
                                                            <span>
                                                                <span>سعر السيارة لليوم الواحد</span>
                                                            </span>
                                                            <span class="message">
                                                                {{number_format($item->day_price)}}
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a>
                                                            <span>
                                                                <span>سعر السائق</span>
                                                            </span>
                                                            <span class="message">
                                                                @if ($item->driver_price)
                                                                    {{number_format($item->driver_price)}}
                                                                @else
                                                                    لا بوجد
                                                                @endif

                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a>
                                                            <span>
                                                                <span>صورة  السيارة</span>
                                                            </span>
                                                            <span class="message">
                                                                @if ($item->image)
                                                                    <img style="width: 150px; height: 150px;" src="{{ url('/uploads/cars/'.$item->image->photo)}}" >
                                                                @else
                                                                    لا يوجد صورة حاليا
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
                                                                {{$item->features_ar}}
                                                            </span>
                                                            <span class="message">
                                                                {{$item->features_en}}
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
