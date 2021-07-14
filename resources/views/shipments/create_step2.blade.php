@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <h3 class="mb-4">New shipment</h3>

    <div class="row">
        <div class="col-md-8 mb-4">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8"><span class="badge badge-primary">Step 2 of 4</span> - Add sender details</div>

                        <div class="col-4 text-right"><a href="{{ route('shipments.create') }}" class="my-default-link">&larr; Step 1</a></div>
                    </div>
                </div>

                <div class="card-body">

                    <div class="my-box">
                        <div class="my-box-title">
                            Sender
                        </div>

                        <div class="my-box-content">

                            <span class="main-info">{{ $sender->name }}</span><br>
                            {{ $sender->email }}<br>
                            {{ $sender->phone }}<br>
                            {{ $sender->address }}

                        </div>
                    </div>

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
                    
                    <div class="row">
                        <div class="col-lg-6">
                            <div id="new-shipment-step-option2">
                                <div class="my-form-title">
                                    Existing receiver
                                </div>

                                <form action="{{ route('shipments.existingreceiver') }}" method="post">
                                    @csrf

                                    <input type="hidden" name="sender_id" value="{{ $sender->id }}">
        
                                    <div class="form-group row">
                                        <label for="select_receiver" class="col-md-4 col-form-label text-md-right">{{ __('Select a receiver') }}</label>
            
                                        <div class="col-md-8">
                                            <select id="select_receiver" class="form-control @error('select_receiver') is-invalid @enderror" name="select_receiver" required autocomplete="select_receiver" autofocus>
                                                <option value="">- - -</option>
                                                @foreach ($receivers as $receiver)
                                                    <option value="{{ $receiver->id }}">{{ $receiver->name }}</option>
                                                @endforeach
                                            </select>
                                            <small class="text-muted">** Required **</small>
        
                                            @error('select_receiver')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
        
                                    <div class="form-group row mb-0">
                                        <div class="col-md-8 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Next ') }}&rarr;
                                            </button>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div id="new-shipment-step1">
                                <div class="my-form-title">
                                    New receiver
                                </div>
                                
                                <form action="{{ route('shipments.newreceiver') }}" method="post">
                                    @csrf

                                    <input type="hidden" name="sender_id" value="{{ $sender->id }}">
        
                                    <div class="form-group row">
                                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Receiver name') }}</label>
            
                                        <div class="col-md-8">
                                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                            <small class="text-muted">** Required **</small>
        
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
        
                                    <div class="form-group row">
                                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>
            
                                        <div class="col-md-8">
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus>
                                            <small class="text-muted">** Required **</small>
        
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
        
                                    <div class="form-group row">
                                        <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>
            
                                        <div class="col-md-8">
                                            <input id="phone" type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" autocomplete="phone" autofocus>
                                            <small class="text-muted">** Optional **</small>
        
                                            @error('phone')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
        
                                    <div class="form-group row">
                                        <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>
            
                                        <div class="col-md-8">
                                            <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" autocomplete="address" autofocus>
                                            <small class="text-muted">** Optional **</small>
        
                                            @error('address')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
        
                                    <div class="form-group row mb-0">
                                        <div class="col-md-8 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Next ') }}&rarr;
                                            </button>
                                        </div>
                                    </div>
                                </form>
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
                    <p>If the receiver record is in your system, select using the "<strong>Existing receiver</strong>" form.</p>
                    <p>If the receiver record is NOT in your system, enter it using the "<strong>New receiver</strong>" form.</p>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
