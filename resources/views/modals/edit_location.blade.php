<div class="modal fade" id="editLocation{{ $location->id }}" tabindex="-1" aria-labelledby="editLocation{{ $location->id }}Label" aria-hidden="true">
    <div class="modal-xl modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editLocation{{ $location->id }}Label">Edit location details</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('shipments.update_location', $location) }}" method="post">
                @csrf
                @method('PUT')

                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-4">
                            <div class="form-group">
                                <label for="location_name" class="form-label">{{ __('Location name') }}</label>

                                <input type="text" id="item_name" class="form-control" value="{{ $location->name }}" disabled>
                            </div>
                        </div>

                        <div class="col-xl-4">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="date" class="form-label">{{ __('Date') }}</label>

                                        <input type="date" name="date" id="date" class="form-control @error('date')
                                                is-invalid
                                            @enderror" value="{{ $location->date }}" required>
                                            
                                        @error('date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="time" class="form-label">{{ __('Time') }}</label>

                                        <input type="time" name="time" id="time" class="form-control @error('time')
                                                is-invalid
                                            @enderror" value="{{ $location->time }}">
                                        <small class="text-muted">** Optional</small>
                                            
                                        @error('time')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-xl-4">
                            <div class="row">                                
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="shipment_status" class="form-label">{{ __('Shipment status') }}</label>

                                        <select name="shipment_status" id="shipment_status" class="form-control @error('shipment_status')
                                                    is-invalid
                                                @enderror" required>

                                            <option value="{{ $location->status->id }}">{{ $location->status->name }}</option>
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

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="remark" class="form-label">{{ __('Remark') }}</label>
        
                                        <textarea name="remark" id="remark" class="form-control @error('remark')
                                                is-invalid
                                            @enderror" placeholder="Optional">{{ $location->remark }}</textarea>
                                            
                                        @error('remark')
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
                    
                    @if ($location->shipment->stage < 6)
                        <input type="submit" class="btn btn-primary" value="Save changes">
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>