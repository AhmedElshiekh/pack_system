@extends('layouts.master')

@section('title', __('المبيعات'))
@section('content')

<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">{{__('المبيعات')}}</h3>

    </div>
    <!--Data Table-->
    <!--===================================================-->
    <div class="panel-body">
        <div class="pad-btm form-inline">
            <div class="row">
                <div class="col-sm-6 table-toolbar-left">
                    <div class="btn-group">
                        <a href="{{ route('invoice.sales.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i></a>
                    </div>
                </div>

            </div>
        </div>
        <div class="row">
            <form  method="post" action="{{route('invoice.sales.filter')}}">
                @csrf
                <div class="col-md-3 form-group">
                    <label>{{__('From')}}</label>
                    <input type="date" name="from" class="form-control" style="line-height: 15px" required>
                </div>
                <div class="col-md-3 form-group">
                    <label>{{__('To')}}</label>
                    <input type="date" name="to" class="form-control " style="line-height: 15px" required>
                </div>
                <button type="submit" class="btn btn-active-default" style="margin-top: 25px;width: 100px;"> {{__('filter')}}</button>
            </form>

        </div>

        <table  id="table" class="table ">
                <thead>
                <tr>
                    <th >{{ __('Customer') }}</th>
                    <th >{{ __('Number') }}</th>
                    <th >{{ __('Payment') }}</th>
                    <th >{{ __('Total') }}</th>
                    <th >{{ __('Discount') }}</th>
                    <th >{{ __('Paid') }}</th>
                    <th >{{ __('Remaining') }}</th>
                    <th >{{ __('Date') }}</th>
                    <th >{{ __('User') }}</th>
                    <th >{{ __('Note') }}</th>
                     @canany(['update invoice', 'delete invoice'])
                        <th scope="col">{{ __('Actions') }}</th>
                    @endcanany
                </tr>
                </thead>
                <tbody>
                    @foreach($invoices as $invoice)
                        <tr @if($invoice->return)style="text-decoration: line-through"@endif>
                            <td>{{ $invoice->customer->name }}</td>
                            <td>{{ $invoice->number }}</td>
                            <td>{{ $invoice->payment }}</td>
                            <td>{{ $invoice->total }}</td>
                            <td>{{ $invoice->discount }}</td>
                            <td>{{ $invoice->paid }}</td>
                            <td>{{ $invoice->remaining}}</td>
                            <td>{{ $invoice->created_at->format('d-m-Y') }}</td>
                            <td>{{ $invoice->user->name }}</td>
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


@stop

@section('scripts')

    <script>

        function removeUser(name, url, e) {
            e.preventDefault();
            swal({
                title: "{{ __('Are you sure') }}?",
                text: "{{ __('You are return') }} ( " + name + " )",
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

        // $('#table').footable() ;
        $('#table').dataTable( {
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


    </script>

@stop
