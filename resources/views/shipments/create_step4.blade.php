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

                    @include('messages.status_alert')

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
                                <td style="padding: 20px 0 20px 20px; width: 115px; vertical-align: middle;" class="text-muted">Tracking Code:</td>

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
                            
                            <div class="info-set">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="table-responsive">
                                            <table class="table table-sm table-hover">
                                                <tr>
                                                    <td class="text-muted" style="width: 130px;"><small>Order Status</small></td>
                
                                                    <td><span class="badge badge-pill badge-primary">{{ $shipment->status->name }}</span></td>
                                                </tr>
                
                                                <tr>
                                                    <td class="text-muted"><small>Shipment Type</small></td>
                
                                                    <td>{{ $shipment->type->name }}</td>
                                                </tr>
                
                                                <tr>
                                                    <td class="text-muted"><small>Transporation Mode</small></td>
                
                                                    <td>{{ $shipment->mode->name }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
    
                                    <div class="col-lg-6">
                                        <div class="table-responsive">
                                            <table class="table table-sm table-hover">            
                                                <tr>
                                                    <td class="text-muted" style="width: 130px;"><small>Origin</small></td>
                
                                                    <td>{{ $shipment->origin }}</td>
                                                </tr>
                
                                                <tr>
                                                    <td class="text-muted"><small>Destination</small></td>
                
                                                    <td>{{ $shipment->destination }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="info-set">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <strong>
                                            <table class="table table-sm table-hover table-borderless">
                                                <tr>
                                                    <td style="width: 101px;">
                                                        Total weight: 
                                                    </td>
    
                                                    <td>
                                                        @if ($shipment_total->weight > 0)
                                                        
                                                            {{ $shipment_total->weight }}  kg
                                                        @else
                                                            --
                                                        @endif
                                                    </td>
                                                </tr>
                                            </table>
                                        </strong>
                                    </div>
    
                                    <div class="col-lg-4">
                                        <strong>
                                            <table class="table table-sm table-hover table-borderless">
                                                <tr>
                                                    <td style="width: 101px;">
                                                        Total volume: 
                                                    </td>
    
                                                    <td>
                                                        @if ($shipment_total->volume > 0)
                                                        
                                                            {{ $shipment_total->volume }}  cm<sup><small>3</small></sup>
                                                        @else
                                                            --
                                                        @endif
                                                    </td>
                                                </tr>
                                            </table>
                                        </strong>
                                    </div>
    
                                    <div class="col-lg-4">
                                        <strong>       
                                            <table class="table table-sm table-hover table-borderless">
                                                <tr>
                                                    <td style="width: 101px;">
                                                        Value: 
                                                    </td>
    
                                                    <td>
                                                        @if ($shipment_total->dollar_value > 0)
                                                            
                                                            &dollar; {{ $shipment_total->dollar_value }} <br>
                                                        @endif
                                                    </td>
                                                </tr>
                                            </table>
                                        </strong>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="info-set">
                                <div class="row">
                                    <div class="col-4">
                                        <table class="table table-sm table-hover table-borderless">
                                            <tr>
                                                <td style="width: 105px;">
                                                    <small class="text-muted">Pickup date:</small>
                                                </td>
    
                                                <td>
                                                    @if ($shipment->pickedup_date)
                                                        <small>{{ date('d-M-Y', strtotime($shipment->pickedup_date)) }}</small>
                                                    @else
                                                        --
                                                    @endif
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    
                                    <div class="col-4">
                                        <table class="table table-sm table-hover table-borderless">
                                            <tr>
                                                <td style="width: 105px;">
                                                    <small class="text-muted">Expected delivery:</small>
                                                </td>
    
                                                <td>
                                                    @if ($shipment->expected_delivery_date)
                                                    <small>{{ date('d-M-Y', strtotime($shipment->expected_delivery_date)) }}</small>
                                                    @else
                                                        --
                                                    @endif
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    
                                    <div class="col-4">
                                        <table class="table table-sm table-hover table-borderless">
                                            <tr>
                                                <td style="width: 105px;">
                                                    <small class="text-muted">Actual delivery:</small>
                                                </td>
    
                                                <td>
                                                    @if ($shipment->actual_delivery_date)
                                                        <small>{{ date('d-M-Y', strtotime($shipment->actual_delivery_date)) }}</small>
                                                    @else
                                                        --
                                                    @endif
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div id="new-shipment-step-option2">
                        <div class="my-form-title">
                            Cargo items
                        </div>
                        
                        <div class="my-box-content">
                            @if ($shipment->items->count())

                                <div class="info-set">
                                    <div class="table-responsive">
                                        <table class="table table-sm table-hover">                
                                            <tbody>
                                                @foreach ($shipment->items as $item)
                                                    <tr>
                                                        <td><img src="{{ asset('images/info-icon.png') }}" alt=""></td>
        
                                                        <td style="padding-bottom: 20px;">
                                                            <p>
                                                                <strong>
                                                                    {{ 
                                                                        $item->quantity_number . ' ' 
                                                                            . Str::plural($item->quantityType->name, $item->quantity_number) 
                                                                            . ' of ' . $item->name 
                                                                    }}
                                                                </strong>
                                                            </p>
        
                                                            <div class="row">
                                                                <div class="col-md-3">
                                                                    <small class="text-muted">{{ $item->currency . ' ' . $item->value }}</small>
                                                                </div>
        
                                                                <div class="col-md-3">
                                                                    <small class="text-muted"><em>Wgt: &nbsp;</em> {{ $item->weight }}kg</small>
                                                                </div>

                                                                <div class="col-md-3">
                                                                    <small class="text-muted">
        
                                                                        <em>Vol: &nbsp;&nbsp;&nbsp;</em>
        
                                                                        @if ($item->length > 0 && $item->width > 0 && $item->height > 0)
                                                                            
                                                                            {{ $item->length * $item->width * $item->height }} cm<sup><small>3</small></sup>
                                                                        @else
                                                                            
                                                                            {{ '--' }}
                                                                        @endif
        
                                                                    </small>
                                                                </div>
        
                                                                <div class="col-md-3">
                                                                    @if ($item->special_note)
                                                                        <small class="text-muted">{{ $item->special_note }}</small>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </td>
        
                                                        <td class="text-right">
                                                            <form action="{{ route('shipments.destroy_item', $item) }}" method="post">
                                                                @csrf
                                                                @method('DELETE')

                                                                <button type="submit" class="my-table-link-delete">Delete</button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            @else
                                <div class="alert alert-info">
                                    No cargo item added.
                                </div>
                            @endif
    
                            <div class="text-right">
                                <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#newItem" style="margin-right: 20px;">
                                    New Item
                                </button>
                                
                                @if ($shipment->items->count())
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#confirmShipment">
                                        Confirm shipment
                                    </button>
                                @endif
                            </div>
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
                        Click on the "<strong>Confirm shipment</strong>" to confirm that all cargo items have been added.
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
@include('modals.confirm_shipment')

@endsection
