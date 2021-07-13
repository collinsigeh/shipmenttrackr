<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-xl modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New cargo item</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('shipments.store_cargo_item', $shipment) }}" method="post">
                @csrf

                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-4">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="quantity" class="form-label">{{ __('Quanity') }}</label>

                                        <input type="number" name="quantity" id="quantity" class="form-control @error('quantity')
                                                is-invalid
                                            @enderror" value="{{ old('quantity') }}" required>
                                            
                                        @error('quantity')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="quantity_type" class="form-label">{{ __('Quanity Type') }}</label>

                                        <select name="quantity_type" id="quantity_type" class="form-control @error('quantity_type')
                                                    is-invalid
                                                @enderror" required>

                                            @foreach ($quantity_types as $type)
                                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                                            @endforeach

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

                        <div class="col-xl-4">
                            <div class="form-group">
                                <label for="item_name" class="form-label">{{ __('Item name') }}</label>

                                <input type="text" name="item_name" id="item_name" class="form-control @error('item_name')
                                        is-invalid
                                    @enderror" value="{{ old('item_name') }}" required>
                                    
                                @error('item_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-xl-4">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="value_amount" class="form-label">{{ __('Value amount') }}</label>

                                        <input type="decimal" name="value_amount" id="value_amount" class="form-control @error('value_amount')
                                                is-invalid
                                            @enderror" value="{{ old('value_amount') }}" required>
                                            
                                        @error('value_amount')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="value_currency" class="form-label">{{ __('Value Currency') }}</label>

                                        <select name="value_currency" id="value_currency" class="form-control @error('value_currency')
                                                    is-invalid
                                                @enderror" required>

                                            <option value="&dollar;">&dollar; - US Dollar</option>
                                            <option value="&pound;">&pound; - British Pound</option>
                                            <option value="&euro;">&euro; - Euro</option>
                                            <option value="&yen;">&yen - Japanese Yen</option>
                                            <option value="N">N - Nigerian Naira</option>

                                        </select>
                                            
                                        @error('value_currency')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-2">
                            <div class="form-group">
                                <label for="weight" class="form-label">{{ __('Weight (kg)') }}</label>

                                <input type="decimal" name="weight" id="weight" class="form-control @error('weight')
                                        is-invalid
                                    @enderror" value="{{ old('weight') }}" required>
                                    
                                @error('weight')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-xl-6">
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="length" class="form-label">{{ __('Length (cm)') }}</label>
        
                                        <input type="decimal" name="length" id="length" class="form-control @error('length')
                                                is-invalid
                                            @enderror" value="{{ old('length') }}" placeholder="Optional">
                                            
                                        @error('length')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="width" class="form-label">{{ __('Width (cm)') }}</label>
        
                                        <input type="decimal" name="width" id="width" class="form-control @error('width')
                                                is-invalid
                                            @enderror" value="{{ old('width') }}" placeholder="Optional">
                                            
                                        @error('width')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="height" class="form-label">{{ __('Height (cm)') }}</label>
        
                                        <input type="decimal" name="height" id="height" class="form-control @error('height')
                                                is-invalid
                                            @enderror" value="{{ old('height') }}" placeholder="Optional">
                                            
                                        @error('height')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4">
                            <div class="form-group">
                                <label for="special_note" class="form-label">{{ __('Special note') }}</label>

                                <textarea name="special_note" id="special_note" class="form-control @error('special_note')
                                        is-invalid
                                    @enderror" placeholder="Optional">{{ old('special_note') }}</textarea>
                                    
                                @error('special_note')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div></div>
                    </div>
                </div>

                <div class="modal-footer">
                    <a href="" class="btn btn-secondary" data-dismiss="modal">Close</a>
                    <input type="submit" class="btn btn-primary" value="Save item">
                </div>
            </form>
        </div>
    </div>
</div>