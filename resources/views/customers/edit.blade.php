@extends('layouts.master')
@section('title',__('Customers'))

@section('content')

    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">{{__('Edit Customers')}}</h3>
        </div>
        <!--Block Styled Form -->
        <!--===================================================-->
        <form method="post" action="{{route('customer.update',$customer)}}"  enctype="multipart/form-data" accept-charset="utf-8">
            @csrf
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="name">{{ __('Name') }}</label>
                            <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }} "
                                   id="name" name="name" value="{{$customer->name}}" required>
                            @if($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="name">{{ __('Email') }}</label>
                            <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }} "
                                   id="name" name="email" value="{{$customer->email}}" required>
                            @if($errors->has('email'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="barcode">{{ __('Phone') }}*</label>
                            <input type="text"  minlength="11" class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }} "
                                   id="phone" name="phone1" value="{{$customer->phone1}}" required>
                            @if($errors->has('phone1'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('phone1') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="barcode">{{ __('Phone2') }}</label>
                            <input type="text"  minlength="11" class="form-control {{ $errors->has('phone2') ? 'is-invalid' : '' }} "
                                   id="phone2" name="phone2" value="{{$customer->phone1}}" >
                            @if($errors->has('phone2'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('phone2') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="barcode">{{ __('WhatsApp Number') }}</label>
                            <input type="text"  minlength="11" class="form-control {{ $errors->has('whatsApp') ? 'is-invalid' : '' }} "
                                   id="whatsApp" name="whatsApp" value="{{$customer->whatsApp}}" >
                            @if($errors->has('whatsApp'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('whatsApp') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-5">
                        <div class="form-group">
                            <label for="address">{{ __('Address') }}*</label>
                            <input type="text" class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }} "
                                   id="address" name="address" value="{{$customer->address}}" required>
                            @if($errors->has('address'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('address') }}
                                </div>
                            @endif
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-sm-8">
                        <div class="form-group">
                            <label for="address">{{ __('Note') }}</label>
                            <textarea  class="form-control {{ $errors->has('note') ? 'is-invalid' : '' }} "
                                       name="note"  >{{ $customer->note }}</textarea>
                            @if($errors->has('note'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('note') }}
                                </div>
                            @endif
                        </div>
                    </div>

                </div>

            </div>
            <div class="panel-footer text-right">
                <button class="btn btn-primary my-2" type="submit">{{__('Save')}}</button>
            </div>
        </form>

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


    </script>
@endsection
