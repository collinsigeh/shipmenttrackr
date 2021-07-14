@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <h3>Dashboard</h3>
    </div>
    <div class="row">
        <div class="col-md-8 mb-4">
            <div class="card">
                <div class="card-header">{{ __('Shipments') }}</div>

                <div class="card-body">

                    @include('messages.status_alert')
                    
                    <div class="text-right mb-3">
                        <a href="{{ route('shipments.create') }}" class="btn btn-primary">New shipment</a>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-sm table-striped">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Tracking Code</th>
                                    <th>Sender Name</th>
                                    <th>Receiver Name</th>
                                    <th>Status</th>
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
                                <tr>
                                    <td><img src="{{ asset('images/info-icon.png') }}" alt=""></td>
                                    <td><a href="" class="my-table-link"><strong>DGG-2</strong></a></td>
                                    <td>Okezie Electronics</td>
                                    <td>Okezie Electronics</td>
                                    <td><span class="badge badge-danger">Canceled</span></td>
                                    <td><a href="" class="my-table-link-view">View</a></td>
                                </tr>
                                <tr>
                                    <td><img src="{{ asset('images/info-icon.png') }}" alt=""></td>
                                    <td><a href="" class="my-table-link"><strong>DGG-4</strong></a></td>
                                    <td>Okezie Electronics</td>
                                    <td>Okezie Electronics</td>
                                    <td><span class="badge badge-warning">On Hold</span></td>
                                    <td><a href="" class="my-table-link-view">View</a></td>
                                </tr>
                                <tr>
                                    <td><img src="{{ asset('images/info-icon.png') }}" alt=""></td>
                                    <td><a href="" class="my-table-link"><strong>DGG-22</strong></a></td>
                                    <td>Okezie Electronics</td>
                                    <td>Okezie Electronics</td>
                                    <td><span class="badge badge-success">Delivered</span></td>
                                    <td><a href="" class="my-table-link-view">View</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">{{ __('Settings') }}</div>

                <div class="card-body">
                    
                    <a href="" class="btn btn-sm btn-block btn-outline-primary text-left">My account &rarr;</a>
                    <a href="{{ route('status.index') }}" class="btn btn-sm btn-block btn-outline-primary text-left">Order status &rarr;</a>
                    <a href="{{ route('type.index') }}" class="btn btn-sm btn-block btn-outline-primary text-left">Shipment types &rarr;</a>
                    <a href="{{ route('mode.index') }}" class="btn btn-sm btn-block btn-outline-primary text-left">Transportation Mode &rarr;</a>
                    <a href="{{ route('quantity_types.index') }}" class="btn btn-sm btn-block btn-outline-primary text-left">Quantity Type &rarr;</a>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
