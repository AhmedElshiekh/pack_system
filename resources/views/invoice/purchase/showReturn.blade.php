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
                        <h3>{{__('مرتجع مبيعات')}} #{{$return->number}}  </h3>

                    </div>
                </div>
                <hr/>
                <div class="row">
                    <div class="col-xs-12">
                        <address>
                            <strong>{{__('Billed To')}}:</strong><h4>{{$invoice->supplier->name}}</h4>
                            <h3>{{__('رقم الفاتوره')}}  #{{$invoice->number}}</h3>
                        </address>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-12 pad-top">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">{{__('invoice items')}}</h3>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-condensed">
                                        <thead>
                                        <tr>
                                            <td><strong>Item</strong></td>
                                            <td class="text-center"><strong>{{__('Price')}}</strong></td>
                                            <td class="text-center"><strong>{{__('Quantity')}}</strong></td>
                                            <td class="text-center"><strong>{{__('Total')}}</strong></td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            @foreach($invoice->items as $item)
                                                <td>{{$item->code}}</td>
                                                <td class="text-center">{{$item->pivot->price}}</td>
                                                <td class="text-center">{{$item->pivot->quantity}}</td>
                                                <td class="text-center">{{$item->pivot->total}}</td>

                                            @endforeach
                                        </tr>
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


