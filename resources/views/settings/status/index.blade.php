@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 mb-4">
            <div class="card">
                <div class="card-header">{{ __('Order statuses') }}</div>

                <div class="card-body">
                    
                    <div id="status-form-button" class="text-right mb-3">
                        <button class="btn btn-primary" onclick="showStatusCreationForm()">New status</button>
                    </div>

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

                    <div id="new-status-form">
                        <div class="my-form-title">
                            New order status
                        </div>

                        <div class="text-right">
                            <a href="" id="close-new-status-form" onclick="hideStatusCreationForm()">Close</a>
                        </div>
                        <form action="{{ route('status.store') }}" method="post">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Status name') }}</label>
    
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                    <small class=" text-muted">** E.g. In Transit</small>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Save') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-sm table-striped">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Statuses</th>
                                    <th></th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($statuses as $status)
                                    <tr>
                                        <td><img src="{{ asset('images/info-icon.png') }}" alt=""></td>
                                        <td>{{ $status->name }}</td>
                                        <td><a href="" class="my-table-link-delete">Delete</a></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td></td>
                                        <td><em>None available</em></td>
                                        <td></td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">{{ __('Hint') }}</div>

                <div class="card-body">
                    
                    <p>The <strong>order status</strong> is a settings parameter which is used to determine the state of each shipment.</p>
                    <p>At least one (1) <em>order status</em> is required before shipments can be entered.</p>
                    <p>You can create new <em>order status</em> by clicking on the <strong>New status</strong> button.</p>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
