<x-app-layout>

    @section('title','Sales')
    @section('header')
        <div class="">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('New Sales invoice') }}
            </h2>
        </div>
        <div class="">
            <a href="{{route('sales',app()->getLocale())}}" class="btn btn-sm btn-outline-secondary rounded-0"><i class="fa fa-arrow-left"></i> {{__('Cancel')}}</a>
        </div>
    @endsection

    <div class="panel {{app()->getLocale()=='ar'?'text-right':''}}">
        <div class="panel-heading"> </div>
        <form method="post" action="{{route('sales.store',app()->getLocale())}}"  enctype="multipart/form-data" accept-charset="utf-8">
            @csrf
            <div class="panel-body">
                <input type="hidden" name="type" value="sales">
                <div class="row">
                    <div class="col-7">
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

                </div>
                <br>

                <div class="row">
                    <div class="col-10">
                        <table id="table" class="table ">
                            <thead>
                                <th>{{__('Item Name')}}</th>
                                <th>{{__('Item Price')}}</th>
                                <th>{{__('Item Size')}}</th>
                                <th>{{__('Quantity')}}</th>
                                <th>{{__('Total')}}</th>
                            </thead>
                            <tbody id='tbody'>
                                <td><input class="form-control" type="text" name="item_name_1" value="" size="50"></td>
                                <td><input class="form-control" type="number" step="0.001" min="0" onkeyup="itemTotal(this)" data-id="1" name="item_price_1" value="" ></td>
                                <td><input class="form-control" type="number" onkeyup="itemTotal(this)" data-id="1" name="item_weight_1" value="" >  </td>
                                <td><input class="form-control qty"  onkeyup="itemTotal(this)" type="number" data-id="1" name="item_quantity_1" value="1" required></td>
                                <td><input class="form-control itemTotal" type="number" name="item_total_1" value="" readonly></td>
                                <td><button type="button" class="btn btn-link " onclick="removeAttr(this);">{{ __('Delete') }}</button></td>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-2 flex items-end">
                        <div class="m-4">
                            <a class="btn btn-outline-secondary" id="addBtn">{{__("Add Item")}}</a>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="discount">{{ __('Discount') }}*</label>
                            <input type="number" id="discount" onkeyup="discountPrice(this)" class="form-control {{ $errors->has('discount') ? 'is-invalid' : '' }} "
                                    name="discount" value="" required>
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
                                    name="total" value="" required readonly>
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
                            <input type="number" step="0.001" onkeyup="getRemaining()" class="form-control {{ $errors->has('paid') ? 'is-invalid' : '' }} "
                                id="paid" name="paid" min="0" value="" required>
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
                                id="remaining" name="remaining" value="" required readonly>
                            @if($errors->has('remaining'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('remaining') }}
                                </div>
                            @endif
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-12">
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
            <div class="panel-body text-center">
                <button class="btn btn-outline-success rounded-0 my-2 px-5" type="submit">{{__('Save')}}</button>
            </div>
        </form>

    </div>

    @section('scripts')
        <script src="{{ asset('front/js/select2.min.js') }}"></script>

        <script>
            $(document).ready(function() {
                var rowIdx = 1;
                $('#addBtn').on('click', function () {
                    $('#tbody').append(
                        `<tr>
                            <input class="form-control" type="hidden" name="item_count" value="${++rowIdx}" size="50">
                            <td><input class="form-control" type="text" name="item_name_${rowIdx}" value="" ></td>
                            <td><input class="form-control" type="number" step="0.001" min="0" onkeyup="itemTotal(this)" data-id="${rowIdx}" name="item_price_${rowIdx}" value="" >  </td>
                            <td><input class="form-control" type="number" onkeyup="itemTotal(this)" data-id="${rowIdx}" name="item_weight_${rowIdx}" value="" >  </td>
                            <td><input class="form-control qty"  onkeyup="itemTotal(this)" type="number" data-id="${rowIdx}" name="item_quantity_${rowIdx}" value="1" required>  </td>
                            <td><input class="form-control itemTotal" type="number" name="item_total_${rowIdx}" value="" readonly>  </td>
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
                            if(parseFloat($('.itemTotal')[i].value))
                                totalPrice += parseFloat($('.itemTotal')[i].value);
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
                let totalPrice = 0;
                for(var i=0;i<$('.itemTotal').length;i++){
                    if(parseInt($('.itemTotal')[i].value))
                        totalPrice += parseFloat($('.itemTotal')[i].value);
                }
                $('#total').attr('value',totalPrice-discount);
                $('#remaining').val(totalPrice-discount);
                $('#paid').val(0);
            }
            function itemTotal(qty) {
            // let Qty = qty.value;
            let id = $(qty).attr('data-id');
            let price =  $('input[name="item_price_'+id+'"]').val();
            let Qty =  $('input[name="item_quantity_'+id+'"]').val();
            let itemTotalPrice = price*Qty ;
            $('input[name="item_total_'+id+'"]').attr('value',itemTotalPrice);
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

</x-app-layout>
