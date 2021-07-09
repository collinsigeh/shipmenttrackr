@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <h3>Settings</h3>
    </div>
    <div class="row">
        <div class="col-md-8 mb-4">
            <div class="card">
                <div class="card-header">{{ __('Setting options') }}</div>

                <div class="card-body">

                    @if (session('error_status'))
                        <div class="alert alert-danger alert-dismissible fade show">
                            {{ session('error_status') }}

                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    


                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">{{ __('Settings') }}</div>

                <div class="card-body">
                    
                    <a href="{{ route('status.index') }}" class="btn btn-sm btn-block btn-outline-primary text-left">Order status &rarr;</a>
                    <a href="{{ route('type.index') }}" class="btn btn-sm btn-block btn-outline-primary text-left">Shipment types &rarr;</a>
                    <a href="{{ route('mode.index') }}" class="btn btn-sm btn-block btn-outline-primary text-left">Transportation Mode &rarr;</a>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
