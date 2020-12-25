@extends('layouts.master')
@section('content')


    <!--===================================================-->
    <div class="invoice-wrapper">
        <section class="invoice-container">
            <div class="invoice-inner">
                <div class="row">
                    <div class="col-xs-6 img">
                        <img src="{{asset('images/logo.png')}}" style="width:50%">
                    </div>
                    <div class="col-xs-6 text-right">
                        <span class="ltr" style="font-size: 20px"> {{__('ايصال دفع نقديه رقم')}}#{{$voucher->number}} </span>

                    </div>
                </div>

                <hr/>

                <div class="row">
                    <div  class="col-xs-12 text-right">
                        <span style="font-size:30px">  {{__('دفعنا نحن شركه:')}}  </span>
                        <span style="font-size: 20px">  {{__('Tarek Pack')}}  </span>

                        <span style="float: left;font-size:20px;text-align:right;">{{__('بتاريخ:')}} {{$voucher->created_at->format('d/m/Y')}} </span>

                    </div>
                </div>

                <div class="purchers">
                    <div class="item2 text-right">
                        <h3>
                            {{__('الي السيد:')}}
                            @if($voucher->supplier_id)
                                {{ $voucher->supplier->name }}
                            @elseif($voucher->employee_id)
                                {{ $voucher->employee->name }}
                            @else
                                {{ $voucher->To }}
                             @endif

                        </h3>
                        <h3> {{__('مقابل:')}} {{$voucher->paid_for}} </h3>


                    </div>
                    <div  class="item2">
                        <h3> {{__('مبلغ وقدره:')}} {{ $voucher->amount }}  </h3>
                        <h2 style="position: absolute;left:40px">
                            المستلم
                        </h2>
                    </div>

                </div>
                <div>

                </div>
                <div class="clr"></div>

                <div class="text-center no-print">
                    <a class="btn btn-primary btn-lg" onClick="jQuery('#page-content').print()">
                        <i class="fa fa-print"></i> Print
                    </a>
                </div>
            </div>
        </section>
    </div>
    <!--===================================================-->



@stop

@section('scripts')

    <script>

        $('#table').footable() ;
        $('#table').dataTable( {
            "responsive": false,
            "language": {
                "paginate": {
                    "previous": '<i class="fa fa-angle-left"></i>',
                    "next": '<i class="fa fa-angle-right"></i>'
                }
            }
        } );


    </script>

@stop







{{--@extends('layouts.master')--}}

{{--@section('content')--}}


{{--    <!--===================================================-->--}}
{{--    <div class="invoice-wrapper">--}}
{{--        <section class="invoice-container">--}}
{{--            <div class="invoice-inner">--}}
{{--                <div class="row">--}}
{{--                    <div class="col-xs-12">--}}
{{--                        <img src="{{asset('images/logo.png')}}" style="width:20%">--}}
{{--                        <span style="text-align: center">ايصال استلام نقديه رقم {{$voucher->number}}</span>--}}
{{--                    </div>--}}
{{--                    --}}{{--                    <div class="col-xs-6 text-right">--}}

{{--                    --}}{{--                    </div>--}}
{{--                </div>--}}
{{--                <hr/>--}}
{{--                <div class="row">--}}
{{--                    <div class="col-xs-6">--}}
{{--                        <address>--}}
{{--                            <strong>Billed To:</strong><br>--}}
{{--                            @if($voucher->supplier_id)--}}
{{--                                {{ $voucher->supplier->name }}--}}
{{--                            @elseif($voucher->employee_id)--}}
{{--                                {{ $voucher->employee->name }}--}}
{{--                            @else--}}
{{--                                {{ $voucher->for }}--}}
{{--                            @endif--}}
{{--                            <br>--}}


{{--                        </address>--}}
{{--                    </div>--}}

{{--                </div>--}}

{{--                <div class="row">--}}
{{--                    <div class="col-md-12 pad-top">--}}
{{--                        <div class="panel panel-default">--}}
{{--                            <div class="panel-heading">--}}
{{--                                <h3 class="panel-title">Order summary</h3>--}}
{{--                            </div>--}}
{{--                            <div class="panel-body">--}}
{{--                                <div class="table-responsive">--}}
{{--                                    <table class="table table-condensed">--}}
{{--                                        <thead>--}}
{{--                                        <tr>--}}
{{--                                            <th >{{ __('Number') }}</th>--}}
{{--                                            <th >{{ __('Category') }}</th>--}}
{{--                                            <th >{{ __('Amount') }}</th>--}}
{{--                                            <th>{{__('User')}}</th>--}}
{{--                                            <th>{{__('To')}}</th>--}}
{{--                                            --}}{{--                                            <td><strong>Item</strong></td>--}}
{{--                                            --}}{{--                                            <td class="text-center"><strong>Price</strong></td>--}}
{{--                                            --}}{{--                                            <td class="text-center"><strong>Quantity</strong></td>--}}
{{--                                            --}}{{--                                            <td class="text-center"><strong>Totals</strong></td>--}}
{{--                                        </tr>--}}
{{--                                        </thead>--}}
{{--                                        <tbody>--}}
{{--                                        <tr>--}}
{{--                                            <td>{{ $voucher->category->name }}</td>--}}
{{--                                            <td>{{ $voucher->amount }}</td>--}}
{{--                                            <td>{{ $voucher->user->name }}</td>--}}
{{--                                            @if($voucher->supplier_id)--}}
{{--                                                <td>{{ $voucher->supplier->name }}</td>--}}
{{--                                            @elseif($voucher->employee_id)--}}
{{--                                                <td>{{ $voucher->employee->name }}</td>--}}
{{--                                            @else--}}
{{--                                                <td>{{ $voucher->to }}</td>--}}
{{--                                            @endif--}}

{{--                                        </tr>--}}

{{--                                        </tbody>--}}
{{--                                    </table>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="text-center no-print">--}}
{{--                    <a class="btn btn-primary btn-lg" onClick="jQuery('#page-content').print()">--}}
{{--                        <i class="fa fa-print"></i> Print--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </section>--}}
{{--    </div>--}}
{{--    <!--===================================================-->--}}



{{--@stop--}}

{{--@section('scripts')--}}

{{--    <script>--}}

{{--        $('#table').footable() ;--}}
{{--        $('#table').dataTable( {--}}
{{--            "responsive": false,--}}
{{--            "language": {--}}
{{--                "paginate": {--}}
{{--                    "previous": '<i class="fa fa-angle-left"></i>',--}}
{{--                    "next": '<i class="fa fa-angle-right"></i>'--}}
{{--                }--}}
{{--            }--}}
{{--        } );--}}


{{--    </script>--}}

{{--@stop--}}


