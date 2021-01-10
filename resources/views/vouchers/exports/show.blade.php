<x-app-layout>

    @section('title',__('Invoice'))
    @section('header')
        <div class="">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{__("Voucher information")}}
            </h2>
        </div>
        <div class="">
            <a href="{{route('exports',app()->getLocale())}}" class="btn btn-sm btn-outline-secondary rounded-0"><i class="fa fa-arrow-left"></i> {{__('Back')}}</a>
        </div>
    @endsection

    <div class="invoice-wrapper p-15">
        <section class="invoice-container">
            <div class="invoice-inner">
                <div class="row">
                    <div class="col-8 img">
                        <x-jet-authentication-card-logo class="block h-9 w-auto" />
                    </div>
                    <div class="col-4">
                        <p>{{__('import voucher number')}} # {{$voucher->number}}</p>
                    </div>
                </div>
                <hr/><br>
                <div class="row">
                    <div class="col-xs-12">
                        <h5>
                            <div class="flex flex-row"><strong>{{__('We paid it') }}</strong>  {{__('Egypt Pack Company')}}</div>
                            <div class="flex flex-row-reverse"><span>{{__('In history') }} : {{ $voucher->created_at->format('d/m/Y') }} </span></div><br>
                            <div class="flex flex-row"><strong>{{__('To mr/s') }} </strong>: {{ $voucher->to }}</div><br>
                            <div class="flex flex-row"><strong>{{__('An amount of ') }}</strong> : {{ $voucher->amount }}</div><br>
                            <div class="flex flex-row"><strong>{{__('Paid for')}}</strong> : {{ $voucher->paid_for }}</div>
                            <div class="flex flex-row-reverse">{{__('The recipient') }}</div>
                        </h5>
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


