<x-app-layout>

    @section('title',__('Customers'))
    @section('header')
        <div class="">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Customers') }}
            </h2>
        </div>
        <div class="">
            <a href="{{ route('customer.create') }}" class="btn btn-outline-primary rounded-0"><i class="fa fa-plus"></i> {{__('Create Customer')}}</a>
        </div>
    @endsection

    <div class="panel">
        <div class="panel-body">
            <table  id="table" class="table text-center table-striped table-border" style="width:100%">
                <thead>
                <tr>
                    <th >#</th>
                    <th >{{ __('Name') }}</th>
                    <th >{{ __('Phone') }}</th>
                    <th >{{ __('Address') }}</th>
                    <th >{{ __('Paid') }}</th>
                    <th >{{ __('Remaining') }}</th>
                    <th >{{ __('note') }}</th>
                    <th scope="col">{{ __('Actions') }}</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($customers as $customer)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $customer->name }}</td>
                            <td>{{ $customer->phone }}</td>
                            <td>{{ $customer->address }}</td>
                            <td>{{ $customer->paid }}</td>
                            <td>{{ $customer->remaining }}</td>
                            <td>{{ $customer->note }}</td>
                            <td>
                                <a href="{{ route('customer.edit', $customer) }}"  class="btn btn-primary btn-sm fa fa-edit"></a>
                                <a href="{{ route('customer.show', $customer) }}"  class="btn btn-success btn-sm fa fa-eye"></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <br>
        </div>
    </div>

    @section('scripts')
        <script>
            $('#table').dataTable( {
                "responsive": false,
                // info:false,
                // paging:false,
                "scrollX": true,
                dom: 'Bfrtip',
                buttons: [
                    'excel', 'pdf', 'print'
                ],
                'order':[['0','desc']]
            });
        </script>
    @stop
</x-app-layout>
