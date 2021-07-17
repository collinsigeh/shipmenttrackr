@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            {{ __('Search outcome') }}
                        </div>

                        <div class="col-4 text-right">
                            <a href="{{ route('shipments.index') }}" class="my-default-link">&larr; Shipments</a>
                        </div>
                    </div>
                </div>

                <div class="card-body" style="min-height: 550px;">

                    <div class="alert alert-info">
                        {{ $shipments->count() . ' '. Str::plural('result', $shipments->count()) }} found.
                    </div>

                    @include('messages.status_alert')

                    <div id="new-shipment-step-option2">

                        <div class="my-box-content">
                            
                            <div style="height: 10px;"></div>
                            <div class="dashboard-info-set">
                    
                                <div class="text-right mb-3">
                                    <a href="" data-toggle="modal" data-target="#searchShipment" class="btn btn-outline-primary mr-3">Search</a>

                                    <a href="{{ route('shipments.create') }}" class="btn btn-primary">New shipment</a>
                                </div>
                                
                                @if ($shipments->count())
                                    <div class="table-responsive">
                                        <table class="table table-sm table-hover table-striped">
                                            <thead class="text-muted">
                                                <tr>
                                                    <th></th>
                                                    <th>Tracking Code</th>
                                                    <th>Sender</th>
                                                    <th>Receiver</th>
                                                    <th>Status</th>
                                                    <th class="text-right">Expected delivery</th>
                                                    <th class="text-right">Actual delivery</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                
                                            <tbody>
                                                @foreach ($shipments as $shipment)
                                                    <tr>
                                                        <td>
                                                            <img src="
                                                                    @if ($shipment->stage >= 6)
                                                                        
                                                                        {{ asset('images/success-icon.png') }}
                                                                    @elseif($shipment->stage <= 4)
                                                                        {{ asset('images/warning-icon.png') }}
                                                                    @else
                                                                        {{ asset('images/info-icon.png') }}
                                                                    @endif
                                                                " alt="">
                                                        </td>
                
                                                        <td>
                                                            <a href="{{ route('shipments.show', $shipment) }}" class="my-table-link"><strong>{{ $shipment->tracking_code }}</strong></a>
                                                        </td>

                                                        <td>{{ $shipment->sender->name }}</td>

                                                        <td>{{ $shipment->receiver->name }}</td>
                
                                                        <td>
                                                            <span class="badge badge-pill 
                                                                    @php
                                                                        if($shipment->status->name == 'Pending')
                                                                        {
                                                                            echo 'badge-light';
                                                                        }
                                                                        elseif($shipment->status->name == 'Complete' OR
                                                                                $shipment->status->name == 'Completed' OR
                                                                                $shipment->status->name == 'Order Complete' OR
                                                                                $shipment->status->name == 'Order Completed')
                                                                        {
                                                                            echo 'badge-success';
                                                                        }
                                                                        else
                                                                        {
                                                                            echo 'badge-primary';
                                                                        }
                                                                    @endphp">{{ $shipment->status->name }}
                                                                </span>
                                                        </td>

                                                        <td class="text-right">
                                                            <small>
                                                                @if ($shipment->expected_delivery_date)
                                                                    {{ date('d M, Y', strtotime($shipment->expected_delivery_date)) }}
                                                                @else
                                                                    --
                                                                @endif
                                                            </small>
                                                        </td>

                                                        <td class="text-right">
                                                            <small>
                                                                @if ($shipment->actual_delivery_date)
                                                                    {{ date('d M, Y', strtotime($shipment->actual_delivery_date)) }}
                                                                @else
                                                                    --
                                                                @endif
                                                            </small>
                                                        </td>

                                                        <td class="text-right">

                                                            @if ($shipment->stage <= 4)
                                                                <a href=""  data-toggle="modal" data-target="#deleteShipment{{ $shipment->id }}" class="my-table-link-delete">Delete</a>
                                                            @endif
                                                        </td>
                                                        
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <div class="alert alert-info">
                                        No shipment details found.
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@include('modals.search_shipment')

@foreach ($shipments as $shipment)
    @include('modals.delete_shipment')
@endforeach

@endsection
