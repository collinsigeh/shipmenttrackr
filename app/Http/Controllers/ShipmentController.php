<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Sender;
use App\Models\Receiver;
use App\Models\Status;
use App\Models\Type;
use App\Models\Mode;
use App\Models\Shipment;
use App\Models\QuantityType;
use App\Models\Item;

class ShipmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        if(!$this->setupComplete()){
            return back()->with('error_status', 'Your setup is NOT complete.');
        }

        $senders = Sender::orderBy('name', 'asc')->get();

        return view('shipments.create')->with('senders', $senders);
    }

    /**
     * Step one (1) of creating New shipment
     *  -1- check for sender details.
     *  -2- create order in db.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function existingsender(Request $request)
    {

        $this->validate($request, [
            'select_sender' => 'required|min:1'
        ]);

        $sender = Sender::find($request->select_sender);
        
        if(!$sender)
        {
            return back()->with('error_status', 'Invalid user selection.');
        }
        
        return redirect()->route('shipments.create_step2', $sender);
    }

    /**
     * Step one (1) of creating New shipment
     *  -1- check for and save sender details.
     *  -2- create order in db.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function newsender(Request $request)
    {

        $this->validate($request, [
            'name' => 'required|max:255|unique:senders',
            'email' => 'required|max:255|email'
        ]);
        
        $sender = Sender::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        return redirect()->route('shipments.create_step2', $sender);
    }

    /**
     * Display the step2 shipment creation form for receiver details
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function create_step2(Sender $sender)
    {

        if(!$this->setupComplete()){
            return back()->with('error_status', 'Your setup is NOT complete.');
        }

        $receivers = Receiver::orderBy('name', 'asc')->get();

        return view('shipments.create_step2')->with([
                'sender' => $sender,
                'receivers' => $receivers
            ]);
    }

    /**
     * Step one (1) of creating New shipment
     *  -1- check for sender details.
     *  -2- create order in db.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function existingreceiver(Request $request)
    {

        $this->validate($request, [
            'sender_id' => 'required|min:1',
            'select_receiver' => 'required|min:1'
        ]);

        $sender = Sender::find($request->sender_id);
        if(!$sender)
        {
            return redirect()->route('shipments.create');
        }
        
        $receiver = Receiver::find($request->select_receiver);
        if(!$receiver)
        {
            return back()->with('error_status', 'Invalid user selection.');
        }
        
        return redirect()->route('shipments.create_step3', [
                'sender' => $sender, 
                'receiver' => $receiver
            ]);
    }

    /**
     * Step two (2) of creating New shipment
     *  -1- check for and save receiver details.
     *  -2- create order in db.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function newreceiver(Request $request)
    {

        $this->validate($request, [
            'sender_id' => 'required|min:1',
            'name' => 'required|max:255|unique:receivers',
            'email' => 'required|max:255|email'
        ]);

        $sender = Sender::find($request->sender_id);
        if(!$sender)
        {
            return redirect()->route('shipments.create');
        }
        
        $receiver = Receiver::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);
        
        return redirect()->route('shipments.create_step3', [
                'sender' => $sender, 
                'receiver' => $receiver
            ]);
    }

    /**
     * Display the step2 shipment creation form for receiver details
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function create_step3(Sender $sender, Receiver $receiver)
    {

        if(!$this->setupComplete()){
            return back()->with('error_status', 'Your setup is NOT complete.');
        }
        
        $statuses = Status::orderBy('name', 'asc')->get();
        $types = Type::orderBy('name', 'asc')->get();
        $modes = Mode::orderBy('name', 'asc')->get();

        return view('shipments.create_step3')->with([
                'sender' => $sender,
                'receiver' => $receiver,
                'statuses' => $statuses,
                'types' => $types,
                'modes' => $modes
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [

            'type' => 'required',
            'mode' => 'required',
            'origin' => 'required|max:255',
            'destination' => 'required|max:255',
            'status' => 'required',
        ]);

        $temp_tracking_code = 'tmp-' . $request->sender_id . $request->receiver_id . '-'. time();

        $shipment = auth()->user()->shipments()->create([

                            'tracking_code' => $temp_tracking_code,
                            'sender_id' => $request->sender_id,
                            'receiver_id' => $request->receiver_id,
                            'status_id' => $request->status,
                            'type_id' => $request->type,
                            'mode_id' => $request->mode,
                            'origin' => $request->origin,
                            'destination' => $request->destination,
                            'pickedup_date' => $request->pickup_date,
                            'expected_delivery_date' => $request->expected_delivery_date,
                            'actual_delivery_date' => $request->actual_delivery_date,
                            'comments' => $request->comments
                        ]);
        
        $new_tracking_code = 'dgg-' . $request->sender_id . $request->receiver_id . '-' . $shipment->id;
        
        $shipment->tracking_code = strtolower($new_tracking_code);

        $shipment->save();

        return redirect()->route('shipments.create_step4', $shipment)->with('success_status', 'Shipment created! Start adding cargo items.');
    }

    public function create_step4(Shipment $shipment)
    {

        $shipment_total = $this->shipmentTotal($shipment);

        $quantity_types = QuantityType::orderBy('name', 'asc')->get();

        return view('shipments.create_step4')->with([
            'shipment' => $shipment,
            'shipment_total' => $shipment_total,
            'quantity_types' => $quantity_types,
        ]);
    }

    public function store_cargo_item(Request $request, Shipment $shipment)
    {
        
        $this->validate($request, [
            'quantity' => 'required|integer|min:1',
            'quantity_type' => 'required|integer|min:1',
            'item_name' => 'required|max:255',
            'value_amount' => 'required|numeric|min:0',
            'value_currency' => 'required',
            'weight' => 'required|numeric'
        ]);

        if($request->length)
        {
            $this->validate($request, ['length' => 'numeric']);
        }

        if($request->width)
        {
            $this->validate($request, ['width' => 'numeric']);
        }

        if($request->height)
        {
            $this->validate($request, ['height' => 'numeric']);
        }

        if($request->special_note)
        {
            $this->validate($request, ['special_note' => 'string|max:255']);
        }

        if(!QuantityType::find($request->quantity_type))
        {
            return back()->with('error_status', 'Invalid quatity type selected.');
        }

        auth()->user()->items()->create([
                'shipment_id' => $shipment->id,
                'quantity_type_id' => $request->quantity_type,
                'quantity_number' => $request->quantity,
                'name' => $request->item_name,
                'value' => $request->value_amount,
                'currency' => $request->value_currency,
                'weight' => $request->weight,
                'length' => $request->length,
                'width' => $request->width,
                'height' => $request->height,
                'special_note' => $request->special_note
            ]);

        return redirect()->back()->with('success_status', 'The item has been added successfully.');
    }

    /**
     * Update check for cargo items and complete shipment by update the stage to 5.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model $shipment
     * @return \Illuminate\Http\Response
     */
    public function confirmation(Request $request, Shipment $id)
    {
        dd('I got here');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Shipment $shipment)
    {
        dd($shipment);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function setupComplete()
    {
        if(Status::count() < 1 OR Type::count() < 1 OR Mode::count() < 1 OR QuantityType::count() < 1)
        {
            return false;
        }

        return true;
    }

    /**
     * Calculates and returns the totals of the given shipment
     *
     * @param  Shipment  $shipment
     * @return Object $shipment_total
     */
    public function shipmentTotal(Shipment $shipment)
    {
        
        $total_weight = 0;
        $total_volume = 0;
        $total_dollar_value = 0;
        $total_pound_value = 0;
        $total_euro_value = 0;
        $total_yen_value = 0;
        $total_naira_value = 0;

        foreach($shipment->items as $item)
        {
            $total_weight += $item->weight;

            if($item->length > 0 && $item->width > 0 && $item->height > 0)
            {
                $total_volume = $item->length * $item->width * $item->height;
            }
            
            if($item->currency == "$")
            {
                $total_dollar_value += $item->value;
            }
            elseif($item->currency == "£")
            {
                $total_pound_value += $item->value;
            }
            elseif($item->currency == "£")
            {
                $total_euro_value += $item->value;
            }
            elseif($item->currency == "¥")
            {
                $total_yen_value += $item->value;
            }
            elseif($item->currency == "N")
            {
                $total_naira_value += $item->value;
            }
        }

        $shipment_total = (object) array(
            'weight' => $total_weight,
            'volume' => $total_volume,
            'dollar_value' => $total_dollar_value,
            'pound_value' => $total_pound_value,
            'euro_value' => $total_euro_value,
            'yen_value' => $total_yen_value,
            'naira_value' => $total_naira_value
        );

        return $shipment_total;
    }
}
