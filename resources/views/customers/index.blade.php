@extends('layouts.master')
@section('title',__('Customers'))

@section('content')

<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">{{__('Customers Table')}}</h3>
    </div>
    <!--Data Table-->
    <!--===================================================-->
    <div class="panel-body">
        <div class="pad-btm form-inline">
            <div class="row">
                <div class="col-sm-6 table-toolbar-left">
                    <div class="btn-group">
                        <a href="{{ route('customer.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i></a>
                    </div>
                </div>
                <div class="col-sm-6">
                    <form action="{{ route('customer.import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="file" class="form-control" required>
                        <button type="submit" class="btn btn-success">{{__('اضافه اكسيل')}}</button>
                    </form>
                </div>
            </div>
        </div>
            <table  id="table" class="table ">
                <thead>
                <tr>
                    <th >#</th>
                    <th >{{ __('Name') }}</th>
                    <th >{{ __('الرقم القومي') }}</th>
                    <th >{{ __('Email') }}</th>
                    <th >{{ __('Phone') }}</th>
                    <th >{{ __('Address') }}</th>
                    <th >{{ __('Paid') }}</th>
                    <th >{{ __('Remaining') }}</th>
                     @canany(['update customer', 'delete customer'])
                        <th scope="col">{{ __('Actions') }}</th>
                    @endcanany
                </tr>
                </thead>
                <tbody>
                    @foreach($customers as $customer)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $customer->name }}</td>
                            <td>{{ $customer->NationalID }}</td>
                            <td>{{ $customer->email }}</td>
                            <td>{{ $customer->phone1 }}</td>
                            <td>{{ $customer->address }}</td>
                            <td>{{ $customer->paid }}</td>
                            <td>{{ $customer->remaining }}</td>

                            @canany(['update customer', 'read customer'])
                                <td>
                                    @can('update customer')
                                        <a href="{{ route('customer.edit', $customer) }}"  class="btn btn-primary fa fa-edit"></a>
                                    @endcan
                                    @can('read customer')
                                        <a href="{{ route('customer.show', $customer) }}"  class="btn btn-success fa fa-eye"></a>
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
        });
    </script>
@stop
