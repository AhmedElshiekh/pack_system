@extends('layouts.master')
@section('title',__('Status Customers'))

@section('content')

    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">{{__('Status Customers')}}</h3>
        </div>
        <!--Data Table-->
        <!--===================================================-->
        <div class="panel-body">
            <div class="pad-btm form-inline">
                <div class="row">
                    <div class="col-sm-6 table-toolbar-left">
                        <div class="btn-group">
                            <a href="#"  data-toggle="modal" data-target="#statusModal" class="btn btn-primary"><i class="fa fa-plus"></i></a>

                        </div>
                    </div>
                </div>


            </div>
            <table  id="table" class="table ">
                <thead>
                <tr>
                    <th >{{ __('Name') }}</th>
                    @canany(['status update', 'delete customer'])
                        <th scope="col">{{ __('Actions') }}</th>
                    @endcanany
                </tr>
                </thead>
                <tbody>
                @foreach($customerStatus as $status)
                    <tr>
                        <td>{{ $status->name }}</td>
                        @canany(['update status', 'delete status'])
                            <td>
                                @can('status update')

                                    <a href="#" onclick="editStatus('{{$status->name}}', '{{ route('status.update', $status) }}',event);"
                                       data-toggle="modal" data-target="#statusModal"   class="btn btn-primary fa fa-edit"></a>
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

    <div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="categoryModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h5 class="modal-title" id="categoryModalLabel">{{ __('Add Status') }}</h5>
                </div>
                <div class="modal-body">
                    <form enctype="multipart/form-data" method="POST" action="{{ route('status.store') }}"
                          accept-charset="utf-8">
                        @csrf
                        <div class="form-group">
                            <label for="name">{{__('Status') }}</label>
                            <input type="text" class="form-control" name="name">
                        </div>
                        <button type="submit" class="btn btn-primary float-right">{{ __('Save') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script>

        function editStatus(name,href,event) {
            let modal = $('#statusModal');
            modal.find('.modal-body input[name="name"]').val(name);
            modal.find('.modal-body form').attr("action", href);

        };
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

