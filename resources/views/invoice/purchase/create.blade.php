<x-app-layout>
    @section('title',__('Purchase'))
    @section('header')
        <div class="">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('New purchase invoice') }}
            </h2>
        </div>
        <div class="">
            <a href="{{  URL::previous() }}" class="btn btn-sm btn-outline-secondary rounded-0"><i class="fa fa-arrow-left"></i> {{__('Cancel')}}</a>
        </div>
    @endsection


    <div class="panel">
        <div class="panel-heading"></div>
        <!--Block Styled Form -->
        <!--===================================================-->
        <form method="post" action="{{route('purchase.store')}}"  enctype="multipart/form-data" accept-charset="utf-8">
            @csrf
            <div class="panel-body">
                <input type="hidden" name="type" value="purchase">
                <div class="row">
                    <div class="col-8 mb-2">
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
                    <div class="col-4">
                        <div class="form-group">
                            <label for="due_date">{{ __('due date') }}*</label>
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
                    <div class="col-10">
                        <table id="table" class="table ">
                            <thead>
                                <th>{{__('Name')}}</th>
                                <th>{{__('Price')}}</th>
                                <th>{{__('Weight')}}</th>
                                <th>{{__('Quantity')}}</th>
                                <th>{{__('Total')}}</th>
                                {{-- <th>{{__('Warehouse')}}</th> --}}
                            </thead>
                            <tbody id='tbody'> </tbody>
                        </table>
                    </div>
                    <div class="col-2 flex-row">
                        <div class="flex flex-col">
                            <a class="btn btn-outline-secondary" id="addBtn">{{__("Add Item")}}</a>
                        </div>
                    </div>
                </div>
                <hr>
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
                    {{-- <div class="col-sm-3">
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
                    </div> --}}

                </div>
                <div class="row">
                    <div class="col-12">
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
            <div class="panel-body text-center">
                <button class="btn btn-outline-success rounded-0 my-2 px-5" type="submit">{{__('Save')}}</button>
            </div>
        </form>

    </div>

    @section('scripts')
        <script>
            $(document).ready(function() {
                var rowIdx = 0;
                $('#addBtn').on('click', function () {
                    $('#tbody').append(
                        // {++rowIdx}
                        `<tr>
                            <input class="form-control" type="hidden" name="item_count" value="${++rowIdx}">
                            <td><input class="form-control" type="text" name="item_name_${rowIdx}" value="" ></td>
                            <td><input class="form-control" type="number" onkeyup="itemTotal(this)" data-id="'+index+'" name="item_price_${rowIdx}" value="" >  </td>
                            <td><input class="form-control" type="number" onkeyup="itemTotal(this)" data-id="'+index+'" name="item_weight_${rowIdx}" value="" >  </td>
                            <td><input class="form-control qty"  onkeyup="itemTotal(this)" type="number" data-id="" name="item_quantity_${rowIdx}" value="1" required>  </td>
                            <td><input class="form-control itemTotal" type="number" name="items['+index+'][total]" value="" readonly>  </td>
                            <td><button type="button" class="btn btn-link " onclick="removeAttr(this);">{{ __('Delete') }}</button></td>
                        </tr>`
                    );
                });
                $('#tbody').on('click', '.remove', function () {
                    var child = $(this).closest('tr').nextAll();
                    child.each(function () {
                        var id = $(this).attr('id');
                        var idx = $(this).children('.row-index').children('p');
                        var dig = parseInt(id.substring(1));
                        idx.html(`Row ${dig - 1}`);
                        $(this).attr('id', `R${dig - 1}`);
                    });
                    $(this).closest('tr').remove();
                    rowIdx--;
                });
            });
            function removeAttr(el) {
                swal({
                    title: "{{ __('Are you sure') }}?",
                    text: "{{ __('You are deleting this item') }} ",
                    showCancelButton: true,
                    confirmButtonColor: '#DD6B55',
                    confirmButtonText: '{{ __('Yes, I am sure!') }}',
                    cancelButtonText: "{{ __('No, cancel it') }}"
                }).then(
                    function (obj) {
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
                    }
                );
            }
            function discountPrice(discount) {
                discount  =  discount.value;
                let totalPrice ;
                for(var i=0;i<$('.itemTotal').length;i++){
                    if(parseInt($('.itemTotal')[i].value))
                    totalPrice += parseInt($('.itemTotal')[i].value);
                }
                $('#total').attr('value',totalPrice-discount);
                $('#remaining').val(totalPrice-discount);
            }
            function itemTotal(qty) {
            let id = $(qty).attr('data-id');
            let price =  $('input[name="items['+id+'][price]"]').val();
            let weight =  $('input[name="items['+id+'][weight]"]').val();
            let Qty =  $('input[name="items['+id+'][quantity]"]').val();
            let itemTotalPrice = price*((Qty*weight)/1000) ;
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
</x-app-layout>