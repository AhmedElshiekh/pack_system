@extends('layouts.master')
@section('style')
    <style>
        .item li {
            border: 1px solid
            #ddd;
            margin-top: -1px;
            background-color: #f6f6f6;
            padding: 12px;
            text-decoration: none;
            font-size: 18px;
            color:
                black;
            display: block;
        }
    </style>
@endsection
@section('content')

    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">{{__('New Voucher')}}</h3>
        </div>
        <!--Block Styled Form -->
        <!--===================================================-->
        <form method="post" action="{{route('voucher.sales.store')}}"  enctype="multipart/form-data" accept-charset="utf-8">
            @csrf
            <div class="panel-body">
                <input type="hidden" name="type" value="sales">
                <div class="row">
                    <div class="col-md-6 mb-2 fl-l">
                        <label for="voucher_cat">{{ __('Customers') }}*</label>
                        <select name="customer_id" id="customer_id"
                                class="form-control custom-select  select" required>
                            <option value="" selected>{{ __('Select') }} {{ __('Customer') }}</option>
                            @foreach($customers as $key=>$value)
                                <option value="{{ $key }}">{{  __($value) }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('customer_id'))
                            <div class="invalid-feedback">
                                {{ $errors->first('customer_id') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="amount">{{ __('amount') }}*</label>
                            <input type="number"  class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }} "
                                   id="amount" name="amount" value="" min="1" required>
                            @if($errors->has('amount'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('amount') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-3" >
                        <div class="form-group">
                            <label for="amount">{{ __('Paid For') }}*</label>
                            <input type="text"  class="form-control {{ $errors->has('for') ? 'is-invalid' : '' }} "
                                   id="for" name="paid_for" value="{{old('paid_for')}}" required>
                            @if($errors->has('paid_for'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('paid_for') }}
                                </div>
                            @endif
                        </div>
                    </div>


                </div>
                <div class="row">
                    <div class="col-sm-3" >
                        <div class="form-group">
                            <label for="weight">{{ __('الوزن') }}*</label>
                            <input type="text" onkeyup="removeRequierd(this)" class="form-control {{ $errors->has('weight') ? 'is-invalid' : '' }} "
                                   id="weight" name="weight" value="{{old('weight')}}" >
                            @if($errors->has('weight'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('weight') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="quantity">{{ __('العدد') }}*</label>
                            <input type="text"  class="form-control {{ $errors->has('quantity') ? 'is-invalid' : '' }} "
                                   id="quantity" name="quantity" value="{{old('quantity')}}" >
                            @if($errors->has('quantity'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('quantity') }}
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
    <script src="{{ asset('front/js/select2.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('.select').select2();


        });
        // function removeRequierd(val){
        //     if(val.value){
        //         $('#number').removeAttr('required');
        //     }
        // }

    </script>
@endsection
