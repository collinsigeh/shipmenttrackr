<div class="modal fade" id="searchShipment" tabindex="-1" aria-labelledby="searchShipment" aria-hidden="true">
    <div class="modal-xl modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="searchShipmentLabel">Search shipment</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('shipments.search') }}" method="post">
                @csrf

                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="tc" class="form-label">{{ __('Tracking Code') }}</label>

                                        <input type="tc" name="tc" id="tc" class="form-control @error('tc')
                                                is-invalid
                                            @enderror" value="{{ old('tc') }}" placeholder="Optional">

                                        @error('tc')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="shipment_status" class="form-label">{{ __('Shipment status') }}</label>

                                        <select name="shipment_status" id="shipment_status" class="form-control @error('shipment_status')
                                                    is-invalid
                                                @enderror">

                                            <option value="">All</option>
                                            <option value="">--</option>
                                            @foreach ($statuses as $status)
                                                <option value="{{ $status->id }} ">{{ $status->name }}</option>
                                            @endforeach

                                        </select>
                                            
                                        @error('shipment_status')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-xl-6">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="sender" class="form-label">{{ __('Sender') }}</label>

                                        <select name="sender" id="sender" class="form-control @error('sender')
                                                    is-invalid
                                                @enderror">

                                            <option value="">All senders</option>
                                            <option value="">--</option>
                                            @foreach ($senders as $sender)
                                                <option value="{{ $sender->id }} ">{{ $sender->name }}</option>
                                            @endforeach

                                        </select>
                                            
                                        @error('sender')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="receiver" class="form-label">{{ __('Receiver') }}</label>

                                        <select name="receiver" id="receiver" class="form-control @error('receiver')
                                                    is-invalid
                                                @enderror">

                                            <option value="">All receivers</option>
                                            <option value="">--</option>
                                            @foreach ($receivers as $receiver)
                                                <option value="{{ $receiver->id }} ">{{ $receiver->name }}</option>
                                            @endforeach

                                        </select>
                                            
                                        @error('shipment_status')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <a href="" class="btn btn-secondary" data-dismiss="modal">Close</a>
                    <input type="submit" class="btn btn-primary" value="Search">
                </div>
            </form>
        </div>
    </div>
</div>