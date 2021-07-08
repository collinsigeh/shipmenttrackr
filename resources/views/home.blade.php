@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="mb-3">
        <h3>Dashboard</h3>
    </div>
    <div class="row">
        <div class="col-md-8 mb-4">
            <div class="card">
                <div class="card-header">{{ __('Shipments') }}</div>

                <div class="card-body">
                    
                    <div class="text-right mb-3">
                        <a href="" class="btn btn-primary">New shipment</a>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-sm table-striped">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Tracking code</th>
                                    <th>Sender</th>
                                    <th>Receiver</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td><img src="{{ asset('images/info-icon.png') }}" alt=""></td>
                                    <td><a href="" class="my-table-link"><strong>DGG1</strong></a></td>
                                    <td>Seimens International</td>
                                    <td>MTN Nigeria</td>
                                    <td><span class="badge badge-info">In transit</span></td>
                                    <td><a href="" class="my-table-link-view">View</a></td>
                                </tr>
                                <tr>
                                    <td><img src="{{ asset('images/info-icon.png') }}" alt=""></td>
                                    <td><a href="" class="my-table-link"><strong>DGG2</strong></a></td>
                                    <td>Okezie Electronics</td>
                                    <td>Okezie Electronics</td>
                                    <td><span class="badge badge-info">In transit</span></td>
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
                    <a href="{{ route('status.index') }}" class="btn btn-sm btn-block btn-outline-primary text-left">Shipment status &rarr;</a>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
