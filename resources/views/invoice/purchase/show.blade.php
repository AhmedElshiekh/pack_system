@extends('layouts.master')

@section('content')

    <div class="invoice-wrapper">
        <section class="invoice-container">
            <div class="invoice-inner">
                <div class="row">
                    <div class="col-xs-6 img">
                        <img src="{{asset('images/logo.png')}}" style="width:50%">
                    </div>
                    <div class="col-xs-6 text-right">
                        <h3 class="ltr"> {{$invoice->number}}#   {{__('رقم الفاتوره')}} </h3>
                    </div>
                </div>
                <hr/>
                <div class="row">
                    <div class="col-xs-12">
                        <address>
                            <strong>{{__('Billed To')}}</strong><br>
                            @if($invoice->customer_id)
                                {{ $invoice->customer->name }}
                            @elseif($invoice->supplier_id)
                                {{ $invoice->supplier->name }}
                            @endif
                            <br>
                            @if($invoice->customer_id)
                                {{ $invoice->customer->address }}
                            @elseif($invoice->supplier_id)
                                {{ $invoice->supplier->address }}
                            @endif

                        </address>
                        <strong>{{__('Paid')}}</strong> {{$invoice->paid}}<br>
                        <strong>{{__('Remaining')}}</strong> {{$invoice->remaining}}
                    </div>


                </div>

                <div class="row">
                    <div class="col-md-12 pad-top">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">{{__('Order summary')}}</h3>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-condensed">
                                        <thead>
                                        <tr>
                                            <td><strong>{{__('Item')}}</strong></td>
                                            <td class="text-center"><strong>{{__('المقاس')}}</strong></td>
                                            <td class="text-center"><strong>{{__('Price')}}</strong></td>
                                            <td class="text-center"><strong>{{__('الوزن')}}</strong></td>
                                            <td class="text-center"><strong>{{__('Quantity')}}</strong></td>
                                            <td class="text-center"><strong>{{__('Total')}}</strong></td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($invoice->items as $item)
{{--                                            @dd($item)--}}
                                            <tr>
                                                <td>{{$item->name}}</td>
                                                <td class="text-center">{{$item->size->name}}</td>
                                                <td class="text-center">{{$item->pivot->price}}</td>
                                                <td class="text-center">{{$item->pivot->weight}}</td>
                                                <td class="text-center">{{$item->pivot->quantity}}</td>
                                                <td class="text-center">{{$item->pivot->total}}</td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td class="no-line"></td>
                                            <td class="no-line"></td>
                                            <td class="no-line text-center"><strong>{{__('Total')}}</strong></td>
                                            <td class="no-line text-center">{{$invoice->total}}</td>
                                        </tr>
                                        <tr>
                                            <td class="no-line"></td>
                                            <td class="no-line"></td>
                                            <td class="no-line text-center"><strong>{{__('Discount')}}</strong></td>
                                            <td class="no-line text-center">{{$invoice->discount}}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center no-print">
                    <a class="btn btn-primary btn-lg" onClick="jQuery('#page-content').print()">
                        <i class="fa fa-print"></i> Print
                    </a>
                </div>
            </div>
        </section>
    </div>


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

