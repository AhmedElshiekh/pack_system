<x-app-layout>

    @section('title',__('Customer'))
    @section('header')
        <div class="">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{__("Customer information")}}
            </h2>
        </div>
        <div class="">
            <a href="{{  URL::previous() }}" class="btn btn-sm btn-outline-secondary rounded-0"><i class="fa fa-arrow-left"></i> {{__('Back')}}</a>
        </div>
    @endsection

    <div class="py-10 px-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="panel">
                <div class="panel-heading text-center">
                    <h4>{{__("Main info")}}</h4>
                </div>
                <div class="bg-white overflow-hidden border-double border-4 border-light-blue-500">
                    <div class="panel-body">
                        <table  id="table2" class="table text-center">
                            <thead>
                                <tr>
                                    <th >{{ __('Name') }}</th>
                                    <th >{{ __('Phone') }}</th>
                                    <th >{{ __('Address') }}</th>
                                    <th >{{ __('Total') }}</th>
                                    <th >{{ __('Paid') }}</th>
                                    <th >{{ __('Remaining') }}</th>
                                    <th scope="col">{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $customer->name }}</td>
                                    <td>{{ $customer->phone }}</td>
                                    <td>{{ $customer->address }}</td>
                                    <td>{{ $customer->paid + $customer->remaining }}</td>
                                    <td>{{ $customer->paid }}</td>
                                    <td>{{ $customer->remaining }}</td>
                                    <td>
                                        <a href="{{ route('customer.edit', $customer) }}"  class="btn btn-info btn-sm fa fa-edit"></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="py-10 px-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">{{__('Sale invoices')}}</h3>
                </div>
                <!--Data Table-->
                <!--===================================================-->
                <div class="bg-white overflow-hidden border-double border-4 border-light-blue-500">
                    <div class="panel-body">
                        <table  id="table" class="table text-center">
                            <thead>
                                <tr>
                                    <th >{{ __('Number') }}</th>
                                    <th >{{ __('Total') }}</th>
                                    <th >{{ __('Discount') }}</th>
                                    <th >{{ __('Paid') }}</th>
                                    <th >{{ __('Remaining') }}</th>
                                    <th >{{ __('Date') }}</th>
                                    <th >{{ __('Note') }}</th>
                                    <th scope="col">{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($customer->invoices as $invoice)
                                <tr>
                                    <td>{{ $invoice->number }}</td>
                                    <td>{{ $invoice->total }}</td>
                                    <td>{{ $invoice->discount }}</td>
                                    <td>{{ $invoice->paid }}</td>
                                    <td>{{ $invoice->remaining}}</td>
                                    <td>{{ $invoice->created_at->format('d-m-Y') }}</td>
                                    <td>{{ $invoice->note }}</td>
                                    <td>
                                        <a href="{{ route('sales.show', $invoice) }}"  class="btn btn-success btn-sm fa fa-eye"></a>
                                        <a href="" onclick="removeUser('{{ $invoice->number }}', '{{ route('invoice.sales.delete', $invoice) }}', event)"  class="btn btn-danger btn-sm fa fa-trash"></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
                <!--===================================================-->
                <!--End Data Table-->
            </div>
        </div>
    </div>
    {{-- <div class="panel">
        <div class="panel-heading">
            <span class="panel-title">{{__('السندات')}}</span>

        </div>
        <!--Data Table-->
        <!--===================================================-->
        <div class="panel-body">

            <table  id="table3" class="table ">
                <thead>
                <tr>
                    <th >{{ __('Number') }}</th>
                    <th >{{ __('Amount') }}</th>
                    <th >{{ __('Paid For') }}</th>
                    <th>{{__('User')}}</th>
                    <th>{{__('التاريخ')}}</th>

                    @canany(['read voucher'])
                        <th scope="col">{{ __('Actions') }}</th>
                    @endcanany
                </tr>
                </thead>
                <tbody>
                @foreach($customer->vouchers as $voucher)
                    <tr>
                        <td>{{ $voucher->number }}</td>
                        <td>{{ $voucher->amount }}</td>
                        <td>{{ $voucher->paid_for }}</td>
                        <td>{{ $voucher->user->name }}</td>
                        <td>{{ $voucher->created_at->format('Y-m-d') }}</td>
                        @canany(['read voucher'])
                            <td>
                                @can('read voucher')
                                    <a href="{{ route('voucher.sales.show', $voucher) }}"  class="btn btn-success fa fa-eye"></a>
                                @endcan
                            </td>
                        @endcanany
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
        <!--===================================================-->
        <!--End Data Table-->
    </div>
    <div class="panel">
        <div class="panel-heading">
            <span class="panel-title">{{__('الهوالك')}}</span>
            <span class="panel-title pull-left">{{__('اجمالي الوزن').':'. $customer->perishables->sum('weight')}}</span>
            <span class="panel-title pull-left">{{__('اجمالي العدد').':'. $customer->perishables->sum('number')}}</span>
            <span class="panel-title pull-left">{{__('اجمالي السعر').':'. $customer->perishables->sum('total')}}</span>

        </div>
        <!--Data Table-->
        <!--===================================================-->
        <div class="panel-body">

            <table  id="table3" class="table ">
                <thead>
                <tr>
                    <th >{{ __('#') }}</th>
                    <th >{{ __('نوع الهالك') }}</th>
                    <th >{{ __('العدد/الوزن') }}</th>
                    <th>{{__('سعر الوحده')}}</th>
                    <th>{{__('الاجمالي')}}</th>
                    <th>{{__('التاريخ')}}</th>

                </tr>
                </thead>
                <tbody>
                @foreach($customer->perishables as $perishable)
                    <tr>
                        <td>{{ $perishable->id }}</td>
                        <td>{{ $perishable->type->name }}</td>
                        <td>{{$perishable->number? $perishable->number:$perishable->weight }}</td>
                        <td>{{ $perishable->unit_price }}</td>
                        <td>{{ $perishable->total }}</td>
                        <td>{{ $perishable->created_at->format('Y-m-d') }}</td>

                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
        <!--===================================================-->
        <!--End Data Table-->
    </div> --}}


    @section('scripts')
        <script>
            function removeUser(name, url, e) {
                e.preventDefault();
                swal({
                    title: "{{ __('Are you sure') }}?",
                    text: "{{ __('You are deleting') }} ( " + name + " )",
                    // icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: '#DD6B55',
                    confirmButtonText: '{{ __('Yes, I am sure!') }}',
                    cancelButtonText: "{{ __('No, cancel it') }}"
                }).then(
                    function (obj) {
                        // if (obj.value) {
                        window.location = url;
                        // }
                    }
                );
            }
            $('.table').dataTable( {
                "responsive": false,
                "language": {
                    "paginate": {
                        "previous": '<i class="fa fa-angle-left"></i>',
                        "next": '<i class="fa fa-angle-right"></i>'
                    }
                },
                dom: 'Bfrtip',
                buttons: [
                    'excel', 'pdf', 'print'
                ],
                'order':[['0','desc']]
            } );
            $('#table3').dataTable( {
                "responsive": false,
                "language": {
                    "paginate": {
                        "previous": '<i class="fa fa-angle-left"></i>',
                        "next": '<i class="fa fa-angle-right"></i>'
                    }
                },
                "scrollX": true,
                dom: 'Bfrtip',
                buttons: [
                    'excel', 'pdf', 'print'
                ],
                'order':[['0','desc']]
            } );
            function editData(name,email,phone,note,href,event) {
                let modal = $('#editDataModal');
                modal.find('.modal-body input[name="name"]').val(name);
                modal.find('.modal-body input[name="email"]').val(email);
                modal.find('.modal-body input[name="phone"]').val(phone);
                modal.find('.modal-body input[name="note"]').val(note);
                modal.find('.modal-body form').attr("action", href);

            };
        </script>

    @stop

</x-app-layout>
