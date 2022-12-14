<x-app-layout>

    @section('title',__('Customers'))

    @section('header')
        <div class="">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Create Customers') }}
            </h2>
        </div>
        <div class="">
            <a href="{{route('customer',app()->getLocale())}}" class="btn btn-sm btn-outline-secondary rounded-0"><i class="fa fa-arrow-left"></i> {{__('Cancel')}}</a>
        </div>
    @endsection

    <div class="panel {{app()->getLocale()=='ar'?'text-right':''}}">
        <div class="panel-heading"></div>
        <form method="post" action="{{route('customer.store' ,app()->getLocale())}}"  enctype="multipart/form-data" accept-charset="utf-8">
            @csrf
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-4">
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
                    <div class="col-lg-4">
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
                    <div class="col-lg-4">
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
                    <div class="col-lg-4">
                        <div class="row">
                            <div class="col-lg-12">
                            <div class="form-group">
                                <label for="barcode">{{ __('Paid') }}</label>
                                <input type="number" class="form-control {{ $errors->has('paid') ? 'is-invalid' : '' }} "
                                        id="paid" name="paid" value="" required>
                                @if($errors->has('paid'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('paid') }}
                                    </div>
                                @endif
                            </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                            <div class="form-group">
                                <label for="barcode">{{ __('Remaining') }}</label>
                                <input type="number" class="form-control {{ $errors->has('remaining') ? 'is-invalid' : '' }} "
                                        id="remaining" name="remaining" value="0" required>
                                @if($errors->has('remaining'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('remaining') }}
                                    </div>
                                @endif
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="form-group">
                            <label for="address">{{ __('Note') }}</label>
                            <textarea  class="form-control {{ $errors->has('note') ? 'is-invalid' : '' }} " rows="4" name="note" value="{{ old('note') }}" ></textarea>
                            @if($errors->has('note'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('note') }}
                                </div>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
            <div class="panel-boody text-center">
                <button class="btn btn-primary rounded-0 my-2" type="submit">{{__('Save')}}</button>
            </div>
        </form>

    </div>

</x-app-layout>

