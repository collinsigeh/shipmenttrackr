@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            {{ __('Shipments') }}
                        </div>

                        <div class="col-4 text-right">
                            <a href="{{ route('home') }}" class="my-default-link">&larr; Home</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">

                    @include('messages.status_alert')
                    
                    <div class="text-right mb-3">
                        <a href="{{ route('shipments.create') }}" class="btn btn-primary">New shipment</a>
                    </div>

                    <div id="new-shipment-step-option2">

                        <div class="my-box-content">
                            
                            <div style="height: 10px;"></div>
                            <div class="info-set">

                                <div class="table-responsive">
                                    <table class="table table-sm table-hover">
                                        <thead>
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
                                                    <td><img src="{{ asset('images/info-icon.png') }}" alt=""></td>
            
                                                    <td style="padding-bottom: 20px;">
                                                        <p>
                                                            <a href="{{ route('shipments.show', $shipment) }}" class="my-table-link"><strong>{{ $shipment->tracking_code }}</strong></a>
                                                        </p>
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
                                                            <form action="" method="post">
                                                                @csrf
                                                                @method('DELETE')
            
                                                                <button type="submit" class="my-table-link-delete">Delete</button>
                                                            </form>
                                                        @endif
                                                    </td>
                                                    
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
