<x-app-layout>

    @section('title','Sales')
    @section('header')
        <div class="">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Import vouchers') }}
            </h2>
        </div>
        <div class="">
            <a href="{{ route('imports.create') }}" class="btn btn-sm btn-outline-info rounded-0"><i class="fa fa-plus"></i> {{__('Create a import voucher')}}</a>
        </div>
    @endsection

    <div class="panel p-3">
        <div class="panel-heading">
            <form  method="post" action="{{route('imports.filter')}}">
                @csrf
                <div class="col-md-3 form-group">
                    <label>{{__('From')}}</label>
                    <input type="date" name="from" class="form-control" style="line-height: 15px" required>
                </div>
                <div class="col-md-3 form-group">
                    <label>{{__('To')}}</label>
                    <input type="date" name="to" class="form-control " style="line-height: 15px" required>
                </div>
                <button type="submit" class="btn btn-outline-warning" style="margin-top: 25px;width: 100px;"> {{__('filter')}}</button>
            </form>
        </div>
        <div class="panel-body">

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
                                    <a href="{{ route('imports.show', $voucher) }}"  class="btn btn-success fa fa-eye"></a>
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
</x-app-layout>
