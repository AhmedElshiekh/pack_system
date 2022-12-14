<x-app-layout>

    @section('title',__('Sales'))
    @section('header')
        <div class="">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{__("Invoice information")}}
            </h2>
        </div>
        <div class="">
            <a href="{{route('sales',app()->getLocale())}}" class="btn btn-sm btn-outline-secondary rounded-0"><i class="fa fa-arrow-left"></i> {{__('Back')}}</a>
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
                    <div class="col-4 text-lg" dir="ltr">
                        <p > {{$invoice->number}}#  {{__('Invoice number')}} </p>
                    </div>
                </div>
                <hr/><br>
                <div class="row {{$locale=='ar'?'text-right':''}}">
                    <h5 class="col-6">
                        {{__('Bill of sale to')}} :
                        @if($invoice->customer_id)
                            {{ $invoice->customer->name }}
                        @elseif($invoice->supplier_id)
                            {{ $invoice->supplier->name }}
                        @endif
                        <br>
                        {{__('Address')}} :
                        @if($invoice->customer_id)
                            {{ $invoice->customer->address }}
                        @elseif($invoice->supplier_id)
                            {{ $invoice->supplier->address }}
                        @endif
                    </h5>
                    <h5 class="col-6">
                        {{__('Amount')}} : {{$invoice->total}}<br>
                        {{__('Paid')}} : {{$invoice->paid}}<br>
                        {{__('Remaining')}} :  {{$invoice->remaining=='0'?__('Finished'):$invoice->remaining}}
                    </h5>
                </div>

                <div class="row">
                    <div class="col-md-12 py-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title text-center">{{__('Order summary')}}</h3>
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
                {{-- <div class="row">
                    <div class="col-md-12 py-2">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title text-center">{{__('paid summary')}}</h3>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-condensed">
                                    <thead>
                                    <tr>
                                        <td class="text-center border"><strong>{{__('Paid Name')}}</strong></td>
                                        <td class="text-center border"><strong>{{__('Amount')}}</strong></td>
                                        <td class="text-center border"><strong>{{__('In Date')}}</strong></td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($paids as $paid)
                                            <tr>
                                                <td class="text-center border">{{$paid->name}}</td>
                                                <td class="text-center border">{{$paid->paid}}</td>
                                                <td class="text-center border">{{$paid->created_at->format('d-m-Y')}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <div class="text-center no-print">
                    <a class="btn btn-outline-dark px-5 rounded-0" onClick="jQuery('#page-content').print()">
                        <i class="fa fa-print"></i> {{__('Print')}}
                    </a>
                    {{-- <button type="button" class="btn btn-outline-success rounded-0" data-toggle="modal" data-target="#addImage">
                        <i class="fa fa-money"></i> {{__('paid')}}
                    </button> --}}
                </div>
            </div>
        </section>
    </div>
    <div class="modal fade" dir="ltr" id="addImage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{__('Add Paid')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{route('sales.paid',[$locale, $invoice])}}" enctype="multipart/form-data" file="true">
                        @csrf
                        <div class="form-group">
                            <label for="number">{{__('Amount')}}</label>
                            <input type="number" step=".0001" min="0" name="paid" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="number">{{__('Name')}}</label>
                            <input type="text" name="name" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary float-right">{{__('Add Amount')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @section('scripts')

        <script>
            function editDescription(description,href,event) {
                let modal = $('#editDescription');
                modal.find('.modal-body input[name="description"]').val(description);

                modal.find('.modal-body form').attr("action", href);

            };

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
