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

            <h3 class="panel-title">{{__('New Invoice')}}</h3>
        </div>
        <!--Block Styled Form -->
        <!--===================================================-->
        <form method="post" action="{{route('invoice.store')}}"  enctype="multipart/form-data" accept-charset="utf-8">
            @csrf
        <div class="panel-body">
            <input type="hidden" name="type" value="purchase">
            <div class="row">
                <div class="col-md-6 mb-2">
                    <label for="supplier_id">{{ __('Suppliers') }}*</label>
                    <select name="supplier_id" id="supplier"
                            class="form-control custom-select auto-save select" required>
                        <option value="">{{ __('Select') }} {{ __('Supplier') }}</option>
                        @foreach($suppliers as $key=>$value)
                            <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('supplier_id'))
                        <div class="invalid-feedback">
                            {{ $errors->first('supplier_id') }}
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
                            <th>{{__('Name')}}</th>
                            <th>{{__('Price')}}</th>
                            <th>{{__('Weight')}}</th>
                            <th>{{__('Quantity')}}</th>
                            <th>{{__('Total')}}</th>
                            <th>{{__('Warehouse')}}</th>
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
                        <input type="number" id="total" onkeyup="getRemaining()" class="form-control {{ $errors->has('total') ? 'is-invalid' : '' }} "
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
                               id="paid" name="paid" value="0" required>
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
{{--    <div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="categoryModalLabel"--}}
{{--         aria-hidden="true">--}}
{{--        <div class="modal-dialog" role="document">--}}
{{--            <div class="modal-content">--}}
{{--                <div class="modal-header">--}}
{{--                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                        <span aria-hidden="true">&times;</span>--}}
{{--                    </button>--}}
{{--                    <h5 class="modal-title" id="categoryModalLabel">{{ __('Add Type') }}</h5>--}}
{{--                </div>--}}
{{--                <div class="modal-body">--}}
{{--                    <form enctype="multipart/form-data" method="POST" action="{{ route('customer.status.store') }}"--}}
{{--                          accept-charset="utf-8">--}}
{{--                        @csrf--}}
{{--                        <div class="form-group">--}}
{{--                            <label for="name">{{__('Type') }}</label>--}}
{{--                            <input type="text" class="form-control" name="name" >--}}
{{--                        </div>--}}
{{--                        <button type="submit" class="btn btn-primary float-right">{{ __('Save') }}</button>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}


@stop
@section('scripts')
    <script src="{{ asset('front/js/select2.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('.select').select2();
            $('#items').on('keyup', function() {
                var value = $(this).val();
                let url =  '{{url('/items/search')}}';
                $.ajax({
                    url: url+'/'+value,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $('.searchItems').remove()
                        let i = 0 ;
                        $.each(data, function() {
                            $('.item').append('<li class="searchItems" onclick="addItem(this)" data-id="'+ data[i]['id'] +'" data-name="'+ data[i]['name'] +'"    ><a href="#"> ' + data[i]['name'] + '</a></li>');
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
        function addItem(data) {
            let id = $(data).attr('data-id');
            let name = $(data).attr('data-name');
            let price = $(data).attr('data-price');
            // console.log(price);
            $('#table tbody').append(
                '<tr>\n' +
                '  <input class="form-control" type="hidden" name="items['+index+'][item_id]" value="'+id+'"> \n' +
                '  <td><input class="form-control" type="text" name="items['+index+'][name]" value="'+name+'" readonly>  </td>\n' +
                '  <td><input class="form-control" type="number" onkeyup="itemTotal(this)" data-id="'+index+'" name="items['+index+'][price]" value="" >  </td>\n' +
                '  <td><input class="form-control" type="number" onkeyup="itemTotal(this)" data-id="'+index+'" name="items['+index+'][weight]" value="" >  </td>\n' +
                '  <td><input class="form-control qty"  onkeyup="itemTotal(this)" type="number" data-id="'+index+'" name="items['+index+'][quantity]" value="1" required>  </td>\n' +
                '  <td><input class="form-control itemTotal" type="number" name="items['+index+'][total]" value="" readonly>  </td>\n' +
                ' <td >\n' +
                '   <select name="items['+index+'][warehouse_id]" class="form-control custom-select auto-save " required>\n' +
                '     <option value=""> {{ __("Select") }} {{ __("Warehouse") }}</option>\n' +
                                       @foreach($warehouses as $key=>$value)
                '                            <option {{ $key==1 ?'selected':''}} value="{{ $key }}">{{ $value }}</option> \n' +
                                        @endforeach
                '                    </select>\n' +
                '                </td>' +
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
                            if(parseInt($('.itemTotal')[i].value))
                                totalPrice += parseInt($('.itemTotal')[i].value);
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
                    totalPrice += parseInt($('.itemTotal')[i].value);
            }
            $('#total').attr('value',totalPrice-discount);
            $('#remaining').val(totalPrice-discount);
            // console.log( );
        }
        function itemTotal(qty) {
           // let Qty = qty.value;
           let id = $(qty).attr('data-id');
           let price =  $('input[name="items['+id+'][price]"]').val();
           let weight =  $('input[name="items['+id+'][weight]"]').val();
           let Qty =  $('input[name="items['+id+'][quantity]"]').val();
           let itemTotalPrice = price*((Qty*weight)/1000) ;
           // alert(price);
           $('input[name="items['+id+'][total]"]').attr('value',itemTotalPrice);
            let totalPrice = 0;
            for(var i=0;i<$('.itemTotal').length;i++){
                if(parseInt($('.itemTotal')[i].value))
                    totalPrice += parseInt($('.itemTotal')[i].value);
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
