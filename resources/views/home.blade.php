@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <h3>Dashboard</h3>
    </div>

    @include('messages.status_alert')

    <div class="row">
        <div class="col-lg-6">
            <div class="row">
                <div class="col-sm-6">
                    <div id="active-shipments" class="dashboard-box">
                        <div class="title">ACTIVE SHIPMENTS</div>
                        <div class="value">{{ $active_shipments }}</div>
                        <div class="action-buttons">
                            <a href="{{ route('shipments.list', 'active') }}" class="btn btn-sm btn-secondary my-btn-sm">View all</a>
                        </div>
                    </div>
                </div>
                
                <div class="col-sm-6">
                    <div id="pending-shipments" class="dashboard-box">
                        <div class="title">PENDING SHIPMENTS</div>
                        <div class="value">{{ $pending_shipments }}</div>
                        <div class="action-buttons">
                            <a href="{{ route('shipments.list', 'pending') }}" class="btn btn-sm btn-secondary my-btn-sm">View all</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="col-lg-6">
            <div class="row">
                <div class="col-sm-6">
                    <div id="completed-shipments" class="dashboard-box">
                        <div class="title">COMPLETED SHIPMENTS</div>
                        <div class="value">{{ $completed_shipments }}</div>
                        <div class="action-buttons">
                            <a href="{{ route('shipments.list', 'completed') }}" class="btn btn-sm btn-secondary my-btn-sm">View all</a>
                        </div>
                    </div>
                </div>
                
                <div class="col-sm-6">
                    <div id="all-shipments" class="dashboard-box">
                        <div class="title">ALL SHIPMENTS</div>
                        <div class="value">{{ $all_shipments }}</div>
                        <div class="action-buttons">
                            <a href="{{ route('shipments.list', 'all') }}" class="btn btn-sm btn-secondary my-btn-sm">View all</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12 mb-4">
            <h4 class="my-4">Recent shipments</h4>
            
            <div class="dashboard-info-set">

                <div class="text-right mb-4">
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
                                    <th class="text-right">Created on</th>
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
                                                {{ date('d M, Y', strtotime($shipment->created_at)) }}
                                            </small>
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

@include('modals.search_shipment')

@endsection
