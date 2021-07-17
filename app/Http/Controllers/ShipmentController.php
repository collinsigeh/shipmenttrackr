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
use App\Models\Location;

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
        $statuses = Status::orderBy('name', 'asc')->get();

        $senders = Sender::orderBy('name', 'asc')->get();

        $receivers = Receiver::orderBy('name', 'asc')->get();

        $shipments = Shipment::orderBy('tracking_code', 'asc')->simplePaginate(50);

        return view('shipments.index')->with([
            'statuses' => $statuses,
            'senders' => $senders,
            'receivers' => $receivers,
            'shipments' => $shipments,
        ]);
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
        
        $new_tracking_code = $shipment->id . '-' . $request->sender_id . '-' . $request->receiver_id;
        
        $shipment->tracking_code = strtolower($new_tracking_code);

        $shipment->save();

        return redirect()->route('shipments.create_step4', $shipment)->with('success_status', 'Shipment created! Start adding cargo items.');
    }

    public function create_step4(Shipment $shipment)
    {
        if($shipment->stage > 4)
        {
            return redirect()->route('shipments.show', $shipment)->with('error_status', 'Shipment had previously been confirmed.');
        }
        
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
        if($shipment->stage > 4)
        {
            return redirect()->route('shipments.show', $shipment)->with('info_status', 'Shipment had previously been confirmed.');
        }
        
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
    public function confirmation(Request $request, Shipment $shipment)
    {
        if($shipment->stage > 4)
        {
            return redirect()->route('shipments.show', $shipment)->with('info_status', 'Shipment had previously been confirmed.');
        }

        $this->validate($request, [
            'yes_confirmation' => 'required'
        ]);

        $shipment->stage = '5';

        $shipment->save();

        return redirect()->route('shipments.show', $shipment);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Shipment $shipment)
    {
        if($shipment->stage <= 4)
        {
            return redirect()->route('shipments.create_step4', $shipment)->with('error_status', 'Please confirm the cargo items.');
        }

        $shipment_total = $this->shipmentTotal($shipment);

        $statuses = Status::orderBy('name', 'asc')->get();

        return view('shipments.show')->with([
            'shipment' => $shipment,
            'shipment_total' => $shipment_total,
            'statuses' => $statuses,
        ]);
    }

    public function store_location(Request $request, Shipment $shipment)
    {
        if($shipment->stage >= '6')
        {
            return back()->with('error_status', 'This order is complete.');
        }
        
        $this->validate($request, [
            'date' => 'required',
            'location_name' => 'required|max:255',
            'shipment_status' => 'required|integer|min:1'
        ]);

        if($request->special_note)
        {
            $this->validate($request, ['special_note' => 'string|max:255']);
        }

        if(!Status::find($request->shipment_status))
        {
            return back()->with('error_status', 'Invalid shipment status selected.');
        }

        auth()->user()->locations()->create([
                'shipment_id' => $shipment->id,
                'name' => $request->location_name,
                'status_id' => $request->shipment_status,
                'date' => $request->date,
                'time' => $request->time,
                'remark' => $request->remark
            ]);

        return redirect()->back()->with('success_status', 'The location has been added successfully.');
    }

    /**
     * Update check for shipment status and update location accordingly.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model $shipment
     * @return \Illuminate\Http\Response
     */
    public function update_location(Request $request, Location $location)
    {
        if($location->shipment->stage >= 6)
        {
            return back()->with('error_status', 'This order is complete.');
        }
        
        $this->validate($request, [
            'date' => 'required',
            'shipment_status' => 'required|integer|min:1'
        ]);

        if($request->special_note)
        {
            $this->validate($request, ['special_note' => 'string|max:255']);
        }

        if(!Status::find($request->shipment_status))
        {
            return back()->with('error_status', 'Invalid shipment status selected.');
        }

        $location->date = $request->date;
        $location->time = $request->time;
        $location->status_id = $request->shipment_status;
        $location->remark = $request->remark;

        $location->save();

        return redirect()->route('shipments.show', $location->shipment)->with('success_status', 'Update saved.');
    }

    /**
     * Should show the form for editing the specified resource BUT now redirects back to all shipments.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return redirect()->route('shipments.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Shipment $shipment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shipment $shipment)
    {
        if($shipment->stage >= 6)
        {
            return back()->with('error_status', 'This order is complete.');
        }

        $this->validate($request, [
            'shipment_status' => 'required|integer|min:1'
        ]);

        $chosen_status = Status::find($request->shipment_status);

        if(!$chosen_status)
        {
            return back()->with('error_status', 'Invalid shipment status selected.');
        }

        // Requesting for confirmation for completed shipments
        if($chosen_status->name == 'Complete' OR $chosen_status->name == 'Completed' OR
            $chosen_status->name == 'Order Complete' OR $chosen_status->name == 'Order Completed')
        {
            
            $this->validate($request, [
                'yes_confirmation' => 'required|integer|min:1'
            ]);

            if($request->yes_confirmation != 1)
            {
                return back()->with('error_status', 'The yes confirmation is required for completion status.');
            }
        }

        $shipment->status_id = $request->shipment_status;

        $shipment->save();
        
        // Now to check and update the shipment stage as necessary
        if($shipment->status->name == 'Complete' OR $shipment->status->name == 'Completed' OR
            $shipment->status->name == 'Order Complete' OR $shipment->status->name == 'Order Completed')
        {
            $shipment->stage = '6';

            $shipment->save();
        }

        return back()->with('success_status', 'Update saved.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Shipment  $shipment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Shipment $shipment)
    {
        $this->validate($request, [
            'yes_confirmation' => 'required'
        ]);

        if($shipment->stage < 5)
        {
            $shipment->delete();

            return back()->with('success_status', 'Shipment deleted.');
        }
        else
        {
            return back()->with('error_status', 'Delete failed. Shipment has been confirmed.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item $item
     * @return \Illuminate\Http\Response
     */
    public function destroy_item(Item $item)
    {
        if($item->shipment->stage < 5)
        {
            $item->delete();

            return back()->with('success_status', 'Cargo item deleted.');
        }
        else
        {
            return back()->with('error_status', 'Delete failed. Shipment has been confirmed.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Location $location
     * @return \Illuminate\Http\Response
     */
    public function destroy_location(Location $location)
    {
        if($location->shipment->stage < 6)
        {
            $location->delete();

            return back()->with('success_status', 'Location details deleted.');
        }
        else
        {
            return back()->with('error_status', 'Delete failed. Shipment has been confirmed.');
        }
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

    public function search(Request $request){

        $db_check = [];

        if($request->tc)
        {
            array_push($db_check, ['tracking_code', 'like', '%'.$request->tc.'%']);
        }

        if($request->shipment_status)
        {
            array_push($db_check, ['status_id', $request->shipment_status]);
        }

        if($request->sender)
        {
            array_push($db_check, ['sender_id', $request->sender]);
        }

        if($request->receiver)
        {
            array_push($db_check, ['receiver_id', $request->receiver]);
        }
        
        $shipments = Shipment::where($db_check)->orderBy('tracking_code', 'asc')->get();
        
        /**
        $shipments = Shipment::where($db_check)->count();
        
        $shipments = Shipment::where($db_check)->orderBy('tracking_code', 'asc')->simplePaginate(1);

        */

        $statuses = Status::orderBy('name', 'asc')->get();
        $senders = Sender::orderBy('name', 'asc')->get();
        $receivers = Receiver::orderBy('name', 'asc')->get();

        return view('shipments.search')->with([
            'shipments' => $shipments,
            'statuses' => $statuses,
            'senders' => $senders,
            'receivers' => $receivers,
        ]);
    }

    public function list($type = 'all'){

        if($type == 'active')
        {
            $total = Shipment::where('stage', '5')->count();
            $shipments = Shipment::where('stage', '5')->orderBy('tracking_code', 'asc')->simplePaginate(50);
        }
        elseif($type == 'pending')
        {
            $total = Shipment::where('stage', '<=', '4')->count();
            $shipments = Shipment::where('stage', '<=', '4')->orderBy('tracking_code', 'asc')->simplePaginate(50);
        }
        elseif($type == 'completed')
        {
            $total = Shipment::where('stage', '>=', '6')->count();
            $shipments = Shipment::where('stage', '>=', '6')->orderBy('tracking_code', 'asc')->simplePaginate(50);
        }
        else
        {
            $total = Shipment::count();
            $shipments = Shipment::orderBy('tracking_code', 'asc')->simplePaginate(50);
        }

        $statuses = Status::orderBy('name', 'asc')->get();
        $senders = Sender::orderBy('name', 'asc')->get();
        $receivers = Receiver::orderBy('name', 'asc')->get();

        return view('shipments.list')->with([
            'total' => $total,
            'type' => $type,
            'shipments' => $shipments,
            'statuses' => $statuses,
            'senders' => $senders,
            'receivers' => $receivers,
        ]);
    }
}
