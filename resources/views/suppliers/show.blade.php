<x-app-layout>
    @section('title',__('Suppliers'))
    @section('header')
        <div class="">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{__("Supplier information")}}
            </h2>
        </div>
        <div class="">
            <a href="{{  URL::previous() }}" class="btn btn-sm btn-outline-secondary rounded-0"><i class="fa fa-arrow-left"></i> {{__('Back')}}</a>
        </div>
    @endsection

    <div class="py-10 px-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="panel">
                <div class="panel-heading text-center">
                    <h4>{{__("Main info")}}</h4>
                </div>
                <div class="bg-white overflow-hidden border-double border-4 border-light-blue-500">
                    <div class="panel-body">
                        <table  id="table1" class="table text-center">
                            <thead>
                            <tr>
                                <th >{{ __('Name') }}</th>
                                <th >{{ __('Phone') }}</th>
                                <th >{{ __('Address') }}</th>
                                <th >{{ __('Total') }}</th>
                                <th >{{ __('Paid') }}</th>
                                <th >{{ __('Remaining') }}</th>
                                <th scope="col">{{ __('Actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $supplier->name }}</td>
                                    <td>{{ $supplier->phone }}</td>
                                    <td>{{ $supplier->address }}</td>
                                    <td>{{ $supplier->paid + $supplier->remaining }}</td>
                                    <td>{{ $supplier->paid }}</td>
                                    <td>{{ $supplier->remaining }}</td>
                                    <td>
                                        <a href="{{ route('supplier.edit', $supplier) }}"  class="btn btn-sm btn-success fa fa-edit"></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="py-10 px-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="panel">
                <div class="panel-heading">
                    <h4>{{__('Purchase invoices')}}</h4>
                </div>
                <div class="bg-white border-double border-4 border-light-blue-500">
                    <div class="panel-body">
                        <table  id="table" class="table text-center">
                            <thead>
                            <tr>
                                <th >{{ __('Number') }}</th>
                                <th >{{ __('Total') }}</th>
                                <th >{{ __('Discount') }}</th>
                                <th >{{ __('Paid') }}</th>
                                <th >{{ __('Remaining') }}</th>
                                <th >{{ __('Note') }}</th>
                                <th scope="col">{{ __('Actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($supplier->invoices as $invoice)
                                <tr @if($invoice->return)style="text-decoration: line-through"@endif>
                                    <td>{{ $invoice->number }}</td>
                                    <td>{{ $invoice->total }}</td>
                                    <td>{{ $invoice->discount }}</td>
                                    <td>{{ $invoice->paid }}</td>
                                    <td>{{ $invoice->remaining}}</td>
                                    <td>{{ $invoice->note }}</td>
                                    <td>
                                        <a href="{{ route('purchase.show', $invoice) }}"  class="btn btn-sm btn-success fa fa-eye"></a>
                                        <a href="" onclick="removeUser('{{ $invoice->id }}', '{{ route('invoice.delete', $invoice) }}', event)"  class="btn btn-sm btn-danger fa fa-trash"></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">{{__('السندات')}}</h3>
        </div>
        <!--Data Table-->
        <!--===================================================-->
        <div class="panel-body">

            <table  id="table3" class="table ">
                <thead>
                <tr>
                    <th >{{ __('Number') }}</th>
                    <th >{{ __('Amount') }}</th>
                    <th >{{ __('Paid For') }}</th>
                    <th>{{__('User')}}</th>

                    @canany(['read voucher'])
                        <th scope="col">{{ __('Actions') }}</th>
                    @endcanany
                </tr>
                </thead>
                <tbody>
                @foreach($supplier->vouchers as $voucher)
                    <tr>
                        <td>{{ $voucher->number }}</td>
                        <td>{{ $voucher->amount }}</td>
                        <td>{{ $voucher->paid_for }}</td>
                        <td>{{ $voucher->user->name }}</td>
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
    </div> --}}

    {{-- <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">{{__('Extra Data') }}</h3>
        </div>
        <!--Data Table-->
        <!--===================================================-->
        <div class="panel-body">
            <div class="pad-btm form-inline">
                <div class="row">
                    <div class="col-sm-6 table-toolbar-left">
                        <div class="btn-group">
                            <a href="#"  data-toggle="modal" data-target="#addDataModal" class="btn btn-primary"><i class="fa fa-plus"></i></a>
                        </div>
                    </div>

                </div>
            </div>
            <table  id="table" class="table ">
                <thead>
                <tr>
                    <th >#</th>
                    <th >{{ __('Name') }}</th>
                    <th >{{ __('Email') }}</th>
                    <th >{{ __('Phone') }}</th>
                    <th >{{ __('Note') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($supplier->data as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data->name }}</td>
                        <td>{{ $data->email }}</td>
                        <td>{{ $data->phone }}</td>
                        <td>{{ $data->note }}</td>
                        <td>
                            @can('update supplier')
                                 <a href="#" onclick="editData('{{$data->name}}','{{$data->email}}','{{$data->phone}}','{{$data->note}}', '{{ route('supplier.data.update',$data) }}',event);"
                                    data-toggle="modal" data-target="#editDataModal"   class="btn btn-primary fa fa-edit"></a>
                                <button onclick="removeUser('{{ $data->name }}', '{{ route('supplier.data.destroy', $data) }}', event)" class="btn btn-danger fa fa-trash"></button>

                            @endcan
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
        <!--===================================================-->
        <!--End Data Table-->
    </div> --}}
    {{-- <div class="modal fade" id="editDataModal" tabindex="-1" role="dialog" aria-labelledby="categoryModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h5 class="modal-title" id="categoryModalLabel">{{ __('Edit Data') }}</h5>
                </div>
                <div class="modal-body">
                    <form enctype="multipart/form-data" method="POST" action="" accept-charset="utf-8">
                        <input type="hidden" name="supplier_id" value="{{$supplier->id}}">
                        @csrf
                        <div class="form-group">
                            <label for="name">{{__('Name') }}</label>
                            <input class="form-control" id="name" name="name" value="" required>
                        </div>
                        <div class="form-group">
                            <label for="email">{{__('Email') }}</label>
                            <input class="form-control" id="email" name="email" value="" >
                        </div>
                        <div class="form-group">
                            <label for="email">{{__('Phone') }}</label>
                            <input class="form-control" id="phone" name="phone" value="" required>
                        </div>
                        <div class="form-group">
                            <label for="email">{{__('Note') }}</label>
                            <input class="form-control" id="note" name="note" value="" >
                        </div>
                        <button type="submit" class="btn btn-primary float-right">{{ __('Save') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addDataModal" tabindex="-1" role="dialog" aria-labelledby="categoryModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h5 class="modal-title" id="categoryModalLabel">{{ __('add Data') }}</h5>
                </div>
                <div class="modal-body">
                    <form enctype="multipart/form-data" method="POST" action="{{route('supplier.data.store')}}" accept-charset="utf-8">
                        <input type="hidden" name="supplier_id" value="{{$supplier->id}}">
                        @csrf
                        <div class="form-group">
                            <label for="name">{{__('Name') }}</label>
                            <input class="form-control" id="name" name="name" value="" required>
                        </div>
                        <div class="form-group">
                            <label for="email">{{__('Email') }}</label>
                            <input class="form-control" id="email" name="email" value="" >
                        </div>
                        <div class="form-group">
                            <label for="email">{{__('Phone') }}</label>
                            <input class="form-control" id="phone" name="phone" value="" required>
                        </div>
                        <div class="form-group">
                            <label for="email">{{__('Note') }}</label>
                            <input class="form-control" id="note" name="note" value="" >
                        </div>
                        <button type="submit" class="btn btn-primary float-right">{{ __('Save') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}


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
            } );
            $('#table3').dataTable( {
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
            function editData(name,email,phone,note,href,event) {
                let modal = $('#editDataModal');
                modal.find('.modal-body input[name="name"]').val(name);
                modal.find('.modal-body input[name="email"]').val(email);
                modal.find('.modal-body input[name="phone"]').val(phone);
                modal.find('.modal-body input[name="note"]').val(note);
                modal.find('.modal-body form').attr("action", href);

            };
        </script>

    @stop
</x-app-layout>
