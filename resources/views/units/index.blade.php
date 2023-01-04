@extends('layouts.main')
@section('content')

<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2> الوحدات السكنية </h2>
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
                                    <th>اسم الوحدة</th>
                                    {{-- <th>عدد الغرف </th> --}}
                                    <th>الموقع</th>
                                    {{-- <th>تاريخ الاضافة</th> --}}
                                    <th>العمليات</th>
                                </tr>
                            </thead>


                            <tbody>
                                @foreach ($units as $item)
                                <tr>
                                    <td>{{$index ++}}</td>
                                    <td>{{$item->name_ar}} - {{$item->name_en}}</td>
                                    {{-- <td>{{$item->stars}}</td> --}}
                                    <td>{{$item->location_ar}} - {{$item->location_en}}</td>

                                    {{-- <td>{{$item->created_at}}</td> --}}
                                    <td>
                                        <form action="{{route('units.destroy',$item->id)}}" method="POST">
                                            {{ csrf_field()}}
                                            {{ method_field('delete') }}
                                            <a href="{{route('units.show',$item->id)}}" class="btn btn-primary sm-btn-sm btn-sm">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <a href="{{route('units.edit',$item->id)}}" class="btn btn-success sm-btn-sm btn-sm"><i
                                                    class="fa fa-edit "></i></a>
                                            <button type="button" class="show_confirm  btn btn-danger sm-btn-sm btn-sm"><i
                                                    class="fa fa-remove "></i></button>

                                        </form>

                                    </td>
                                </tr>
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
