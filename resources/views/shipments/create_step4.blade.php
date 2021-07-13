@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <h3 class="mb-4">New shipment</h3>

    <div class="row">
        <div class="col-md-8 mb-4">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8"><span class="badge badge-primary">Step 4 of 4</span> - Add cargo items</div>

                        <div class="col-4 text-right"><a href="{{ route('shipments.show', $shipment) }}" class="my-default-link">Skip for now</a></div>
                    </div>
                </div>

                <div class="card-body">

                    @if (session('error_status'))
                        <div class="alert alert-danger alert-dismissible fade show">
                            {{ session('error_status') }}

                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>

                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    
                    <div class="my-box">
                        <table class="table table-sm table-hover table-borderless">
                            <tr>
                                <td style="padding: 20px 0 20px 20px; width: 115px; vertical-align: middle;" class="text-muted"><em>Tracking Code:</em></td>

                                <td style="padding: 20px; 20px 20px 0;"><span class="tracking-code">{{ strtoupper($shipment->tracking_code) }}</span></td>
                            </tr>
                        </table>
                    </div>
                    
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="my-box">
                                <div class="my-box-title">
                                    Sender
                                </div>

                                <div class="my-box-content">

                                    <span class="main-info">{{ $shipment->sender->name }}</span><br>
                                    {{ $shipment->sender->email }}<br>
                                    {{ $shipment->sender->phone }}<br>
                                    {{ $shipment->sender->address }}

                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-6">
                            <div class="my-box">
                                <div class="my-box-title">
                                    Reciever
                                </div>

                                <div class="my-box-content">

                                    <span class="main-info">{{ $shipment->receiver->name }}</span><br>
                                    {{ $shipment->receiver->email }}<br>
                                    {{ $shipment->receiver->phone }}<br>
                                    {{ $shipment->receiver->address }}

                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div id="new-shipment-step-option2">
                        <div class="my-form-title">
                            Shipping details
                        </div>
                        
                        <div class="my-box-content">

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="table-responsive">
                                        <table class="table table-sm table-hover">
                                            <tr>
                                                <td class="text-muted" style="width: 150px;"><em>Order Status</em></td>
            
                                                <td><span class="badge badge-pill badge-primary">{{ $shipment->status->name }}</span></td>
                                            </tr>
            
                                            <tr>
                                                <td class="text-muted"><em>Shipment Type</em></td>
            
                                                <td>{{ $shipment->type->name }}</td>
                                            </tr>
            
                                            <tr>
                                                <td class="text-muted"><em>Transporation Mode</em></td>
            
                                                <td>{{ $shipment->mode->name }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="table-responsive">
                                        <table class="table table-sm table-hover">            
                                            <tr>
                                                <td class="text-muted" style="width: 150px;"><em>Origin</em></td>
            
                                                <td>{{ $shipment->origin }}</td>
                                            </tr>
            
                                            <tr>
                                                <td class="text-muted"><em>Destination</em></td>
            
                                                <td>{{ $shipment->destination }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-sm table-hover">
                                    <tr>
                                        <td>
                                            <small class="text-muted"><em>Pickup date:</em></small> 
                                            {{ date('d-M-Y', strtotime($shipment->pickedup_date)) }}
                                        </td>

                                        <td>
                                            <small class="text-muted"><em>Expected delivery:</em></small> 
                                            {{ date('d-M-Y', strtotime($shipment->pickedup_date)) }}
                                        </td>
                                        
                                        <td>
                                            <small class="text-muted"><em>Actual delivery:</em></small> 
                                            {{ date('d-M-Y', strtotime($shipment->pickedup_date)) }}
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                    <div id="new-shipment-step-option2">
                        <div class="my-form-title">
                            Cargo items
                        </div>
                        
                        @if ($shipment->items->count())

                            <div class="table-responsive">
                                <table class="table table-sm table-striped">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Item description</th>
                                            <th>Volume</th>
                                            <th>Weight</th>
                                            <th>Value</th>
                                            <th></th>
                                        </tr>
                                    </thead>
        
                                    <tbody>
                                        <tr>
                                            <td><img src="{{ asset('images/info-icon.png') }}" alt=""></td>
                                            <td><a href="" class="my-table-link"><strong>DGG-1</strong></a></td>
                                            <td>Seimens International</td>
                                            <td>MTN Nigeria</td>
                                            <td><span class="badge badge-primary">In transit</span></td>
                                            <td><a href="" class="my-table-link-view">View</a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="alert alert-info">
                                No cargo item added.
                            </div>
                        @endif

                        <div class="text-right">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                New Item
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">{{ __('Hint') }}</div>

                <div class="card-body">
                    <p>Use the "<strong>New item</strong>" button to add cargo items at this shipment.</p>

                    <p>Once all cargo items have been added. 
                        Click on the "<strong>Shipment creation completed</strong>" button to start tracking this shipment.
                    </p>
                    
                    <!--
                    <p>
                        <strong>NOTE:</strong><br>After creating a shipment successfully, you will be able to: 
                        <ul>
                            <li>Create an invoice for the shipment</li>
                            <li>Add shipment tracking history.</li>
                        </ul>
                    </p>
                -->
                </div>
            </div>
        </div>
    </div>
</div>

@include('modals.add_cargo_item')

@endsection
