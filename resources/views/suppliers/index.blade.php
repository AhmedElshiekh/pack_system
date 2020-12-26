<x-app-layout>

    @section('title',__('Suppliers'))
    @section('header')
        <div class="">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Suppliers') }}
            </h2>
        </div>
        <div class="">
            <a href="{{ route('supplier.create',app()->getLocale()) }}" class="btn btn-outline-primary rounded-0"><i class="fa fa-plus"></i> {{__('Create supplier')}}</a>
        </div>
    @endsection


    <div class="panel-body">
        <table  id="table" class="table text-center table-striped table-bordered " style="width:100%">
            <thead class="text-center">
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
            <tbody class="text-center">
                @foreach($suppliers as $supplier)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $supplier->name }}</td>
                        <td>{{ $supplier->phone }}</td>
                        <td>{{ $supplier->address }}</td>
                        <td>{{ $supplier->paid }}</td>
                        <td>{{ $supplier->remaining }}</td>
                        <td>{{ $supplier->note }}</td>
                        <td>
                            <a href="{{ route('supplier.edit',[ app()->getLocale(), $supplier ]) }}"  class="btn btn-sm btn-primary fa fa-edit"></a>
                            <a href="{{ route('supplier.show',[ app()->getLocale(), $supplier ]) }}"  class="btn btn-sm btn-success fa fa-eye"></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <br>
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
                "scrollX": true,
                "responsive": false,
                // info:false,
                // paging:false,
                dom: 'Bfrtip',
                buttons: [
                    'excel', 'pdf', 'print'
                ],
                'order':[['0','desc']]
            } );


        </script>

    @stop

</x-app-layout>
