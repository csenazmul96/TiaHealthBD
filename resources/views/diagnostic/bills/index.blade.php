@extends('layout.app',['pageTitle' => __('Bills')])
@section('content')

@component('layout.inc.breadcrumb')
@slot('title')
Bill
@endslot
@endcomponent

@include('elements.alert')
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body p-b-2">
                <div class="table-responsive">
                    <table id="myTable" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr class="themeThead">
                                <th width="80"> {{ __('messages.sl')}}</th>
                                <th width="300">Report Delivery</th>
                                <th>Invoice No</th>
                                <th>Paitent Name</th>
                                <th class="text-right">{{ __('messages.paid_amount')}}</th>
                                <th class="text-right">Due</th>
                                <th>Referral Name</th>
                                @if(Sentinel::hasAccess('diagnostic-bill-action'))
                                <th width='150'>{{ __('messages.action')}}</th>
                                @endif
                            </tr>
                        </thead>
                            <tbody>
                            <?php $i = 0;?>
                            @foreach($bills as $bill)
                            <tr>
                                <td>{{ sprintf("%02s",++$i) }}</td>
                                <td> {{date('d M',strtotime($bill->delivary_date)) }} {{ date('g:i A', strtotime($bill->delivary_time)) }} </td>
                                <td>{{ $bill->invoice }}</td>
                                <td>{{ $bill->patient->patient_name }}</td>
                                <td class="text-right">{{ Pharma::amountFormatWithCurrency($bill->actual_paid_amount) }}</td>
                                <td class="text-right">{{ Pharma::amountFormatWithCurrency($bill->due) }}</td>
                                <td>{{ $bill->referral->name }}</td>
                                
                                @if(Sentinel::hasAccess('diagnostic-bill-eidt') || Sentinel::hasAccess('diagnostic-bill-void'))                               
                                <td style="display: flex; justify-content: space-evenly;">
                                    <a class="btn waves-effect waves-light text-light btn-xs btn-primary" href="{{url('diagnostic/bill/invoice/a4/'.$bill->invoice)}}"><i class="mdi mdi-format-align-justify"></i> A4</a>
                                    <a class="btn waves-effect waves-light text-light btn-xs btn-primary" href="{{url('diagnostic/bill/invoice/pos/'.$bill->invoice)}}"><i class="mdi mdi-format-align-justify"></i> Pos</a>                               
                                    @if(Sentinel::hasAccess('diagnostic-bill-eidt'))
                                    <a class="btn waves-effect waves-light text-light btn-xs btn-warning" href="{{url('diagnostic/bill/'.$bill->invoice.'/edit')}}"><i class="fa fa-edit"></i> Edit</a>
                                    @endif
                                    @if(Sentinel::hasAccess('diagnostic-bill-void'))
                                    <form action="{{url('diagnostic/bill/void/'.$bill->slug)}}" method="post" style="margin-top:-2px" id="deleteButton{{$bill->id}}">
                                        @csrf
                                        <button type="submit" class="btn waves-effect waves-light btn-xs btn-danger" onclick="sweetalertDelete({{$bill->id}})"><i class="mdi mdi-backup-restore"></i> Void</button>
                                    </form>
                                    @endif                             
                                </td> 
                                @endif                               
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@include('elements.dataTableOne')
@endsection
