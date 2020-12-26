<x-app-layout>

    @section('title','Sales')
    @section('header')
        <div class="">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Export vouchers') }}
            </h2>
        </div>
        <div class="">
            <a href="{{  URL::previous() }}" class="btn btn-sm btn-outline-secondary rounded-0"><i class="fa fa-arrow-left"></i> {{__('Cancel')}}</a>
        </div>
    @endsection

    <div class="panel p-2">
        <div class="panel-heading">
            <h3 class="panel-title">{{__('New Voucher')}}</h3>
        </div>
        <!--Block Styled Form -->
        <!--===================================================-->
        <form method="post" action="{{route('exports.store')}}"  enctype="multipart/form-data" accept-charset="utf-8">
            @csrf
        <div class="panel-body">
            <input type="hidden" name="type" value="sales">
           {{-- <input type="hidden" name="voucher_cat" value="1"> --}}
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
                                $('.item').append('<li class="searchItems" onclick="addItem(this)" data-id="'+ data[i]['id'] +'" data-name="'+ data[i]['name'] +'" data-price="'+ data[i]['listPrice'] +'"   ><a href="#"><img width="50px" height="40px" src="'+ data[i]['image']+'" style="margin-right: 20px;" > ' + data[i]['name'] + '</a></li>');
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
                $('#voucher_cat').on('change',function () {
                    let val = $(this).val();
                    console.log(val);
                    if(val == 1){
                        $('#suppliers').css('display','block');
                        $('#for').hide();
                        $('#users').hide();
                    }else if(val == 2)
                    {
                        $('#users').show();
                        $('#suppliers').hide();
                        $('#for').hide();

                    }else{
                        $('#suppliers').hide();
                        $('#users').hide();

                        $('#for').show();

                    }
                });
            });


        </script>
    @endsection

</x-app-layout>

