<div class="modal fade" id="deleteShipment{{ $shipment->id }}" tabindex="-1" aria-labelledby="deleteShipment{{ $shipment->id }}Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmShipment{{ $shipment->id }}Label">Confirm delete</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('shipments.destroy', $shipment) }}" method="post">
                @csrf
                @method('DELETE')

                <div class="modal-body">

                    <div class="alert alert-info">
                        Hint:
                        <ol>
                            <li>Check the "<strong>Yes</strong>" confirmation box.</li>
                            <li>Click on the "<strong>Delete</strong>" button to proceed.</li>
                        </ol>                        
                    </div>
                    
                    <div class="my-box">
                        <div class="my-box-content">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="yes_confirmation" name="yes_confirmation" required>
                                <label class="custom-control-label" for="yes_confirmation">Yes, delete shipment <span class="badge badge-primary">{{ $shipment->tracking_code }}</span>.</label>
        
                                @error('yes_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <a href="" class="btn btn-secondary" data-dismiss="modal">Close</a>
                    <input type="submit" class="btn btn-danger" value="Delete">
                </div>
            </form>
        </div>
    </div>
</div>