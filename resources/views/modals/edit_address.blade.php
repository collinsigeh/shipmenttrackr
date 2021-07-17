<div class="modal fade" id="editAddress{{ $address->id }}" tabindex="-1" aria-labelledby="editAddress{{ $address->id }}Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="senderSummary{{ $address->id }}Label">Update information</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <form action="{{ route('address_book.update', $address->id) }}" method="post">
                @csrf
                @method('PUT')

                <input type="hidden" name="type" value="{{ $type }}">
                
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                        <div class="col-md-8">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $address->name }}" required autocomplete="name" autofocus>
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
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $address->email }}" autocomplete="email" autofocus>
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
                            <input id="phone" type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ $address->phone }}" autocomplete="phone" autofocus>
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
                            <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ $address->address }}" autocomplete="address" autofocus>
                            <small class="text-muted">** Optional **</small>

                            @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
    
                <div class="modal-footer">
                    <a href="" class="btn btn-secondary" data-dismiss="modal">Close</a>

                    <button type="submit" class="btn btn-primary">
                        {{ __('Save changes ') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>