@extends('layouts.master')

@section('content')

    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">{{__('Voucher Table')}}</h3>
        </div>
        <!--Data Table-->
        <!--===================================================-->
        <div class="panel-body">
            <div class="pad-btm form-inline">
                <div class="row">
                    <div class="col-sm-6 table-toolbar-left">
                        <div class="btn-group">
                            <a href="{{ route('perishable.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i></a>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row">
                <form  method="post" action="{{route('perishable.filter')}}">
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
                    <th >{{ __('Category') }}</th>
                    <th >{{ __('Amount') }}</th>
                    <th >{{ __('Paid For') }}</th>
                    <th>{{__('User')}}</th>
                    <th>{{__('To')}}</th>
                    @canany(['read voucher'])
                        <th scope="col">{{ __('Actions') }}</th>
                    @endcanany
                </tr>
                </thead>
                <tbody>
                @foreach($vouchers as $voucher)
                    <tr>
                        <td>{{ $voucher->number }}</td>
                        <td>@if($voucher->voucher_cat){{$voucher->category->name}}@endif</td>
                        <td>{{ $voucher->amount }}</td>
                        <td>{{ $voucher->paid_for }}</td>
                        <td>{{ $voucher->user->name }}</td>
                        @if($voucher->supplier_id)
                           <td>{{ $voucher->supplier->name }}</td>
                        @elseif($voucher->employee_id)
                            <td>{{ $voucher->employee->name }}</td>
                        @else
                            <td>{{ $voucher->for }}</td>
                        @endif
                        @canany(['read voucher'])
                            <td>
                                @can('read voucher')
                                    <a href="{{ route('voucher.show', $voucher) }}"  class="btn btn-success fa fa-eye"></a>
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
