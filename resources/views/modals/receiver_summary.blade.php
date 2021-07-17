<div class="modal fade" id="receiverSummary{{ $address->id }}" tabindex="-1" aria-labelledby="receiverSummary{{ $address->id }}Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="receiverSummary{{ $address->id }}Label">Receiver summary</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">

                <div class="dashboard-info-set">
                    <p>
                        <span class="main-info">{{$address->name}}</span><br>
                        <small>
                            {{ $address->email }} <br>
                            {{ $address->phone }} <br>
                            {{ $address->address }}<br>
                        </small>
                    </p>
                </div>

                <h5>Receiver Shipments</h5>

                @php
                    $completed = 0;
                    $pending = 0;
                    $active = 0;
                    foreach($address->shipments as $shipment)
                    {
                        if($shipment->stage >= 6)
                        {
                            $completed++;
                        }
                        elseif($shipment->stage <= 4)
                        {
                            $pending++;
                        }
                        else
                        {
                            $active++;
                        }
                    }
                @endphp
                
                <div class="my-box">
                    <div class="info-box-content">
                        <div class="table-responsive">
                            <table class="table tabl-sm">
                                <tr>
                                    <td><img src="{{ asset('images/info-icon.png') }}" alt=""></td>
                                    <td style="vertical-align: middle">Active shipments:</td>
                                    <td class="text-right" style="font-size: 120%">{{ $active }}</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><img src="{{ asset('images/warning-icon.png') }}" alt=""></td>
                                    <td style="vertical-align: middle">Pending shipments:</td>
                                    <td class="text-right" style="font-size: 120%">{{ $pending }}</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><img src="{{ asset('images/success-icon.png') }}" alt=""></td>
                                    <td style="vertical-align: middle">Completed shipments:</td>
                                    <td class="text-right" style="font-size: 120%">{{ $completed }}</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td colspan="4">
                                        <form action="{{ route('shipments.search') }}" method="post">
                                            @csrf
    
                                            <input type="hidden" name="receiver" value="{{ $address->id }}">
    
                                            <div class="text-right"><input type="submit" class="btn btn-sm btn-outline-secondary my-btn-sm" value="View all"></div>
                                        </form>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

            </div>

            <div class="modal-footer">
                <a href="" class="btn btn-secondary" data-dismiss="modal">Close</a>
            </div>
        </div>
    </div>
</div>