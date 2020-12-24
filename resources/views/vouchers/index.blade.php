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
                        <a href="{{ route('voucher.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i></a>
                    </div>
                </div>

            </div>
        </div>
            <table  id="table" class="table">
                <thead>
                <tr>
                    <th >#</th>
                    <th >{{ __('Number') }}</th>
                    <th >{{ __('Category') }}</th>
                    <th >{{ __('Amount') }}</th>
                    <th >{{ __('To') }}</th>
                    <th >{{ __('For') }}</th>
                     @canany(['read voucher'])
                        <th scope="col">{{ __('Actions') }}</th>
                    @endcanany
                </tr>
                </thead>
                <tbody>
                    @foreach($vouchers as $voucher)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $voucher->number }}</td>
                            <td>{{ $voucher->category->name }}</td>
                            <td>{{ $voucher->amount }}</td>
                            <td>{{ $voucher->customer->name }}</td>
                            <td>{{ $voucher->for}}</td>
                            @canany(['read voucher'])
                                <td>
                                    @can('read supplier')
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
            }
        } );

    </script>

@stop
