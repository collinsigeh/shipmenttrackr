<div class="modal fade" id="confirmShipment" tabindex="-1" aria-labelledby="confirmShipmentLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmShipmentLabel">Shipment confirmation</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('shipments.confirmation', $shipment) }}" method="post">
                @csrf
                @method('PUT')

                <div class="modal-body">

                    <div class="alert alert-info">
                        <p>
                            Check the "<strong>Yes</strong>" confirmation box if all cargo items have been added.
                        </p>
                        Then, click on "<strong>Save</strong>" button.
                    </div>
                    
                    <div class="my-box">
                        <div class="my-box-content">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="yes_confirmation" required>
                                <label class="custom-control-label" for="yes_confirmation">Yes, all cargo items have been added.</label>
        
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
                    <input type="submit" class="btn btn-primary" value="Save">
                </div>
            </form>
        </div>
    </div>
</div>