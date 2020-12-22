@extends('layouts.master')
@section('title',__('Customers'))

@section('content')

    <div class="panel">
        <div class="panel-heading">

            <h3 class="panel-title">{{__('Add Customer')}}</h3>
        </div>
        <!--Block Styled Form -->
        <!--===================================================-->
        <form method="post" action="{{route('customer.store')}}"  enctype="multipart/form-data" accept-charset="utf-8">
            @csrf
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="name">{{ __('Name') }}*</label>
                        <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }} "
                               id="name" name="name" value="{{ old('name') }}" required>
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
                               id="name" name="email" value="{{ old('email') }}" >
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
                        <label for="phone">{{ __('Phone') }}*</label>
                        <input type="text"  minlength="11" class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }} "
                               id="phone" name="phone" value="{{ old('phone') }}" required>
                        @if($errors->has('phone'))
                            <div class="invalid-feedback">
                                {{ $errors->first('phone') }}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="barcode">{{ __('WhatsApp Number') }}</label>
                        <input type="text"  minlength="11" class="form-control {{ $errors->has('whatsApp') ? 'is-invalid' : '' }} "
                               id="whatsApp" name="whatsApp" value="{{ old('whatsApp') }}" >
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
                               id="address" name="address" value="{{ old('address') }}" required>
                        @if($errors->has('address'))
                            <div class="invalid-feedback">
                                {{ $errors->first('address') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="barcode">{{ __('Paid') }}*</label>
                        <input type="number" class="form-control {{ $errors->has('paid') ? 'is-invalid' : '' }} "
                               id="paid" name="paid" value="" required>
                        @if($errors->has('paid'))
                            <div class="invalid-feedback">
                                {{ $errors->first('paid') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="barcode">{{ __('Remaining') }}*</label>
                        <input type="number" class="form-control {{ $errors->has('remaining') ? 'is-invalid' : '' }} "
                               id="remaining" name="remaining" value="" required>
                        @if($errors->has('remaining'))
                            <div class="invalid-feedback">
                                {{ $errors->first('remaining') }}
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
                                   name="note" value="{{ old('note') }}" ></textarea>
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


@stop
@section('scripts')
    <script>


    </script>
@endsection
