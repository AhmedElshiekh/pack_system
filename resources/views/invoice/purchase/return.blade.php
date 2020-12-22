@extends('layouts.master')

@section('title',__('مرتجعات المشتريات'))

@section('content')

    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">{{__('مرتجعات المشتريات')}}</h3>

        </div>
        <!--Data Table-->
        <!--===================================================-->
        <div class="panel-body">
            <div class="row">
                <form  method="post" action="{{route('invoice.returned.filter')}}">
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
                    <th >{{ __('Number') }}</th>
                    <th >{{ __('Invoice Number') }}</th>
                    <th >{{ __('Total') }}</th>
                    <th >{{ __('Paid') }}</th>
                    <th >{{ __('Remaining') }}</th>
                    <th >{{ __('Supplier') }}</th>
                    <th >{{ __('Note') }}</th>
                    @canany(['update invoice', 'delete invoice'])
                        <th scope="col">{{ __('Actions') }}</th>
                    @endcanany
                </tr>
                </thead>
                <tbody>
                @foreach($returned as $return)
                    <tr>
                        <td>{{ $return->number }}</td>
                        <td>{{ $return->invoice->number }}</td>
                        <td>{{ $return->invoice->total }}</td>
                        <td>{{ $return->invoice->paid }}</td>
                        <td>{{ $return->invoice->remaining}}</td>
                        <td>{{ $return->invoice->supplier->name }}</td>
                        <td>{{ $return->invoice->note }}</td>

                        @canany(['update invoice', 'read invoice'])
                            <td>
                                @can('read invoice')
                                    <a href="{{ route('invoice.printReturn', $return) }}"  class="btn btn-success fa fa-eye"></a>

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


@stop

@section('scripts')

    <script>



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
