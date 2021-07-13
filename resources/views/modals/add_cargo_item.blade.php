<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-xl modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New cargo item</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form action="{{ route('shipments.store_cargo_item', $shipment->id) }}" method="post">
                    @csrf

                    <div class="row">
                        <div class="col-xl-4">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="quantity" class="col-md-4 col-form-label text-md-right">{{ __('Quanity') }}</label>

                                        <input type="number" name="quantiy" id="quantity" required class="form-control @error('quantity')
                                                is-invalid
                                            @enderror" value="{{ old('quantity') }}">
                                            
                                        @error('quantity')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="quantity_type" class="col-md-4 col-form-label text-md-right">{{ __('Quanity Type') }}</label>

                                        <select name="quantiy_type" id="quantity_type" required class="form-control @error('quantity_type')
                                                is-invalid
                                            @enderror">

                                            <option value=""></option>

                                        </select>
                                            
                                        @error('quantity_type')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save item</button>
            </div>
        </div>
    </div>
</div>