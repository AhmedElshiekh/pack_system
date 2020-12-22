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
@section('title','المبيعات')
@section('content')

    <div class="panel">
        <div class="panel-heading">

            <h3 class="panel-title">{{__('New Invoice')}}</h3>
        </div>
        <!--Block Styled Form -->
        <!--===================================================-->
        <form method="post" action="{{route('invoice.sales.store')}}"  enctype="multipart/form-data" accept-charset="utf-8">
            @csrf
        <div class="panel-body">
            <input type="hidden" name="type" value="sales">
            <div class="row">
                <div class="col-md-6 mb-2">
                    <label for="customer_id">{{ __('Customer') }}*</label>
                    <select name="customer_id" id="customer_id"
                            class="form-control custom-select auto-save select" required >
                        <option value="">{{ __('Select') }} {{ __('Customer') }}</option>
                        @foreach($customers as $key=>$value)
                            <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('customer_id'))
                        <div class="invalid-feedback">
                            {{ $errors->first('customer_id') }}
                        </div>
                    @endif
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="name">{{ __('Items') }}</label>
                        <input type="text" class="form-control"  id="items" name="itemsSearch"  >
                        <ul class="item" style="list-style-type: none;padding: 0;margin: 0;">

                        </ul>
                        @if($errors->has('itemsSearch'))
                            <div class="invalid-feedback">
                                {{ $errors->first('itemsSearch') }}
                            </div>
                        @endif
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-sm-9">
                    <table id="table" class="table ">
                        <thead>
                            <th>{{'Item Name'}}</th>
                            <th>{{'Item Price'}}</th>
                            <th>{{'Quantity'}}</th>
                            <th>{{'Total'}}</th>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="discount">{{ __('Discount') }}*</label>
                        <input type="number" id="discount" onkeyup="discountPrice(this)" class="form-control {{ $errors->has('discount') ? 'is-invalid' : '' }} "
                                name="discount" value="0" required>
                        @if($errors->has('discount'))
                            <div class="invalid-feedback">
                                {{ $errors->first('discount') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="total">{{ __('Total') }}*</label>
                        <input type="number" id="total"  onkeyup="getRemaining()" class="form-control {{ $errors->has('total') ? 'is-invalid' : '' }} "
                                name="total" value="0" required >
                        @if($errors->has('total'))
                            <div class="invalid-feedback">
                                {{ $errors->first('total') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="barcode">{{ __('Paid') }}*</label>
                        <input type="number" onkeyup="getRemaining()" class="form-control {{ $errors->has('paid') ? 'is-invalid' : '' }} "
                               id="paid" name="paid" min="0" value="0" required>
                        @if($errors->has('paid'))
                            <div class="invalid-feedback">
                                {{ $errors->first('paid') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="barcode">{{ __('Remaining') }}*</label>
                        <input type="number" class="form-control {{ $errors->has('remaining') ? 'is-invalid' : '' }} "
                               id="remaining" name="remaining" value="0" required readonly>
                        @if($errors->has('remaining'))
                            <div class="invalid-feedback">
                                {{ $errors->first('remaining') }}
                            </div>
                        @endif
                    </div>
                </div>

            </div>


            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="payment">{{ __('Payment Method') }}*</label>
                        <select name="payment" id="payment"
                                class="form-control custom-select " required>
                            <option value="">{{ __('Select') }} {{ __('Payment') }}</option>
                            <option value="Cache">{{__('Cache')}}</option>
                            <option value="Visa">{{__('Visa')}}</option>
                            <option value="Check">{{__('Check')}}</option>
                            <option value="Bank_Transfer">{{__('Bank Transfer')}}</option>
                        </select>
                        @if($errors->has('payment'))
                            <div class="invalid-feedback">
                                {{ $errors->first('payment') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="due_date">{{ __('تاريخ الاسنحقاق') }}*</label>
                        <input type="date" class="form-control {{ $errors->has('due_date') ? 'is-invalid' : '' }} "
                               id="due_date" name="due_date"  required style="line-height: 15px;">
                        @if($errors->has('due_date'))
                            <div class="invalid-feedback">
                                {{ $errors->first('due_date') }}
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
                                   name="note" value="{{ old('note') }}" >{{ old('note') }}</textarea>
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
            $('#items').on('keyup', function() {
                var value = $(this).val();
                let url =  '{{url('/products/search')}}';
                $.ajax({
                    url: url+'/'+value,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $('.searchItems').remove();
                        let i = 0 ;
                        $.each(data, function() {
                            $('.item').append('<li class="searchItems" onclick="addItem(this)" data-id="'+ data[i]['id'] +'" data-name="'+ data[i]['name'] +'" data-price="'+ data[i]['totalItem'] +'" data-qty="'+ data[i]['currentQty'] +'" ><a href="#"> ' + data[i]['name'] + '</a></li>');
                            // $('.item').append('<li class="searchItems"   data-id="+ data[i][\'id\'] +" ><a class="ee" href="#"><img width="50px" src="'+ data[i]['image']+'" style="margin-right: 20px;" > ' + data[i]['name'] + '</a></li>');
                            i++;
                        });
                       // });
                    },
                    error:function() {
                        $('.searchItems').remove();
                    }
                });
            });

        });
        function myFunction(){
            // $('.searchItems').hide();
        }
        let index= 1;
        let x= 0;
        function addItem(data) {
            let id = $(data).attr('data-id');
            let name = $(data).attr('data-name');
            let price = $(data).attr('data-price');
            let qty = $(data).attr('data-qty');
            // let warehouses = $(data).attr('data-warehouses');


            $('#table tbody').append(
                '<tr>\n' +
                '  <input class="form-control" type="hidden" name="items['+index+'][product_id]" value="'+id+'"> \n' +
                '  <td><input class="form-control" type="text" name="items['+index+'][name]" value="'+name+'" readonly>  </td>\n' +
                '  <td><input class="form-control" type="number" name="items['+index+'][price]" value="'+price+'" readonly>  </td>\n' +
                '  <td><input class="form-control qty"  onkeyup="itemTotal(this)" type="number" data-id="'+index+'" name="items['+index+'][quantity]" value="'+qty+'" required>  </td>\n' +
                '  <td><input class="form-control itemTotal" type="number" name="items['+index+'][total]" value="" readonly>  </td>\n' +
                '   <td><button type="button" class="btn btn-link" onclick="removeAttr(this);">' + "{{ __('Delete') }}" + '</button></td>' +

                '</tr>');
            $('.searchItems').remove();
            index++

        }
        function removeAttr(el) {
            swal({
                title: "{{ __('Are you sure') }}?",
                text: "{{ __('You are deleting this item') }} ",
                // icon: "warning",
                showCancelButton: true,
                confirmButtonColor: '#DD6B55',
                confirmButtonText: '{{ __('Yes, I am sure!') }}',
                cancelButtonText: "{{ __('No, cancel it') }}"
            }).then(
                function (obj) {
                    // if (obj.value) {

                        $(el).parents('tr').remove();
                        let totalPrice = 0;
                        for(var i=0;i<$('.itemTotal').length;i++){
                            if(parseFloat($('.itemTotal')[i].value))
                                totalPrice += parseFloat($('.itemTotal')[i].value);
                        }
                        $('#total').attr('value',totalPrice);
                        $('#discount').val(0);
                        $('#remaining').val(0);
                        $('#paid').val(0);
                    // }
                }
            );
        }
        function discountPrice(discount) {
            discount  =  discount.value;
            // let total = $('#total').attr('value');
            let totalPrice = 0;
            for(var i=0;i<$('.itemTotal').length;i++){
                if(parseInt($('.itemTotal')[i].value))
                    totalPrice += parseFloat($('.itemTotal')[i].value);
            }
            $('#total').attr('value',totalPrice-discount);
            $('#remaining').val(totalPrice-discount);
            $('#paid').val(0);
            // console.log( );
        }
        function itemTotal(qty) {
           let Qty = qty.value;
           let id = $(qty).attr('data-id');
           let price =  $('input[name="items['+id+'][price]"]').attr('value');
           let itemTotalPrice = price*Qty ;
           $('input[name="items['+id+'][total]"]').attr('value',itemTotalPrice);
            let totalPrice = 0;
            for(var i=0;i<$('.itemTotal').length;i++){
                if(parseFloat($('.itemTotal')[i].value))
                    totalPrice += parseFloat($('.itemTotal')[i].value);
            }
            $('#total').val(totalPrice);
            $('#discount').val(0);
            $('#remaining').val(totalPrice);
            $('#paid').val(0);
        }

        function getRemaining() {
            paid  =  $('#paid').val();
            let total = $('#total').val();
            $('#remaining').val(total-paid);
        }
    </script>
@endsection
