@extends('layouts.master')

@section('content')


    <!--===================================================-->
    {{--            style="background-image: url({{asset('images/logo.png')}});background-size: 50% 50%;background-repeat: no-repeat;background-position:bottom center;"--}}
    <div class="invoice-wrapper" >
        <section class="invoice-container">
            <div class="invoice-inner">
                <div class="row">
                    <div class="col-xs-6 img">
                        <img src="{{asset('images/logo.png')}}" style="width:50%">
                    </div>
                </div>
                <div class="text-center">
                    <h3 class="ltr"> {{__('اقرار استلام كامل')}} </h3>
                </div>
                <h3>{{__('التاريخ:')}}{{$invoice->created_at->format('d/m/Y')}}</h3>
                <h3>{{__('الساده:')}} {{__('شركه ارت ديزين')}}</h3>
                 <h3 class="text-center">{{__('تحيه طيبه وبعد')}}</h3>
                <span style="font-size: 20px;">{{__('اقر انا/')}}
                    @if($invoice->customer_id)
                        {{ $invoice->customer->name }}
                    @elseif($invoice->supplier_id)
                        {{ $invoice->supplier->name }}
                    @endif
                </span>
                <span style="font-size: 20px;position: absolute;right: 400px">{{__('بطاقه رقم قومي/')}}{{$invoice->customer->NationalID}}</span><br>
                <span style="font-size: 20px">{{__('ممثلا عن /')}}</span>
                <span style="font-size: 20px;position: absolute;right: 400px">{{__(' بصفتي /')}}</span>
                <p style="font-size: 18px;">{{__('بأنني استلمت الاصناف الوارد ذكرها سليمه وتعمل بحالتها الاصليه وحصلت علي التدريب المناسب للتعامل معها فيما بعد بصوره جيده وانها خاليه من اي عيوب صناعيه .')}}</p>
                <p style="font-size: 18px;">{{__('وذلك بالعنوان الكائن في')}}
                    @if($invoice->customer_id)
                        {{ $invoice->customer->address }}
                    @elseif($invoice->supplier_id)
                        {{ $invoice->supplier->address }}
                    @endif
                </p>





                <div class="row">
                    <div class="col-md-12 pad-top">
                        <div class="panel panel-default">

                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-condensed">
                                        <thead>
                                        <tr>
                                            <td><strong>{{__('م')}}</strong></td>
                                            <td class="text-center"><strong>{{__('الصنف')}}</strong></td>
                                            <td class="text-center"><strong>{{__('الموديل')}}</strong></td>
                                            <td class="text-center"><strong>{{__('العدد')}}</strong></td>
                                            <td class="text-center"><strong>{{__('اتجاه الفتح')}}</strong></td>
                                            <td class="text-center"><strong>{{__('الملاحظات')}}</strong></td>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($invoice->items as $item)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td class="text-center">{{$item->name}}</td>
                                                <td class="text-center">{{$item->model}}</td>
                                                <td class="text-center">{{$item->pivot->quantity}}</td>
                                                <td class="text-center">{{$item->direction}}</td>
                                                <td class="text-center" style="width: 100px"> </td>


                                            </tr>
                                        @endforeach



                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <h2 style="text-align: left">{{__('المقر بما فيه')}}</h2>

                <div class="text-center no-print">
                    <a class="btn btn-primary btn-lg" onClick="jQuery('#page-content').print()">
                        <i class="fa fa-print"></i> Print
                    </a>
                </div>
            </div>
        </section>
    </div>
    <!--===================================================-->



@stop





