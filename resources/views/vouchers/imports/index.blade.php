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
            <table  id="table" class="table table-striped table-bordered text-center no-footer dtr-inline" style="width:100%">
                <thead>
                <tr>
                    <th >{{ __('Number') }}</th>
                    <th >{{ __('Amount') }}</th>
                    <th >{{ __('Paid For') }}</th>
                    <th>{{__('Import from')}}</th>
                    <th scope="col">{{ __('Actions') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($vouchers as $voucher)
                    <tr>
                        <td>{{ $voucher->number }}</td>
                        <td>{{ $voucher->amount }}</td>
                        <td>{{ $voucher->to }}</td>
                        <td>{{ $voucher->paid_for }}</td>
                        <td>
                            <a href="{{ route('imports.show', $voucher) }}"  class="btn btn-success btn-sm fa fa-eye"></a>
                        </td>
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
                "scrollX": true,
                dom: 'Bfrtip',
                buttons: [
                    'excel', 'pdf', 'print'
                ],
                'order':[['0','desc']]
            } );
        </script>
    @stop
</x-app-layout>
