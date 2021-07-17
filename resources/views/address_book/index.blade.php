@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            {{ ucfirst($type) }} <span class="badge badge-primary">{{ $total }}</span>
                        </div>

                        <div class="col-4 text-right">
                            <a href="{{ route('home') }}" class="my-default-link">&larr; Home</a>
                        </div>
                    </div>
                </div>

                <div class="card-body" style="min-height: 550px;">

                    @include('messages.status_alert')

                    <div id="new-shipment-step-option2">

                        <div class="my-box-content">
                            
                            <div style="height: 10px;"></div>
                            <div class="dashboard-info-set">
                    
                                <div class="text-right mb-3">
                                    <a href="" data-toggle="modal" data-target="#searchShipment" class="btn btn-outline-primary mr-3">Search</a>

                                    <a href="{{ route('shipments.create') }}" class="btn btn-primary">New contact</a>
                                </div>
                                
                                @if ($addresses->count())
                                    <div class="table-responsive">
                                        <table class="table table-sm table-hover table-striped">
                                            <thead class="text-muted">
                                                <tr>
                                                    <th></th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Phone</th>
                                                    <th>Address</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                
                                            <tbody>
                                                @foreach ($addresses as $address)
                                                    <tr>
                                                        <td>
                                                            <img src="{{ asset('images/info-icon.png') }}" alt="">
                                                        </td>
                
                                                        <td>
                                                            <a href=""  
                                                                @if ($type == 'receiver' OR $type == 'receivers')
                                                                    data-toggle="modal" data-target="#receiverSummary{{ $address->id }}"
                                                                @else
                                                                    data-toggle="modal" data-target="#senderSummary{{ $address->id }}"
                                                                @endif
                                                                
                                                                class="my-table-link"><strong>{{ $address->name }}</strong></a>
                                                        </td>

                                                        <td>{{ $address->email }}</td>

                                                        <td>
                                                            @if ($address->phone)
                                                                {{ $address->phone }}
                                                            @else
                                                                --
                                                            @endif
                                                        </td>

                                                        <td>
                                                            @if ($address->address)
                                                                {{ $address->address }}
                                                            @else
                                                                --
                                                            @endif
                                                        </td>

                                                        <td class="text-right">
                                                            <a href=""  data-toggle="modal" data-target="#editAddress{{ $address->id }}" class="my-table-link-view">Edit</a>
                                                        </td>
                                                        
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                    <div style="padding-bottom: 30px;">
                                        {{ $addresses->links() }}
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

@if ($type == 'receiver' OR $type == 'receivers')
@foreach ($addresses as $address)
    
    @include('modals.receiver_summary')
@endforeach
@else
    @foreach ($addresses as $address)
        
        @include('modals.sender_summary')
    @endforeach
@endif

@endsection
