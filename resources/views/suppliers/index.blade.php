<x-app-layout>

    @section('title',__('Suppliers'))
    @section('header')
        <div class="">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Suppliers') }}
            </h2>
        </div>
        <div class="">
            <a href="{{ route('supplier.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('Create supplier')}}</a>
        </div>
    @endsection

    
    <div class="panel-body">
        <table  id="table" class="table text-center">
            <thead class="text-center">
                <tr>
                    <th >#</th>
                    <th >{{ __('Name') }}</th>
                    <th >{{ __('Phone') }}</th>
                    <th >{{ __('Address') }}</th>
                    <th >{{ __('Paid') }}</th>
                    <th >{{ __('Remaining') }}</th>
                    <th scope="col">{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($suppliers as $supplier)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $supplier->name }}</td>
                        <td>{{ $supplier->phone }}</td>
                        <td>{{ $supplier->address }}</td>
                        <td>{{ $supplier->paid }}</td>
                        <td>{{ $supplier->remaining }}</td>
                        <td>
                            <a href="{{ route('supplier.edit', $supplier) }}"  class="btn btn-primary fa fa-edit"></a>
                            <a href="{{ route('supplier.show', $supplier) }}"  class="btn btn-success fa fa-eye"></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $suppliers->links() }}
    </div>


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

            $('#table').dataTable( {
                "responsive": false,
                info:false,
                paging:false,
                dom: 'Bfrtip',
                buttons: [
                    'excel', 'pdf', 'print'
                ],
                'order':[['0','desc']]
            } );


        </script>

    @stop

</x-app-layout>


