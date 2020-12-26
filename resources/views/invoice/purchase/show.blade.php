<x-app-layout>

    @section('title',__('Invoice'))
    @section('header')
        <div class="">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{__("Invoice information")}}
            </h2>
        </div>
        <div class="">
            <a href="{{  URL::previous() }}" class="btn btn-sm btn-outline-secondary rounded-0"><i class="fa fa-arrow-left"></i> {{__('Back')}}</a>
        </div>
    @endsection


    <div class="invoice-wrapper p-15">
        <section class="invoice-container">
            <div class="invoice-inner">
                <div class="row">
                    <div class="col-8 img">
                        {{-- <img src="{{asset('images/logo.png')}}" style="width:50%"> --}}
                        <x-jet-authentication-card-logo class="block h-9 w-auto" />
                    </div>
                    <div class="col-4">
                        <h4 class=""> {{$invoice->number}}#  {{__('Invoice number')}} </h4>
                    </div>
                </div>
                <hr/>
                <div class="row">
                    <div class="col-xs-12">
                        <address>
                            <strong>{{__('Billed To')}} :</strong>
                            @if($invoice->customer_id)
                                {{ $invoice->customer->name }}
                            @elseif($invoice->supplier_id)
                                {{ $invoice->supplier->name }}
                            @endif
                            <br>
                            <strong>{{__('Address')}} :</strong>
                            @if($invoice->customer_id)
                                {{ $invoice->customer->address }}
                            @elseif($invoice->supplier_id)
                                {{ $invoice->supplier->address }}
                            @endif

                        </address>
                        <strong>{{__('Paid')}}</strong> : {{$invoice->paid}}<br>
                        <strong>{{__('Remaining')}}</strong> : {{$invoice->remaining}}
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 py-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">{{__('Order summary')}}</h3>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-condensed">
                                        <thead>
                                        <tr>
                                            <td class="text-center"><strong>#</strong></td>
                                            <td class="text-center border"><strong>{{__('Item')}}</strong></td>
                                            <td class="text-center border"><strong>{{__('Price')}}</strong></td>
                                            <td class="text-center border"><strong>{{__('weight')}}</strong></td>
                                            <td class="text-center border"><strong>{{__('Quantity')}}</strong></td>
                                            <td class="text-center border"><strong>{{__('Total')}}</strong></td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($items as $item)
                                                <tr>
                                                    <td class="border"></td>
                                                    <td class="text-center border">{{$item->name}}</td>
                                                    <td class="text-center border">{{$item->price}}</td>
                                                    <td class="text-center border">{{$item->weight}}</td>
                                                    <td class="text-center border">{{$item->quantity}}</td>
                                                    <td class="text-center border">{{$item->total}}</td>
                                                </tr>
                                            @endforeach
                                            <tr class="">
                                                <td class="no-line text-center "><strong>{{__('Total')}}</strong></td>
                                                <td></td><td></td><td></td><td></td>
                                                <td class="no-line text-center">{{$invoice->total}}</td>
                                            </tr>
                                            <tr>
                                                <td class="no-line text-center "><strong>{{__('Discount')}}</strong></td>
                                                <td></td><td></td><td></td><td></td>
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
                    <a class="btn btn-outline-dark px-5 rounded-0" onClick="jQuery('#page-content').print()">
                        <i class="fa fa-print"></i> {{__('Print')}}
                    </a>
                </div>
            </div>
        </section>
    </div>

    @section('scripts')

        <script>

            $('#table').footable() ;
            $('#table').dataTable( {
                "responsive": false,
                "scrollX": true,
                "language": {
                    "paginate": {
                        "previous": '<i class="fa fa-angle-left"></i>',
                        "next": '<i class="fa fa-angle-right"></i>'
                    }
                }
            } );


        </script>

    @stop

</x-app-layout>
