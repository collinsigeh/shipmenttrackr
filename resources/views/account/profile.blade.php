@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @include('messages.status_alert')

            <div class="card">
                <div class="card-header">{{ __('My details') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('account.update', $account) }}">
                        @csrf
                        @method('PUT')
                        
                        <div class="my-box my-box-content">
    
                            <div class="form-group">
                                <label for="username" class="form-label">{{ __('Username') }}</label>
                                <input id="username" class="form-control" value="{{ $account->username }}" disabled>
                            </div>

                            <div class="form-group">
                                <label for="name" class="form-label">{{ __('Name') }}</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $account->name }}" required autocomplete="name" autofocus>
    
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
    
                            <div class="form-group">
                                <label for="email" class="form-label">{{ __('E-Mail Address') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $account->email }}" required autocomplete="email">
    
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
    
                            <hr class="my-4">
    
                            <div class="form-group row mb-0">
                                <div class="col-6">
                                    <a href="" data-toggle="modal" data-target="#changePassword" class="btn btn-outline-primary">Change password</a>
                                </div>
    
                                <div class="col-6 text-right">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Save changes') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@include('modals.change_password')

@endsection
