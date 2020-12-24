@extends('layouts.master')

@section('content')

<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">{{__('Voucher Categories')}}</h3>
    </div>
    <!--Data Table-->
    <!--===================================================-->
    <div class="panel-body">
        <div class="pad-btm form-inline">
            <div class="row">
                <div class="col-sm-6 table-toolbar-left">
                    <div class="btn-group">
                        <a href="#"  data-toggle="modal" data-target="#createCategoryModal" class="btn btn-primary"><i class="fa fa-plus"></i></a>

                    </div>
                </div>

            </div>
        </div>
            <table  id="demo-foo-row-toggler" class="table toggle-arrow-small">
                <thead>
                <tr>
                    <th data-toggle="true">#</th>
                    <th >{{ __('اقسام المنصرف') }}</th>

                    <th >{{ __('Created') }}</th>

                @canany(['create voucher','read voucher'])
                        <th scope="col">{{ __('Actions') }}</th>
                @endcanany
                </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->created_at->format('d/M/Y') }}</td>
                            @canany(['create voucher','read voucher'])
                                <td>

                                    @can('create voucher')
                                        <a href="#" onclick="editBranch( '{{$category->name}}', '{{ route('voucher.category.update',$category) }}',event);"
                                           data-toggle="modal" data-target="#editBranchModal"   class="btn btn-primary fa fa-edit"></a>
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
<div class="modal fade" id="createCategoryModal" tabindex="-1" role="dialog" aria-labelledby="categoryModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title" id="categoryModalLabel">{{ __('Create Voucher Category') }}</h5>
            </div>
            <div class="modal-body">
                <form enctype="multipart/form-data" method="POST" action="{{ route('voucher.category.store') }}"
                      accept-charset="utf-8">
                    @csrf
                        <div class="form-group">
                            <label for="name">{{__('Name') }}</label>
                            <input class="form-control" id="name" name="name" required>
                        </div>
                    <button type="submit" class="btn btn-primary float-right">{{ __('Save') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="editBranchModal" tabindex="-1" role="dialog" aria-labelledby="categoryModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title" id="categoryModalLabel">{{ __('Edit branch') }}</h5>
            </div>
            <div class="modal-body">
                <form enctype="multipart/form-data" method="POST" action="" accept-charset="utf-8">
{{--                    @method('PUT')--}}
                    @csrf
                        <div class="form-group">
                            <label for="name">{{__('Name') }}</label>
                            <input class="form-control" id="name" name="name" value="" required>
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



        $('#demo-foo-row-toggler').dataTable( {
            dom: 'Bfrtip',
            buttons: [
                'excel', 'pdf', 'print'
            ],
            "language": {
                "paginate": {
                    "previous": '<i class="fa fa-angle-left"></i>',
                    "next": '<i class="fa fa-angle-right"></i>'
                }
            },



        } );
        // $('#demo-foo-row-toggler').footable();
        function editBranch(name,href,event) {
            let modal = $('#editBranchModal');
            modal.find('.modal-body input[name="name"]').val(name);
            modal.find('.modal-body form').attr("action", href);

        };
    </script>

@stop
