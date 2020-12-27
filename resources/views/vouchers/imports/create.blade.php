<x-app-layout>

    @section('title','Sales')
    @section('header')
        <div class="">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Create a imports voucher') }}
            </h2>
        </div>
        <div class="">
            <a href="{{route('imports',app()->getLocale())}}" class="btn btn-sm btn-outline-secondary rounded-0"><i class="fa fa-arrow-left"></i> {{__('Cancel')}}</a>
        </div>
    @endsection

    <div class="panel {{app()->getLocale()=='ar'?'text-right':''}}">
        <div class="panel-heading">
        </div>
        <!--Block Styled Form -->
        <!--===================================================-->
        <form method="post" action="{{route('imports.store',app()->getLocale())}}"  enctype="multipart/form-data" accept-charset="utf-8">
            @csrf
            <div class="panel-body">
                {{-- <input type="hidden" name="type" value="purchase"> --}}
                <div class="row">
                    <div class="col-sm-4" id="for">
                        <div class="form-group">
                            <label for="amount">{{ __('Import from') }}*</label>
                            <input type="text"  class="form-control {{ $errors->has('') ? 'is-invalid' : '' }} "
                                id="to" name="to" value="{{old('to')}}" >
                            @if($errors->has('to'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('to') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="amount">{{ __('amount') }}*</label>
                            <input type="number" step="0.001" class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }} "
                                id="amount" name="amount" min="0" required>
                            @if($errors->has('amount'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('amount') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-4" >
                        <div class="form-group">
                            <label for="amount">{{ __('Paid For') }}*</label>
                            <input type="text"  class="form-control {{ $errors->has('for') ? 'is-invalid' : '' }} "
                                id="for" name="paid_for" value="{{old('paid_for')}}" >
                            @if($errors->has('paid_for'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('paid_for') }}
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
