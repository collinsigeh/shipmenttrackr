<div class="modal fade" id="updateShipmentStatus" tabindex="-1" aria-labelledby="updateShipmentStatusLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateShipmentStatusLabel">Shipment Status</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('shipments.update', $shipment) }}" method="post">
                @csrf
                @method('PUT')

                <div class="modal-body">

                    <div class="alert alert-info">
                        <strong>Hint:</strong><br>
                        <ol>
                            <li>Select the new "<strong>Shipment status</strong>".</li>
                            <li>Confirm if you selected the "<em>completion status</em>" type.</li>
                            <li>Click on "<strong>Save changes</strong>"</li>
                        </ol>
                    </div>

                    <div class="form-group">
                        <label for="shipment_status" class="form-label">{{ __('Shipment status') }}</label>

                        <select name="shipment_status" id="shipment_status" class="form-control @error('shipment_status')
                                    is-invalid
                                @enderror"
                            
                                @if ($shipment->stage < 6)
                                    {{ 'required' }}
                                @else
                                    {{ 'disabled' }}
                                @endif>

                            <option value="{{ $shipment->status->id }}">{{ $shipment->status->name }}</option>
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
                    
                    <hr>

                    <label>Is this order completed?</label>
                    <div class="my-box">
                        <div class="my-box-content">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="yes_confirmation" id="no_confirmation" value="0" checked>
                                <label class="form-check-label" for="no_confirmation" style="margin-right: 50px;">No</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="yes_confirmation" id="yes_confirmation" value="1">
                                <label class="form-check-label" for="yes_confirmation">Yes</label>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <a href="" class="btn btn-secondary" data-dismiss="modal">Close</a>
                    <input type="submit" class="btn btn-primary" value="Save changes">
                </div>
            </form>
        </div>
    </div>
</div>