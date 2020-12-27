<x-app-layout>

    @section('title', __('Sales'))
    @section('header')
        <div class="">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Sales invoices') }}
            </h2>
        </div>
        <div class="">
            <a href="{{ route('sales.create',app()->getLocale() ) }}" class="btn btn-sm btn-outline-info rounded-0"><i class="fa fa-plus"></i> {{__('Create a Sales invoice')}}</a>
        </div>
    @endsection


    <div class="panel">
        <div class="panel-heading">
            <form  method="post" action="{{route('sales.filter',app()->getLocale() )}}">
                @csrf
                <div class="col-md-3 form-group">
                    <label>{{__('From')}}</label>
                    <input type="date" name="from" class="form-control" style="line-height: 15px" required>
                </div>
                <div class="col-md-3 form-group">
                    <label>{{__('To')}}</label>
                    <input type="date" name="to" class="form-control " style="line-height: 15px" required>
                </div>
                <button type="submit" class="btn btn-outline-warning " style=" margin-top: 25px;width: 100px;"> {{__('filter')}}</button>
            </form>
        </div>
        <div class="panel-body">

            <table  id="table" class="table table-striped table-bordered  no-footer dtr-inline" style="width:100%">
                <thead class="text-center">
                    <tr>
                        <th >#</th>
                        <th >{{ __('Number') }}</th>
                        <th >{{ __('Customer') }}</th>
                        <th >{{ __('Total') }}</th>
                        {{-- <th >{{ __('Discount') }}</th> --}}
                        <th >{{ __('Paid') }}</th>
                        <th >{{ __('Remaining') }}</th>
                        <th >{{ __('Date') }}</th>
                        <th >{{ __('Note') }}</th>
                        <th scope="col">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach($invoices as $invoice)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $invoice->number }}</td>
                            <td>{{ $invoice->customer->name }}</td>
                            <td>{{ $invoice->total }}</td>
                            {{-- <td>{{ $invoice->discount }}</td> --}}
                            <td>{{ $invoice->paid }}</td>
                            <td>{{ $invoice->remaining}}</td>
                            <td>{{ $invoice->created_at->format('d-m-Y') }}</td>
                            <td>{{ $invoice->note }}</td>
                            <td>
                                <a href="{{ route('sales.show',[app()->getLocale(), $invoice]) }}"  class="btn btn-sm btn-success fa fa-eye"></a>
                                <a href="" onclick="removeUser('{{ $invoice->number }}', '{{ route('invoice.sales.delete',[app()->getLocale(), $invoice]) }}', event)"  class="btn btn-sm btn-danger fa fa-trash-o"></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>


    @section('scripts')

        <script>

            function removeUser(name, url, e) {
                e.preventDefault();
                swal({
                    title: "{{ __('Are you sure') }}?",
                    text: "{{ __('You are return') }} ( " + name + " )",
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

            // $('#table').footable() ;
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
