<x-app-layout>
    @section('title',__('Suppliers'))
    @section('header')
        <div class="">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{__("Supplier information")}}
            </h2>
        </div>
        <div class="">
            <a href="{{route('supplier',app()->getLocale())}}" class="btn btn-sm btn-outline-secondary rounded-0"><i class="fa fa-arrow-left"></i> {{__('Back')}}</a>
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
                                        <a href="{{ route('supplier.edit',[ app()->getLocale(), $supplier]) }}"  class="btn btn-sm btn-success fa fa-edit"></a>
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
                                        <a href="{{ route('purchase.show',[app()->getLocale(), $invoice]) }}"  class="btn btn-sm btn-success fa fa-eye"></a>
                                        <a href="" onclick="removeUser('{{ $invoice->id }}', '{{ route('invoice.delete',[app()->getLocale(), $invoic]) }}', event)"  class="btn btn-sm btn-danger fa fa-trash"></a>
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
                "scrollX": true,
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
