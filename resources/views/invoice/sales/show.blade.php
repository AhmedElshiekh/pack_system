@extends('layouts.master')

@section('content')


    <!--===================================================-->

    <div class="invoice-wrapper" >
        <section class="invoice-container">
            <div class="invoice-inner">
                <div class="row">
                    <div class="col-xs-6 img">
                        <img src="{{asset('images/logo.png')}}" style="width:50%">
                    </div>
                </div>
                <div class=" text-center">
                    <h3 class="ltr"> {{__('فاتوره مبيعات رقم')}} {{$invoice->number}}#   </h3>
                </div>
                <hr/>
                <div class="row">
                    <div  class="col-xs-12 text-right">
                        <span style="font-size:30px">  {{__('استلمنا نحن شركه:')}}  </span>
                        <span style="font-size: 20px">  Tarek Pack  </span>

                        <span style="float: left;font-size:20px;text-align:right;position: absolute;right: 500px">{{__('بتاريخ:')}} {{$invoice->created_at->format('d/m/Y')}} </span>

                    </div>
                </div>

                <div class="purchers">
                    {{--                                <div class="item2 text-right">--}}
                    <h3>
                        {{__('من السيد:')}}
                        @if($invoice->customer_id)
                            {{ $invoice->customer->name }}
                        @elseif($invoice->supplier_id)
                            {{ $invoice->supplier->name }}
                        @endif

                    </h3>
                    <h3> {{__('مبلغ وقدره:')}} {{$invoice->paid}} </h3>
                    <h3> {{__('متبقي')}} {{$invoice->remaining}} </h3>
                    {{--                                </div>--}}

                </div>
                <div class="row">
                    <div class="col-md-12 pad-top">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">{{__('مقابل')}}</h3>
                            </div>
                            <div class="panel-body ">
                                <div class="table-responsive">
                                    <table class="table table-condensed">
                                        <thead>
                                        <tr>
                                            <td><strong>{{__('Item')}}</strong></td>
                                            <td class="text-center"><strong>{{__('سعر القطعه')}}</strong></td>
                                            <td class="text-center"><strong>{{__('Quantity')}}</strong></td>
                                            <td class="text-center"><strong>{{__('Total')}}</strong></td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($invoice->products as $item)
                                            <tr>
                                                <td>{{$item->name}}</td>
                                                <td class="text-center">{{$item->totalItem}}</td>
                                                <td class="text-center">{{$item->pivot->quantity}}</td>
                                                <td class="text-center">{{$item->pivot->total}}</td>
                                            </tr>
                                        @endforeach

                                        <tr>
                                            <td class="no-line"></td>
                                            <td class="no-line"></td>
                                            <td class="no-line text-center"><strong>{{__('Discount')}}</strong></td>
                                            <td class="no-line text-center">{{$invoice->discount}}</td>
                                        </tr>
                                        <tr>
                                            <td class="no-line"></td>
                                            <td class="no-line"></td>
                                            <td class="no-line text-center"><strong>{{__('Total')}}</strong></td>
                                            <td class="no-line text-center">{{$invoice->total}}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="purchers">
                    {{--                                <div class="item2 text-right">--}}


                    <h3 class="text-right">{{__('الي عنوان:')}}
                        @if($invoice->customer_id)
                            {{ $invoice->customer->address }}
                        @elseif($invoice->supplier_id)
                            {{ $invoice->supplier->address }}
                        @endif
                    </h3>
                    @if($invoice->customer_id)
                    <h3>{{__('رقم تلفيون العميل:')}}
                        {{ $invoice->customer->phone1 }}

                    </h3>
                    @endif

                </div>
                <div class="clr "></div>

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
        });

    </script>

@stop


