<div class="modal fade" id="newAddress" tabindex="-1" aria-labelledby="newAddressLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newAddressLabel">New Contact</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <form action="{{ route('address_book.store') }}" method="post">
                @csrf

                <input type="hidden" name="type" value="{{ $type }}">
                
                <div class="modal-body">
                    <div class="my-box my-content-box">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="name" class="form-label">{{ __('Name') }}</label>
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                    <small class="text-muted">** Required **</small>
        
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="email" class="form-label">{{ __('Email') }}</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus>
                                    <small class="text-muted">** Required **</small>
            
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="phone" class="form-label">{{ __('Phone') }}</label>
                                    <input id="phone" type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" autocomplete="phone" autofocus>
                                    <small class="text-muted">** Optional **</small>
            
                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="address" class="form-label">{{ __('Address') }}</label>
                                    <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" autocomplete="address" autofocus>
                                    <small class="text-muted">** Optional **</small>
            
                                    @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <label>Add to sender list</label>
                    <div class="my-box">
                        <div class="my-box-content">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="add_to_sender_confirmation" id="no_sender_confirmation" value="0" checked>
                                <label class="form-check-label" for="no_sender_confirmation" style="margin-right: 50px;">No</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="add_to_sender_confirmation" id="yes_confirmation-sender" value="1"
                                    @if ($type == 'sender' or $type == 'senders')
                                        {{ 'checked' }}                                        
                                    @endif>
                                <label class="form-check-label" for="yes_sender_confirmation">Yes</label>
                            </div>
                        </div>
                    </div>

                    <label>Add to receiver list</label>
                    <div class="my-box">
                        <div class="my-box-content">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="add_to_receiver_confirmation" id="no_receiver_confirmation" value="0" checked>
                                <label class="form-check-label" for="no_receiver_confirmation" style="margin-right: 50px;">No</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="add_to_receiver_confirmation" id="yes_receiver_confirmation" value="1"
                                    @if ($type == 'receiver' or $type == 'receivers')
                                        {{ 'checked' }}
                                    @endif>
                                <label class="form-check-label" for="yes_receiver_confirmation">Yes</label>
                            </div>
                        </div>
                    </div>




                </div>
    
                <div class="modal-footer">
                    <a href="" class="btn btn-secondary" data-dismiss="modal">Close</a>

                    <button type="submit" class="btn btn-primary">
                        {{ __('Save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>