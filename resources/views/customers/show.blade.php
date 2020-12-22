@extends('layouts.master')
@section('title',__('Customer'))

@section('content')

    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">{{ $customer->name}}</h3>
        </div>
        <!--Data Table-->
        <!--===================================================-->
        <div class="panel-body">
{{--            <div class="pad-btm form-inline">--}}
{{--                <div class="row">--}}
{{--                    <div class="col-sm-6 table-toolbar-left">--}}
{{--                        <div class="btn-group">--}}
{{--                            <a href="{{ route('item.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i></a>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                </div>--}}
{{--            </div>--}}
            <table  id="table" class="table ">
                <thead>
                <tr>
                    <th >{{ __('Name') }}</th>
                    <th >{{ __('Email') }}</th>
                    <th >{{ __('Phone1') }}</th>
                    <th >{{ __('Phone2') }}</th>
                    <th >{{ __('WhatsApp') }}</th>
                    <th >{{ __('Address') }}</th>
                    <th >{{ __('الاجمالي') }}</th>
                    <th >{{ __('Paid') }}</th>
                    <th >{{ __('Remaining') }}</th>
                    @canany(['update supplier', 'delete supplier'])
                        <th scope="col">{{ __('Actions') }}</th>
                    @endcanany
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $customer->name }}</td>
                        <td>{{ $customer->email }}</td>
                        <td>{{ $customer->phone1 }}</td>
                        <td>{{ $customer->phone2 }}</td>
                        <td>{{ $customer->whatsApp }}</td>
                        <td>{{ $customer->address }}</td>
                        <td>{{ $customer->paid + $customer->remaining }}</td>
                        <td>{{ $customer->paid }}</td>
                        <td>{{ $customer->remaining }}</td>
                        @canany(['update supplier'])
                            <td>
                                @can('update supplier')
                                    <a href="{{ route('customer.edit', $customer) }}"  class="btn btn-primary fa fa-edit"></a>
                                @endcan
                            </td>
                        @endcanany
                    </tr>
                </tbody>
            </table>

        </div>
        <!--===================================================-->
        <!--End Data Table-->
    </div>
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">{{__('الفواتير')}}</h3>
        </div>
        <!--Data Table-->
        <!--===================================================-->
        <div class="panel-body">

            <table  id="table" class="table ">
                <thead>
                <tr>
                    <th >{{ __('Number') }}</th>
                    <th >{{ __('Payment') }}</th>
                    <th >{{ __('Total') }}</th>
                    <th >{{ __('Discount') }}</th>
                    <th >{{ __('Paid') }}</th>
                    <th >{{ __('Remaining') }}</th>
                    <th >{{ __('User') }}</th>
                    <th >{{ __('Date') }}</th>
                    <th >{{ __('Note') }}</th>
                    @canany(['update invoice', 'delete invoice'])
                        <th scope="col">{{ __('Actions') }}</th>
                    @endcanany
                </tr>
                </thead>
                <tbody>
                @foreach($customer->invoices as $invoice)
                    <tr @if($invoice->return)style="text-decoration: line-through"@endif>
                        <td>{{ $invoice->number }}</td>
                        <td>{{ $invoice->payment }}</td>
                        <td>{{ $invoice->total }}</td>
                        <td>{{ $invoice->discount }}</td>
                        <td>{{ $invoice->paid }}</td>
                        <td>{{ $invoice->remaining}}</td>
                        <td>{{ $invoice->user->name }}</td>
                        <td>{{ $invoice->created_at->format('d-m-Y') }}</td>
                        <td>{{ $invoice->note }}</td>

                        @canany(['update invoice', 'read invoice'])
                            <td>
                                @can('read invoice')
                                    <a href="{{ route('invoice.sales.show', $invoice) }}"  class="btn btn-success fa fa-eye"></a>

                                @endcan
                                @if($invoice->return ==0 )
                                    @can('update invoice')
                                        <a href="" onclick="removeUser('{{ $invoice->number }}', '{{ route('invoice.sales.return', $invoice) }}', event)"  class="btn btn-danger">{{__('return')}}</a>
                                    @endcan
                                @endif
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
    </div>
@stop
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
